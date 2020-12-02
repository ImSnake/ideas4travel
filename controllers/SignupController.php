<?php

namespace app\controllers;

use app\base\App;
use app\forms\SignupForm;
use app\services\Mailer;

class SignupController extends Controller
{
    /**
     * URL: /signup
     */
    public function actionIndex()
    {
        // Если пользователь авторизован перенаправляем его на главную страницу.
        if (isset($this->user)) {
            $this->go();
        }

        // Создаем экземпляр класса формы и заполняем его данными.
        $form = new SignupForm();

        // Если форма была отправлена.
        if (isset($_POST['signup']['submit_signup'])) {
            $form->email = $_POST['signup']['email'];
            $form->password = $_POST['signup']['password'];
            $form->password_repeat = $_POST['signup']['password_repeat'];
            $form->first_name = $_POST['signup']['first_name'];
            $form->last_name = $_POST['signup']['last_name'];
            $form->phone = $_POST['signup']['phone'];
            $form->confirm_agreement = $_POST['signup']['confirm_agreement'];
            $form->created_ip = $_SERVER['REMOTE_ADDR'];

            if ($form->validate()) {
                // Генерируем verification_token
                $form->verification_token = sha1(mt_rand(1111, 9999) . time() . $form->email . mt_rand(1111, 9999));

                // Записываем данные в базу.
                $form->insert();

                // Отправляем письмо с кодом подтверждения.
                $subject = 'Код подтверждения регистрации на Ideas4travel.ru';
                $message = "
					<h2>Здравствуйте, " . $form->first_name . " " . $form->last_name . "</h2>
					<p>Пожалуйста, подтвердите вашу регистрацию на сайте ideas4travel.ru</p>
					<p><a href=\"https://" . $_SERVER['HTTP_HOST'] . "/signup/" . $form->verification_token . "\">Подтвердите регистрацию</a></p>
					<p>Или скопируйте код в адресную строку браузера: https://" . $_SERVER['HTTP_HOST'] . "/signup/" . $form->verification_token . "</p>
					<p>Email при регистрации: " . $form->email . "</p>
					";
//                $this->myMail($form->email, '', EMAIL_SUPPORT, $subject, $message);
//                $this->myMail(EMAIL_SUPPORT, '', EMAIL_SUPPORT, $subject, $message);
                Mailer::mail(EMAIL_SUPPORT, $subject, $message);
                // перегружаем страницу для предотвращения повторной отправки формы
//                $this->go('//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

                // Выводим страницу с сообщением, что на почту отправлен код подтверждения.
                echo $this->render('signup/sent-token', ['form' => $form]);
            } else {
                echo $this->render('signup/signup-form', ['form' => $form]);
            }
        } else {
            echo $this->render('signup/signup-form', ['form' => $form]);
        }
    }

    /**
     * URL: /signup/<verification_token>
     */
    public function actionVerification()
    {
        // Если пользователь авторизован перенаправляем его на главную страницу.
        if (isset($this->user)) {
            $this->go();
        }

        // Получаем из url verification_token
        $verification_token = App::get()->request->getUrlParams()['key'];

        $model = new SignupForm();

        if ($model->isVerificationToken($verification_token)) {
            // Выводим страницу с сообщением, что код подтверждения верен и форму авторизации.
            echo $this->render('signup/token-true');
        } else {
            // Выводим страницу с сообщением, что код подтверждения не верен.
            echo $this->render('signup/token-false');
        }
    }

    /**
     * @param $to
     * @param string $cc
     * @param string $from
     * @param $subject
     * @param $message
     * @return bool
     */
    private function myMail($to, $cc, $from, $subject, $message)
    {
        $headers = "From: Ideas4travel ($from)\r\n";
        $headers .= "Cc: $cc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf8\r\n" . "Content-Transfer-Encoding: 8bit\r\n";
        if (mail($to, "=?utf8?B?" . base64_encode($subject) . "?=", $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
