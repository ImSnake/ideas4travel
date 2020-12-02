<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrCountry;
use app\Models\program\PrDay;
use app\Models\program\PrDayActivity;
use app\Models\program\PrDayPoint;
use app\Models\program\PrGeo;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\Models\program\PrVideos;
use app\Models\tour\Tour;
use app\services\Geo;
use app\Models\Partner;

class Preview extends Widget
{
    public function run()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;

        // Получаем массив городов.
        $countriesArr = $geo->getCountry();

        /** @var Program $program - Получаем объект текущей программы */
        $program = $this->params['program'];

        /** @var Partner $partner - Получаем объект партнера */
        $partner = $this->params['partner'];

        // Получаем список туров для текущей программы.
        $sql_tours = "SELECT * FROM " . Tour::tableName() . " WHERE program_id = :program_id and t_status_admin_id in (" . Tour::STATUS_PUBLISHED . "," . Tour::STATUS_IN_MODERATION . ")";
        $tours = $this->db->queryArrObject($sql_tours, Tour::class, ['program_id' => $program->id]);

        // Получаем id всех стран программы.
        $arrCountryProgram = (new PrCountry())->getArrCountriesId($program->id);
        // Получаем массив из id.
        $arrCountryId = [];
        foreach ($arrCountryProgram as $val) {
            $arrCountryId[] = $val['country_id'];
        }

        // Получаем названия стран.
        $countryName = [];
        foreach ($countriesArr as $val) {
            if (in_array($val['id'], $arrCountryId)) {
                $countryName[] = $val['name'];
            }
        }

        /** @var PrGeo $prGeoStart */
        $prGeoStart = $program->start ? (new PrGeo())->getOne($program->start) : null;

        /** @var PrGeo $prGeoFinish */
        $prGeoFinish = $program->finish ? (new PrGeo())->getOne($program->finish) : null;

        // Получаем названия стран для старта и финиша.
        $route_stats = [];
        foreach ($countriesArr as $val) {
            if ($val['id'] == $prGeoStart->country_id) {
                $route_stats['start_country'] = $val['name'];
            }
            if ($val['id'] == $prGeoFinish->country_id) {
                $route_stats['finish_country'] = $val['name'];
            }
        }

        // Получаем название города старта.
        $route_stats['start_city'] = $geo->getCityName($prGeoStart->city_id);

        // Получаем название города финиша.
        $route_stats['finish_city'] = $geo->getCityName($prGeoFinish->city_id);

        // Получаем комфорт.
        $comfort = '';
        foreach (Program::getArrComfort() as $key => $val) {
            if ($val['id'] == $program->comfort_id) {
                $comfort = $val;
            }
        }

        // Получаем динамику.
        $dynamic = '';
        foreach (Program::getArrDynamic() as $key => $val) {
            if ($val['id'] == $program->dynamic_id) {
                $dynamic = $val;
            }
        }

        // Получаем питание.
        $meal = '';
        foreach (Program::getArrMeals() as $key => $val) {
            if ($val['id'] == $program->meal_id) {
                $meal = $val;
            }
        }

        // Получаем id выбранных элементов в типе тура.
        $arrTourType = $program->getTourType($program->id);
        $arrTourTypeIds = [];
        if ($arrTourType) {
            foreach ($arrTourType as $key => $val) {
                $arrTourTypeIds[] = $val['type_tour_id'];
            }
        }

        // Получаем id выбранных элементов целевой аудитории.
        $arrTargetAudience = $program->getTargetAudience($program->id);
        $arrTargetAudienceIds = [];
        if ($arrTargetAudience) {
            foreach ($arrTargetAudience as $key => $val) {
                $arrTargetAudienceIds[] = $val['target_audience_id'];
            }
        }

        // Получаем заглавное фото.
        $mainImg = (new PrImg())->getOne([
            'partner_id' => $program->partner_id,
            'program_id' => $program->id,
            'type' => 'main',
            'deleted' => 0
        ]);

