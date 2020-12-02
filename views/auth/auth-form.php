<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Авторизация партнера";
$this->description = "Описание к странице Авторизация партнера";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = ['partnership/partnership.js'];

?>

<div class="center">

    <section class="authorization container">

        <?php
        $actionAuthForm = $_SERVER['REQUEST_URI'];
        include "_auth-form.php"
        ?>

    </section>

</div>