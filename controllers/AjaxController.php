<?php


namespace app\controllers;


class AjaxController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('ajax', [], false);
    }
}