<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrCountry;
use app\Models\program\PrGeo;
use app\Models\program\Program;
use app\services\Geo;

class PreviewDescription extends Widget
{
    public function run()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;

        // Получаем массив городов.
        $countriesArr = $geo->getCountry();

        /** @var Program $program - Получаем объект текущей программы */
        $program = $this->params['program'];

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
        $comfort = 0;
        foreach (Program::getArrComfort() as $key => $val) {
            if ($val['id'] == $program->comfort_id) {
                $comfort = $val['id'];
            }
        }

        // Получаем динамику.
        $dynamic = 0;
        foreach (Program::getArrDynamic() as $key => $val) {
            if ($val['id'] == $program->dynamic_id) {
                $dynamic = $val['id'] - 1;
            }
        }

        // Получаем питание.
        $meal = 0;
        foreach (Program::getArrMeals() as $key => $val) {
            if ($val['id'] == $program->meal_id) {
                $meal = $val['id'] - 1;
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

        echo $this->render('program/views/preview_description',
            [
                'program' => $program,
                'countryCount' => $this->params['countryCount'],
                'comfort' => $comfort,
                'dynamic' => $dynamic,
                'meal' => $meal,
                'route_stats' => $route_stats,
                'arrTourTypeIds' => $arrTourTypeIds,
                'arrTargetAudienceIds' => $arrTargetAudienceIds
            ]
        );
    }
}
