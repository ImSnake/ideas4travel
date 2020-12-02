<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form SignupForm */

$this->title = "Ваш email успешно подтвержден";
$this->description = "";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = ['partnership/partnership.js'];

?>

<div class="center">

    <div class="container service">

        <div class="service__message">
            <h2>Спасибо за регистрацию!</h2>
            <p>Ваш адрес электронной почты успешно подтвержден.</p>
        </div>

    </div>

    <section class="authorization container">

        <?php
        $actionAuthForm = '/auth';
        include VIEWS_DIR . "auth/_auth-form.php";
        ?>

    </section>

</div>