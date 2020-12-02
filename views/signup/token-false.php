<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Код подтверждения не верен";
$this->description = "";

?>

<div class="center">

    <div class="container service">

        <div class="service__message">
            <h2>Ошибка!</h2>
            <p>Код подтверждения не верен или устарел, попробуйте зарегистрироваться еще раз.</p>
        </div>

        <div class="service__back-link">
            <a href="/signup" class="link">Зарегистрироваться!</a>
        </div>

    </div>

</div>