<?php

use app\services\renderer\TemplateRenderer;
use app\widgets\tour\ItemTour;
use app\Models\tour\Tour;
use app\widgets\tour\ItemProgram;

/* @var $toursBySort array */
/* @var $arrStatus array */
/* @var $arrSeason array */
/* @var $arrCurrency array */
/* @var $programsByPartner array */
/* @var $this TemplateRenderer */

$this->title = "Туры на сайте";
$this->description = "Описание к странице Туры организатора";

$this->cssFiles = ['organizer/tours.css'];

$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_tours.js',
    'jquery/jquery.common_plugins.js',
    'ajax/tour/tour-ajax.js',
];

// Подключаем туры.
//include VIEWS_DIR . "/blocks-html/organizer/tours.php";

?>

<section class="container organizer__tours">

    <div class="back-n-wrap" data-page="tours">
        <a href="/organizer"><span>назад в Меню</span></a>
        <!--        <h2>Туры на сайте</h2>-->
    </div>

    <?php if ($toursBySort[Tour::TOUR_STATUS_PUBLISHED]): ?>

        <h3 class="tours__heading blue">Опубликованные туры</h3>

        <div class="tours-table published">

            <?php
            // Подключаем виджет элемента тура.
            new ItemTour([
                'toursBySort' => $toursBySort[Tour::TOUR_STATUS_PUBLISHED],
                'tourStatus' => Tour::TOUR_STATUS_PUBLISHED,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency
            ]);
            ?>

        </div>

    <?php endif; ?>

    <?php if ($toursBySort[Tour::TOUR_STATUS_IN_MODERATION]): ?>

        <h3 class="tours__heading light-grey">На модерации</h3>

        <div class="tours-table moderation">

            <?php
            // Подключаем виджет элемента тура.
            new ItemTour([
                'toursBySort' => $toursBySort[Tour::TOUR_STATUS_IN_MODERATION],
                'tourStatus' => Tour::TOUR_STATUS_IN_MODERATION,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency
            ]);
            ?>

        </div>

    <?php endif; ?>

    <?php if ($toursBySort[Tour::TOUR_STATUS_UNPUBLISHED]): ?>

        <h3 class="tours__heading grey">Не опубликованные туры</h3>

        <div class="tours-table unpublished">

            <?php
            // Подключаем виджет элемента тура.
            new ItemTour([
                'toursBySort' => $toursBySort[Tour::TOUR_STATUS_UNPUBLISHED],
                'tourStatus' => Tour::TOUR_STATUS_UNPUBLISHED,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency
            ]);
            ?>

        </div>

    <?php endif; ?>

    <?php if (!$toursBySort[Tour::TOUR_STATUS_UNPUBLISHED] && !$toursBySort[Tour::TOUR_STATUS_IN_MODERATION] && !$toursBySort[Tour::TOUR_STATUS_PUBLISHED]): ?>
        <div class="no-tours">Создай тур из заполненной программы
            <p>О том, что такое тур и чем он отличается от программы читай в <a
                        href="/support/knowledge-base#how-to-publish" class="link">базе знаний</a></p></div>
    <?php endif; ?>

    <div class="tours__bottom">
        <div id="create-new" class="btn-orange">
            <span><i class="icon-doc-new"></i>добавить тур</span>
        </div>

        <!--        <div class="btn-grey">
                    <span>Завершенные</span>
                </div>-->
    </div>

    <?php if ($toursBySort[Tour::TOUR_STATUS_FINISHED]): ?>

        <h3 class="tours__heading grey">Завершенные туры</h3>

        <div class="tours-table unpublished">

            <?php
            // Подключаем виджет элемента тура.
            new ItemTour([
                'toursBySort' => $toursBySort[Tour::TOUR_STATUS_FINISHED],
                'tourStatus' => Tour::TOUR_STATUS_FINISHED,
                'arrStatus' => $arrStatus,
                'arrSeason' => $arrSeason,
                'arrCurrency' => $arrCurrency
            ]);
            ?>

        </div>

    <?php endif; ?>

</section>

<!-- Pop-up со списком программ для создания тура -->
<div id="create-new-tour" class="body-disable hide-element">
    <div class="new-tour-list">
        <span class="close-pop-up"></span>

        <h2 class="block-title">Добавить тур к программе</h2>

        <?php if ($programsByPartner): ?>
            <div class="programs-table">
                <?php foreach ($programsByPartner as $item): ?>
                    <?php new ItemProgram(['program' => $item]); ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div id="no-active-programs">
                <h3>Нет доступных для публикации программ</h3>
            </div>
        <?php endif; ?>

        <p>Чтобы опубликовать тур на сайте, создай и заполни <a href="/programs" class="link">Программу тура</a></p>
    </div>

</div>

<!-- Pop-up для создания тура -->
<div id="add-new-date" class="body-disable hide-element">
    <div class="new-tour-list">
        <span class="close-pop-up"></span>

        <h2 class="block-title">Дата начала тура</h2>

        <form action="#" id="form-new-tour" data-program-id="" data-tour-id="">
            <div class="group">
                <input type="date" id="tour-start-at" name="" data-placeholder="дд.мм.гггг" required
                       aria-required="true" value>
                <!--<span class="form-comment red"></span>-->
            </div>
            <span class="form-comment red"></span>
            <input type="hidden" id="program-id" name="" value="">
            <input type="hidden" id="tour-id" name="" value="">
            <div>
                <button class="btn-blue"><span>Далее</span></button>
            </div>
        </form>

    </div>
</div>

<!-- Pop-up для снятия тура с публикации -->
<div id="finish-tour" class="body-disable hide-element">
    <div class="new-tour-list">

        <span class="close-pop-up"></span>

        <h2 class="block-title">Причина</h2>

        <form action="#" method="post" id="unpublish-tour">

            <input type="radio" id="full-group" name="finish_reason" value="<?= Tour::STATUS_COMPLETED ?>">
            <label for="full-group"><span>Группа набрана</span></label>

            <input type="radio" id="tour-canceled" name="finish_reason" value="<?= Tour::STATUS_CANCELLED ?>">
            <label for="tour-canceled"><span>Тур отменен</span></label>

            <input type="radio" id="hold-tour" name="finish_reason" value="<?= Tour::STATUS_UNPUBLISHED ?>">
            <label for="hold-tour"><span>Приостановить на время</span></label>

            <input type="radio" id="other-reason" name="finish_reason" value="<?= Tour::STATUS_FINISHED ?>">
            <label for="other-reason"><span>Другое</span></label>

            <input type="hidden" id="finish-tour-id" name="tour_id" value="">

            <button type="button" class="btn-orange"><span>Снять с публикации</span></button>

        </form>
    </div>
</div>