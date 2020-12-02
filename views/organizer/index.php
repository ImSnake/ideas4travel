<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Профиль организатора";
$this->description = "Описание к странице Профиль организатора";

$this->cssFiles = ['organizer/organizer.css'];
$this->jsFiles = ['organizer/organizer_common.js', 'organizer/organizer_profile.js'];

// Подключаем пустую форму для заполнения ЮЛ.
include VIEWS_DIR . "/blocks-html/organizer/organizer_UL_empty.php";
