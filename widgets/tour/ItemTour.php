<?php

namespace app\widgets\tour;

use app\base\Widget;

class ItemTour extends Widget
{
    public function run()
    {
        /** @var array $toursBySort - Получаем массив туров с одним из статусов. */
        $toursBySort = $this->params['toursBySort'];
        $tourStatus = $this->params['tourStatus'];
        $arrStatus = $this->params['arrStatus'];
        $arrSeason = $this->params['arrSeason'];
        $arrCurrency = $this->params['arrCurrency'];

        echo $this->render('tour/views/item_tour',
            [
                'toursBySort' => $toursBySort,
                'tourStatus' => $tourStatus,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency
            ]
        );
    }
}