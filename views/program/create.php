<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Добавление новой программы";
$this->description = "Добавление новой программы";

$this->cssFiles = ['organizer/organizer.css'];
$this->jsFiles = ['organizer/organizer_common.js', 'organizer/organizer_programs_new.js'];

// Подключаем добавление новой программы.
include VIEWS_DIR . "/blocks-html/organizer/new.php";
