<?php

namespace app\controllers;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * URL: /
     */
    public function actionIndex()
    {
        if ($this->auth->getUserId()) {
            // Если пользователь авторизован выводим основную страницу.
            $this->go('organizer');
        } else {
            // Если НЕ авторизован выводим приглашение зарегистрироваться или авторизоваться.
            echo $this->render('site/invite');
        }
    }
}
