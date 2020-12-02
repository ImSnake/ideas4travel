<?php

namespace app\controllers;

use app\base\App;
use app\forms\SignupForm;
use app\Models\User;
use app\services\Mailer;

class ForgetPasswordController extends Controller
{
    /**
     * URL: /forget
     */
    public function actionIndex()
    {
        // Если пользователь авторизован перенаправляем его на главную страницу.
        if (isset($this->user)) {
            $this->go();
        }

        /** @var string|null $error */
        $error = null;

        // Если форма была отправлена.
        if (isset($_POST['forget']['submit'])) {
            $email = $_POST['forget']['email'];

            if (isset($email) && !empty($email)) {
                // Проверяем существует ли такой email.
                $sql = "SELECT id FROM " . DB_P_USERS . " WHERE email = :email";
                $res = $this->db->queryOne($sql, [':email' => $email]);
                if (!$res) {
                    echo $this->render('forget/forget-form',
                        ['email' => $email, 'error' => 'Указанный email не зарегистрирован']);
                } else {
                    // Генерируем verification_token
                    $verification_token = sha1(mt_rand(1111, 9999) . time() . $email . mt_rand(1111, 9999));

                    // Заносим сгенированный токен в базу.
                    $sql = "UPDATE " . DB_P_USERS . " SET verification_token = :verification_token WHERE id = :id";
                    $this->db->execute($sql, [':id' => $res['id'], ':verification_token' => $verification_token]);

                    // Отправляем письмо с кодом подтверждения.
                    $subject = 'Восстановление пароля на сайте Ideas4travel.ru';
                    $message = "
					<h2>Здравствуйте, " . $res['first_name'] . " " . $res['last_name'] . "</h2>
					<p>Если вы заказали восстановление пароля для доступа к сайту ideas4travel.ru, то перейдите по ссылке ниже в этом письме.</p>
					<p><a href=\"https://" . $_SERVER['HTTP_HOST'] . "/forget/" . $verification_token . "\">Сменить пароль</a></p>
					<p>Или скопируйте ссылку в адресную строку браузера: https://" . $_SERVER['HTTP_HOST'] . "/forget/" . $verification_token . "</p>
					";
//                    $this->myMail($email, '', EMAIL_SUPPORT, $subject, $message);
                    Mailer::mail($email, $subject, $message);

                    // Выводим страницу с сообщением, что на почту отправлен код подтверждения.
                    echo $this->render('forget/sent-mail');
                }
            } else {
                echo $this->render('forget/forget-form', ['email' => $email, 'error' => 'введите email']);
            }
        } else {
            echo $this->render('forget/forget-form', ['email' => '', 'error' => null]);
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

        // Проверяем существует ли такой verification_token, если да получаем пользователя.
        $sql = "SELECT id FROM " . DB_P_USERS . " WHERE verification_token = :verification_token";
        $result = $this->db->queryOne($sql, [':verification_token' => $verification_token]);

        if ($result) {
            // Выводим страницу для задания нового пароля.
            echo $this->render('forget/new-password', ['verification_token' => $verification_token]);
        } else {
            // Выводим страницу с сообщением, что код подтверждения не верен.
            echo $this->render('forget/token-false');
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