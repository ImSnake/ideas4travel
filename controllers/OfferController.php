<?php

namespace app\controllers;

class OfferController extends Controller
{
    /**
     * URL: /offer
     */
    public function actionIndex()
    {
        echo $this->render('offer/index');
    }

    /**
     * URL: /offer/rules
     */
    public function actionRules()
    {

        echo $this->render('offer/rules');

    }
}
