<?php

use app\services\renderer\TemplateRenderer;

/* @var $this TemplateRenderer */

$this->title = "Восстановление пароля";
$this->description = "";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = [
//    'partnership/partnership.js',
//    'jquery/jquery.inputmask.js'
];

?>

<div class="container">

    <section class="authorization">

        <?php
        $actionSignupForm = $_SERVER['REQUEST_URI'];
        include "_forget-form.php"
        ?>

    </section>

</div>