<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Программы организатора";
$this->description = "Описание к странице Программы организатора организатора";

$this->cssFiles = ['organizer/organizer.css'];
$this->jsFiles = ['organizer/organizer_common.js', 'organizer/organizer_programs.js'];

// Подключаем программы.
include VIEWS_DIR . "/blocks-html/organizer/programs.php";
