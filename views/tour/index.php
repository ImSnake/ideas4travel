<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Туры организатора";
$this->description = "Описание к странице Туры организатора";

$this->cssFiles = ['organizer/organizer.css'];
$this->jsFiles = ['organizer/organizer_common.js'];

// Подключаем туры.
include VIEWS_DIR . "/blocks-html/organizer/tours.php";
