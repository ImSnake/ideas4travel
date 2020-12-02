<?php

namespace app\controllers\guid;

use app\controllers\Controller;

class GuidController extends Controller
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
     * URL: /guides
     */
    public function actionIndex()
    {
        echo $this->render('guid/index');
    }
}