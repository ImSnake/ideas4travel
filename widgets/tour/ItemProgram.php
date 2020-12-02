<?php

namespace app\widgets\tour;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrCountry;
use app\Models\program\PrImg;
use app\services\Geo;

class ItemProgram extends Widget
{
    public function run()
    {
        /** @var array $programs */
        $program = $this->params['program'];
        $imgMain = PrImg::find(['program_id' => $program['id'], 'type' => 'main']);

        /** @var Geo $geo */
        $geo = App::get()->geo;

        // Получаем массив городов.
        $countriesArr = $geo->getCountry();

        // Получаем id всех стран программы.
        $arrCountryProgram = (new PrCountry())->getArrCountriesId($program['id']);
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

        echo $this->render('tour/views/item_program',
            [
                'program' => $program,
                'imgMain' => $imgMain,
                'countryName' => $countryName
            ]
        );
    }
}