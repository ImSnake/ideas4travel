<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Гиды и турлидеры";
$this->description = "Описание к странице Гиды организатора";

$this->cssFiles = ['organizer/guides.css'];
$this->jsFiles = ['organizer/organizer_common.js'];

// Подключаем гидов.
include VIEWS_DIR . "/blocks-html/organizer/guides.php";
