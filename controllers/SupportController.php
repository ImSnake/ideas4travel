<?php

namespace app\controllers;

class SupportController extends Controller
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
     * URL: /support
     */
    public function actionIndex()
    {
        echo $this->render('support/index');
    }

    /**
     * URL: /support/knowledge-base
     */
    public function actionKnowledgeBase()
    {

        echo $this->render('support/knowledge-base');

    }
}
