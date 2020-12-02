<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Код подтверждения не верен";
$this->description = "";

?>

<!--<div class="center">-->

    <div class="container service">

        <div class="service__message">
            <h2>Ошибка!</h2>
            <p>Код подтверждения не верен или устарел</p>
            <p>Требуется повторная регистрация</p>

            <div class="service__back-link">
                <a href="/signup" class="link">Регистрация</a>
            </div>
        </div>

    </div>

<!--</div>-->