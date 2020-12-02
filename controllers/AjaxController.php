<?php


namespace app\controllers;


class AjaxController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('ajax', [], false);
    }

    public function actionAutocompleteRegFact()
    {
        echo $this->render('ajax/organizer/autocomplete-reg-fact', [], false);
    }

    /**
     * URL: /ajax/new-password
     * Проверка и сохранение нового пароля
     */
    public function actionNewPassword()
    {
        echo $this->render('ajax/organizer/new-password', [], false);
    }

    /**
     * URL: /ajax/rotate-avatar
     * Поворот аватара.
     */
    public function actionRotateAvatar()
    {
        echo $this->render('ajax/organizer/rotate-avatar', [], false);
    }
}
