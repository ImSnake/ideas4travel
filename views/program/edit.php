<?php

use app\Models\program\Program;
use app\services\renderer\TemplateRenderer;
use app\widgets\program\EditProgramDescription;
use app\widgets\program\EditProgramPlanByDays;
use app\widgets\program\EditProgramGallery;
use app\widgets\program\EditProgramAdditional;
use app\services\Geo;
use app\Models\program\PrStatusRejected;
use app\helpers\HtmlHelpers;

/* @var $errors */
/* @var $program Program */
/* @var $geo Geo */
/* @var $this TemplateRenderer */

$this->title = "Редактировать программу";
$this->description = "Редактирование программы";

$this->cssFiles = [
    'organizer/program-form.css',
    'jquery/jquery-ui.min.css',
    '../plugins/trumbowyg/dist/ideas-ui/trumbowyg.css',
    '../plugins/trumbowyg/dist/plugins/emoji/ui/trumbowyg.emoji.min.css',
];

$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_programs_new.js',
    'jquery/jquery.common_plugins.js',
    'ajax/program/create_program.js',
    'jquery/jquery-ui.min.js',
    'jquery/jquery.inputmask.js',
    '../plugins/trumbowyg/dist/trumbowyg.js',
    '../plugins/trumbowyg/dist/langs/ru.js',
    '../plugins/trumbowyg/dist/plugins/emoji/trumbowyg.emoji.min.js',
    '../plugins/trumbowyg/dist/plugins/history/trumbowyg.history.js',
//    '../plugins/trumbowyg/dist/plugins/customtitle/trumbowyg.customtitle.js',
    '../plugins/trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js',
];
?>

<section class="container new-program">

    <div class="back-n-wrap" data-page="programs">
        <a href="/programs"><span>назад в Программы</span></a>
        <div class="mobile-warning">
            <p class="red">Невозможно открыть программу: не&nbsp;хватает ширины экрана (минимум&nbsp;-&nbsp;630px).</p>
            <p>Чтобы продолжить работу, попробуйте перевернуть мобильное устройство в&nbsp;горизонтальное положение или
                войдите в&nbsp;кабинет партрнера с&nbsp;персонального компьютера.</p>
        </div>
    </div>

    <?php if ($program->status == Program::STATUS_REJECTED): ?>

        <!-- ВИДЖЕТ "program-moderation"-->
        <?php
        // Получаем комментарии к октлоненной программы.
        $programStatusRejected = (new PrStatusRejected())->getAllWhere(['program_id' => $program->id]);
        ?>

        <?php if (!empty($programStatusRejected)): ?>
            <div id="moderation-mode" class="container">
                <h4>Причины отклонения публикации</h4>
                <?php foreach ($programStatusRejected as $comment): ?>
                    <div class="group">
                        <div class="history__data"><?= date('d.m.Y', strtotime($comment['create_at'])) ?></div>
                        <div class="history__comment"><?= HtmlHelpers::wrapTextInTag($comment['comment'], 'p') ?></div>
                    </div>
                <?php endforeach; ?>
                <button class="btn-blue"><span>ВЕРНУТЬ НА МОДЕРАЦИЮ</span></button>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <div class="program-form" id="new_program_form" data-partner-id="<?= $program->partner_id ?>"
         data-program-id="<?= $program->id ?>">

        <div class="new-program-nav__steps">
            <!-- не изменять! JS привязан к классам .new-program-nav__step и  .current и атрибуту 'data-type'-->
            <span class="new-program-nav__step current" data-step="description">Описание</span>
            <span class="new-program-nav__step" data-step="gallery">Галерея</span>
            <span class="new-program-nav__step" data-step="plan-by-days">Программа</span>
            <span class="new-program-nav__step" data-step="additional">Дополнительно</span>
        </div>

        <!-- 1.ОПИСАНИЕ  \  id завязан на JS-->
        <?php new EditProgramDescription() ?>

        <!-- 2.ПЛАН ПО ДНЯМ  \  id завязан на JS-->
        <?php new EditProgramPlanByDays() ?>

        <!-- 3.ГАЛЕРЕЯ  \  id завязан на JS-->
        <?php new EditProgramGallery() ?>

        <!-- 4.Дополнительно  \  id завязан на JS-->
        <?php new EditProgramAdditional([
            'program' => $program
        ]) ?>

        <!-- ДНО СТРАНИЦЫ ФОРМЫ: КНОПКИ СОХРАНЕНИЯ -->

        <div class="bottom__button-box">

            <div>
                <button id='to-preview' class="btn-orange">
                    <span>Предпросмотр</span>
                </button>

                <button id='save-exit' class="btn-grey">
                    <a href="/programs">Сохранить&nbsp;и&nbsp;выйти</a>
                </button>
            </div>

            <div>
                <button id="previous-page" class="btn-blue hide-element">
                    <span>&#8592;&nbsp;&nbsp;назад</span>
                </button>

                <button id="next-page" class="btn-blue">
                    <span>вперед&nbsp;&nbsp;&#8594;</span>
                </button>
            </div>


        </div>


    </div>

</section>
