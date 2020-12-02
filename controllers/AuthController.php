<?php

namespace app\controllers;

/**
 * Class AuthController
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * URL: /auth
     */
    public function actionIndex()
    {
        // Если пользователь авторизован перенаправляем его на главную страницу.
        if ($this->auth->getUserId()) {
            $this->go('organizer');
        }

        // Проверяем успешность авторизации пользователя.
        if ($this->auth->authWithForm()) {
            // Если пользователь авторизовался, то перенаправляем его на главную страницу.
            $this->go('organizer');
        } else {
            // Если пользователь не авторизован, то проверяем наличие ошибок.
            $errors = $this->auth->getError();
            echo $this->render('auth/auth-form', ['errors' => $errors]);
        }
    }

    /**
     * URL: /auth/auth-signup
     */
    public function actionAuthSignup()
    {
        if ($this->auth->getUserId()) {
            // Если пользователь авторизован выводим основную страницу.
            $this->go('organizer');
        } else {
            // Если НЕ авторизован выводим приглашение зарегистрироваться или авторизоваться.
            echo $this->render('auth/auth-signup-form');
        }
    }

    /**
     * URL: /auth/logout
     */
    public function actionLogout()
    {
        $this->auth->logOut();
        $this->go();
    }
}
