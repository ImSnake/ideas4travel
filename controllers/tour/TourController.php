<?php

namespace app\controllers\tour;

use app\controllers\Controller;

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
        echo $this->render('tour/index');
    }
}