<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Регистрация партнера";
$this->description = "";

?>


<!--<div class="center">-->

    <div class="container service">

        <div class="service__message">
            <h2>Привет, <?= $form->first_name ?> <?= $form->last_name ?>!</h2>

            <div>Благодарим тебя за готовность принять участие в тестировании сервиса ideas4travel</div>
            <p>Ты получишь доступ в "Личный кабинет организатора" после проверки регистрационных данных</p>
            <p>Чтобы ускорить процесс, свяжись с пригласившим тебя контактным лицом</p>


<!--            <div>Чтобы завершить регистрацию подтверди свой&nbsp;email</div>
            <p class="list">Проверь входящие сообщения в&nbsp;почтовом ящике, в&nbsp;том числе папку СПАМ</p>
            <p class="list">Найди сообщение с&nbsp;электронного адреса <span class="blue"><?= EMAIL_SUPPORT ?></span></p>
            <p class="list">Пройди по&nbsp;ссылке в&nbsp;письме и&nbsp;активируй кабинет Организатора</p>
-->
            <div class="service__back-link">
                <a href="/" class="link">вернуться в раздел "Организаторам"</a>
            </div>

        </div>

    </div>

<!--</div>-->