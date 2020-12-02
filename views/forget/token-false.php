<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Код подтверждения не верен";
$this->description = "";

?>

<div class="container service">

    <div class="service__message">
        <h2>Ошибка!</h2>
        <p>Код подтверждения не верен или устарел</p>
        <p>Воспользуйтесь формой восстановления пароля еще раз</p>

        <div class="service__back-link">
            <a href="/forget" class="link">восстановить пароль</a>
        </div>
    </div>

</div>