        // Получаем фото карты.
        $mapImg = (new PrImg())->getOne([
            'partner_id' => $program->partner_id,
            'program_id' => $program->id,
            'type' => 'map',
            'deleted' => 0
        ]);

        // Получаем все остальные фото.
        $allImg = (new PrImg())->getAllWhere([
            'partner_id' => $program->partner_id,
            'program_id' => $program->id,
            'type' => 0,
            'deleted' => 0
        ]);

        // Получаем видео.
        $allVideos = (new PrVideos())->getAllWhere(['program_id' => $program->id]);

        $videos['count'] = count($allVideos);
        $videoId = [];
        foreach ($allVideos as $video) {
            $videoId[] = $video['video'];
        }
        $videos['ids'] = implode($videoId, ',');

        // Получаем локацию.
        $arrDayPoints = (new PrDayPoint())->getAllWhere(['program_id' => $program->id]);
        $arrPointName = [];
        foreach ($arrDayPoints as $point) {
            $arrPointName[] = $point['name'];
        }
        // Оставляем только уникальные значения.
        $arrPointName = array_unique($arrPointName);

        // Получаем активности.
        $arrDayActivities = (new PrDayActivity())->getAllWhere(['program_id' => $program->id]);
        $arrActivityName = [];
        foreach ($arrDayActivities as $activity) {
            $arrActivityName[] = $activity['name'];
        }
        // Оставляем только уникальные значения.
        $arrActivityName = array_unique($arrActivityName);

        // Получаем массив элементов фильтров.
        $arrAllFilters = Program::getArrFilters();

        // Получаем массив ids элементов выбранных фильтров.
        $arrFilters = Program::getFilters($program->id);
        $arrFiltersIds = [];
        if ($arrFilters) {
            foreach ($arrFilters as $key => $val) {
                $arrFiltersIds[] = $val['filter_id'];
            }
        }

        // Получаем срез трансферов для программы.
        $arrTransfer = $program->getTransferByProgram();

        // Получаем срез ночевок для программы.
        $arrDayGeo = $program->getDayGeoByProgram();

        function getArrDayCountryId($array)
        {
            $arr = [];

            foreach ($array as $val) {
                $arr[] = $val['country_id'];
            }

            return array_unique($arr);
        }

        $arrDayGeoByCountry = [];
        foreach (getArrDayCountryId($arrDayGeo) as $search) {
            $arrDayGeoByCountry[$search] = array_filter($arrDayGeo, function ($element) use ($search) {
                return $element['country_id'] === $search;
            });
        }

        // ПЛАН ПО ДНЯМ ------------------------------------
        // Получаем массив дней.
        $arrDays = (new PrDay())->getAllWhere(['program_id' => $program->id], 'object');

        // Получаем общее расстояние.
        $distance = 0;
        foreach ($arrDays as $day) {
            $distance += $day->distance;
        }

        echo $this->render('program/views/preview',
            [
                'partner' => $partner,
                'partnerProfile' => $partner->getProfile(),
                'program' => $program,
                'tours' => $tours,
                'geo' => $geo,
                'countryName' => $countryName,
                'countryCount' => count($countryName),
                'mainImg' => $mainImg,
                'mapImg' => $mapImg,
                'allImg' => $allImg,
                'comfort' => $comfort,
                'dynamic' => $dynamic,
                'meal' => $meal,
                'route_stats' => $route_stats,
                'arrTourTypeIds' => $arrTourTypeIds,
                'arrTargetAudienceIds' => $arrTargetAudienceIds,
                'videos' => $videos,
                'arrPointName' => $arrPointName,
                'arrActivityName' => $arrActivityName,
                'arrAllFilters' => $arrAllFilters,
                'arrFiltersIds' => $arrFiltersIds,
                'arrTransfer' => $arrTransfer,
                'arrDayGeoByCountry' => $arrDayGeoByCountry,
                'arrDays' => $arrDays,
                'distance' => $distance,
            ]
        );
    }
}