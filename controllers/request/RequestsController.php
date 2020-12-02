<?php

namespace app\controllers\request;

use app\controllers\Controller;

class RequestsController extends Controller
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
     * URL: /requests
     */
    public function actionIndex()
    {
        echo $this->render('request/index');
    }
}