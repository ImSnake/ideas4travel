<?php

namespace app\services;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    static function mail($to, $subject, $message)
    {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        // Настройки SMTP
        if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
            $mail->IsMAIL();
        } else {
            $mail->isSMTP();
        }


        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;

        $mail->Host = 'ssl://server117.hosting.reg.ru';
        $mail->Port = 465;
        $mail->Username = 'support@ideas4travel.ru';
        $mail->Password = 'GresM56$PrRg82';

        // От кого
        $mail->setFrom('support@ideas4travel.ru', 'Ideas For Travel');

        // Кому
        $mail->addAddress($to, '');

        // Тема письма
        $mail->Subject = $subject;

        // Тело письма
        $body = $message;
        $mail->msgHTML($body);

        // Приложение
        //$mail->addAttachment(__DIR__ . '/image.jpg');

        $mail->send();
    }
}