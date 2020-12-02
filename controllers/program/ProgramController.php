<?php

namespace app\controllers\program;

use app\controllers\Controller;

class ProgramController extends Controller
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
     * URL: /programs
     */
    public function actionIndex()
    {
        echo $this->render('program/index');
    }

    /**
     * URL: /programs/create
     */
    public function actionCreate()
    {
        echo $this->render('program/create');
    }
}
