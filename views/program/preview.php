<?php

use app\Models\program\Program;
use app\services\renderer\TemplateRenderer;
use app\widgets\program\Preview;
use app\Models\Partner;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $program Program */
/* @var $partner Partner */

$this->title = "Предварительный просмотр";

$this->cssFiles = ['tour/tour.css']; /*'organizer/organizer-nav.css'*/
$this->jsFiles = [
    'tour/tour.js',
    'tour/gallery.js',
    'tour/GalleryRender.js',
    'organizer/organizer_common.js',
//    'ajax/program/create_program.js',
    'ajax/tour/tour_get-contacts.js',
];

// Подключаем виджет страницы превью программы
new Preview(['program' => $program, 'partner' => $partner]);