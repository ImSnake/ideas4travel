<?php

namespace app\controllers;

class Error404Controller extends Controller
{
    public function actionIndex()
    {
        echo $this->render('404');
    }
}
