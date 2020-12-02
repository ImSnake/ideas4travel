<?php

use app\services\renderer\TemplateRenderer;

/* @var $this TemplateRenderer */

$this->title = "Регистрация нового организатора";
$this->description = "Описание к странице Регистрация партнера";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = [
    'partnership/partnership.js',
    'jquery/jquery.inputmask.js'
];

?>

<!--<div class="center">-->

    <div class="container">

        <section class="authorization">

            <?php
            $actionSignupForm = $_SERVER['REQUEST_URI'];
            include "_signup-form.php"
            ?>

        </section>

    </div>

<!--</div>-->