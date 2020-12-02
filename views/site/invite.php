<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Партнерам";
$this->description = "Описание страницы Партнерам";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = ['partnership/partnership.js'];

?>

<div class="center">

    <div class="container">

        <section class="partnership">

            <div class="btn-blue">

                <a href="/auth/auth-signup"><span>Кабинет партнера</span></a>

            </div>

            <h2 class="block-title">Партнерам</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error illum obcaecati repudiandae. Ipsum nam
                odit
                officiis porro quam quasi quibusdam. A aspernatur consectetur earum eligendi eveniet laboriosam maxime
                provident sint!</p>

            <a href="partnership-offer.php">Договор-оферта для партнеров</a>

        </section>

    </div>

</div>
