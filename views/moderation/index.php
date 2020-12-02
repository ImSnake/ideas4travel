<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Главная страница модератора";
$this->description = "";

$this->cssFiles = ['organizer/moderator.css'];
?>

<section class="container">

    <h2 class="block-title">Главная страница модератора</h2>

    <p>Информация для модератора</p>

        <p><a href="/moderation/programs" class="link">Список ПРОГРАМM</a></p>
        <p><a href="/moderation/partners" class="link">Список ПАРТЕНРОВ</a></p>

</section>

