<?php

use app\Models\program\Program;
use app\services\renderer\TemplateRenderer;
use app\widgets\program\ProgramCard;

/* @var $errors */
/* @var $programs Program */
/* @var $this TemplateRenderer */

$this->title = "Программы организатора";
$this->description = "Описание к странице Программы организатора организатора";

$this->cssFiles = ['organizer/programs.css'];
$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_programs.js',
    'ajax/program/create_program.js',
    'ajax/tour/tour-ajax.js',
    //'jquery/jquery-ui.min.js',
];

?>

<section class="container organizer__programs">

    <div class="back-n-wrap" data-page="programs">
        <a href="/organizer"><span>назад в Меню</span></a>
        <h2>Программы туров</h2>
    </div>

    <div class="programs__block">
        <?php if (empty($programs)): ?>
            <div class="no-programs">Создай и заполни программу тура<br>
                <p>Если не знаешь с чего начать, то загляни в <a href="/support/knowledge-base#how-to-publish"
                                                                 class="link">базу знаний</a></p>
            </div>
        <?php else: ?>
            <?php foreach ($programs as $program => $value): ?>
                <?php new ProgramCard([$value]); ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <div class="programs__bottom">

        <div id="create-new" class="btn-orange">
            <span><i class="icon-doc-new"></i>создать</span>
        </div>

        <div class="btn-grey">
            <a href="/programs">Все программы</a>
        </div>

    </div>

</section>

<div id="create-new-name" class="body-disable hide-element">
    <div class="new-create">

        <span class="close-pop-up"></span>

        <form action="#">
            <h2 class="block-title"></h2>

            <div class="info-field__box">
                <div class="info-field__head"></div>
                <div class="info-field__content">
                    <input id="program-name" class="program-form__text" type="text"
                           placeholder="до 100 символов" required>
                    <span class="form-comment red"></span>
                </div>
            </div>

            <div>
                <button class="btn-blue" type="submit"><span>Далее</span></button>
            </div>
        </form>

    </div>
</div>

<!-- Pop-up для создания тура -->
<div id="add-new-date" class="body-disable hide-element">
    <div class="new-tour-list">
        <span class="close-pop-up"></span>

        <h2 class="block-title">Дата начала тура</h2>

        <form action="#" id="form-new-tour" data-program-id="">
            <div class="group">
                <input id="tour-start-at" type="date" name="" data-placeholder="дд.мм.гггг" required
                       aria-required="true" value>
                <!-- <span class="form-comment red"></span>-->
            </div>
            <span class="form-comment red"></span>
            <input id="program-id" type="hidden" name="" value="">
            <div>
                <button class="btn-blue"><span>Далее</span></button>
            </div>
        </form>

    </div>
</div>