<?php

namespace app\controllers\tour;

use app\base\App;
use app\controllers\Controller;
use app\Models\program\Program;
use app\Models\tour\ExtraCost;
use app\Models\tour\Tour;
use app\services\Geo;

class TourController extends Controller
{
    protected function behavior()
    {
        parent::behavior();
        // Если пользователь НЕ авторизован перенаправляем его на главную страницу.
        if (!$this->auth->getUserId()) {
            $this->go();
        }
    }

    /**
     * URL: /tours
     */
    public function actionIndex()
    {
        // Получаем все программы данного партнера.
        $programsByPartner = Program::find(['partner_id' => $this->partner->id]);
        $complated = [];
        $draft = [];
        foreach ($programsByPartner as $item) {
            if ($item['status'] == Program::STATUS_DRAFT) {
                $draft[] = $item;
            } elseif (in_array($item['status'], [
                Program::STATUS_COMPLETED,
                Program::STATUS_IN_MODERATION,
                Program::STATUS_PUBLISHED,
                Program::STATUS_UNPUBLISHED
            ])) {
                $complated[] = $item;
            }
        }
        $programsByPartnerStatus = array_merge($complated, $draft);

        // Получаем массив туров с данными о программе.
        $toursWithProgram = Tour::getTourWithProgram();
        // Получаем массив туров с данными о программе отсортированный по статусам:
        // опубликованный, на модерации, не опубликованный, завершенный.
        $toursBySort = Tour::sortTourWithProgramByStatus($toursWithProgram);
        // Получаем список элементов статусов туров.
        $arrStatus = Tour::getArrStatus();
        // Получаем список элементов типов сезонов.
        $arrSeason = Tour::getArrSeason();
        // Массив валют.
        $arrCurrency = ['RUB' => '₽', 'USD' => '$', 'EUR' => '€'];

        echo $this->render('tour/index',
            [
                'toursBySort' => $toursBySort,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency,
                'programsByPartner' => $programsByPartnerStatus
            ]
        );
    }

    /**
     * URL: /tours/edit/<id>
     */
    public function actionEdit()
    {
        // Получаем из url ID тура
        $tour_id = App::get()->request->getUrlParams()['id'];
        /** @var Tour $tour */
        $tour = (new Tour())->getOne($tour_id);
        /** @var Program $program */
        $program = (new Program())->getOne($tour->program_id);
        // Получаем список элементов статусов туров.
        $arrStatus = Tour::getArrStatus();
        // Получаем список элементов типов сезонов.
        $arrSeason = Tour::getArrSeason();
        // Массив валют.
        $arrCurrency = ['RUB' => '₽', 'USD' => '$', 'EUR' => '€'];
        // Получаем список элементов названий обязательных названий для дополнительной стоимости туров.
        $arrExtraCostPreset = Tour::getArrExtraCostPreset();
        // Получаем массив предустановленной дополнительной стоимости.
        $extraCostPreset = $tour->getExtraCostPreset();
        // Получаем массив элементов дополнительной стоимости.
        $arrExtraCost = ExtraCost::find(['tour_id' => $tour_id]);
        // Получаем отсортированный массив элементов дополнительной стоимости.
        $arrExtraCostByType = Tour::getExtraCostByType($arrExtraCost);

        echo $this->render('tour/edit',
            [
                'tour' => $tour,
                'program' => $program,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency,
                'arrExtraCostPreset' => $arrExtraCostPreset,
                'extraCostPreset' => $extraCostPreset,
                'arrExtraCostByType' => $arrExtraCostByType
            ]
        );
    }
}