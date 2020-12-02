<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Авторизация организатора";
$this->description = "Описание к странице Регистрация и авторизация партнера";

$this->cssFiles = ['partnership/partnership.css'];

$this->jsFiles = [
    'partnership/partnership.js',
    'jquery/jquery.inputmask.js'
];

?>

<!--<div class="center">-->

<section class="authorization container">

    <?php
    $actionSignupForm = '/signup';
    include VIEWS_DIR . "signup/_signup-form.php";

    $actionAuthForm = '/auth';
    include "_auth-form.php"
    ?>

</section>

<!--</div>-->