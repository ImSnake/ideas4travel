<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrCountry;
use app\Models\program\PrGeo;
use app\Models\program\Program;
use app\services\Geo;
use app\services\Request;

class EditProgramDescription extends Widget
{
    public function run()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;

        // Получаем массив стран.
        $countriesArr = $geo->getCountry();

        // Получаем из url ID программы.
        $programId = App::get()->request->getUrlParams()['id'];

        /** @var Program $program */
        $program = (new Program())->getOne($programId);

        /** @var PrGeo $prGeoStart */
        $prGeoStart = $program->start ? (new PrGeo())->getOne($program->start) : new PrGeo();

        /** @var PrGeo $prGeoFinish */
        $prGeoFinish = $program->finish ? (new PrGeo())->getOne($program->finish) : new PrGeo();

        // Получаем id всех стран программы.
        $arrCountryProgram = (new PrCountry())->getArrCountriesId($programId);
        // Получаем массив из id.
        foreach ($arrCountryProgram as $val) {
            $arrCountryId[] = $val['country_id'];
        }
        // Если страны в программе существуют.
        if (!empty($arrCountryId)) {
            // Получаем Id старта и финиша
            $countryIdStart = $prGeoStart->country_id;
            $countryIdFinish = $prGeoFinish->country_id;
            $countriesIdStartFinish = [$countryIdStart, $countryIdFinish];
            // Получаем названия стран для старта и финиша.
            foreach ($countriesArr as $val) {
                if ($val['id'] == $countryIdStart) {
                    $countryNameStart = $val['name'];
                }
                if ($val['id'] == $countryIdFinish) {
                    $countryNameFinish = $val['name'];
                }
            }

            $arrCountryIdOther = array_diff($arrCountryId, [$countryIdStart, $countryIdFinish]);

            // Получаем названия других стран и их id.
            $countryOther = [];
            foreach ($countriesArr as $val) {
                if (in_array($val['id'], $arrCountryIdOther)) {
                    $countryNameOther[] = $val['name'];
                    $countryOther[$val['id']] = $val['name'];
                }
            }

            $arrCountry['start_finish_names'] = ($countryNameStart != $countryNameFinish) ?
                implode(', ', [$countryNameStart, $countryNameFinish]) : $countryNameStart;
            $arrCountry['other_names'] = $countryNameOther ? $countryNameOther : '';
            $arrCountry['ids'] = implode(',', array_merge($countriesIdStartFinish, $arrCountryIdOther));
            $arrCountry['countryOther'] =  $countryOther;
        } else {
            $arrCountry['start_finish_names'] = '';
            $arrCountry['other_names'] = '';
            $arrCountry['ids'] = '';
            $arrCountry['countryOther'] = '';
        }

        // Получаем id выбранных элементов в типе тура.
        $arrTourType = $program->getTourType($programId);
        $arrTourTypeIds = [];
        if ($arrTourType) {
            foreach ($arrTourType as $key => $val) {
                $arrTourTypeIds[] = $val['type_tour_id'];
            }
        }

        // Получаем id выбранных элементов целевой аудитории.
        $arrTargetAudience = $program->getTargetAudience($programId);
        $arrTargetAudienceIds = [];
        if ($arrTargetAudience) {
            foreach ($arrTargetAudience as $key => $val) {
                $arrTargetAudienceIds[] = $val['target_audience_id'];
            }
        }

        echo $this->render('program/views/form_description',
            [
                'program' => $program,
                'countriesArr' => $countriesArr,
                'geo' => $geo,
                'prGeoStart' => $prGeoStart,
                'prGeoFinish' => $prGeoFinish,
                'arrCountry' => $arrCountry,
                'arrTourTypeIds' => $arrTourTypeIds,
                'arrTargetAudienceIds' => $arrTargetAudienceIds
            ]
        );
    }
}
