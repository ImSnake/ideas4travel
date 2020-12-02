<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Заявки";
$this->description = "Описание к странице Заявки";

$this->cssFiles = ['organizer/organizer.css'];
$this->jsFiles = ['organizer/organizer_common.js'];

// Подключаем заявки.
include VIEWS_DIR . "/blocks-html/organizer/requests.php";
