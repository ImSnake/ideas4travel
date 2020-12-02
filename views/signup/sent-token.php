<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Регистрация партнера";
$this->description = "";

?>


<div class="center">

    <div class="container service">

        <div class="service__message">
            <h2><?= $form->first_name ?> <?= $form->last_name ?>, информация успешно сохранена!</h2>
            <p>Для завершения регистрации подтвердите свой e-mail:</p>
            <p class="small-font dark-grey">&bull;&nbsp;Проверьте входящие сообщения в почтовом ящике.</p>
            <p class="small-font dark-grey">&bull;&nbsp;Найдите сообщение с электронного адреса <?= EMAIL_SUPPORT ?>
                .</p>
            <p class="small-font dark-grey">&bull;&nbsp;Пройдите по ссылке в письме и активируйте кабинет партнера.</p>
        </div>

        <div class="service__back-link">
            <a href="/" class="link">Вернуться в раздел "Партнерам"</a>
        </div>

    </div>

</div>