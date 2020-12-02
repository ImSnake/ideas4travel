<?php

use app\helpers\HtmlHelpers;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\Models\tour\Tour;

/** @var $program Program */
/** @var $countryName array */
/** @var $comfort int */
/** @var $dynamic int */
/** @var $meal int */
/** @var $mainImg PrImg */

?>

<div class="program-box" data-program-id="<?= $program->id ?>" data-program-status="<?= $program->status ?>">

    <div class="program__image">

        <?php if ($mainImg): ?>
            <img src="../../images/tours/<?= $mainImg->partner_id ?>/<?= $mainImg->program_id ?>/big/<?= $mainImg->img ?>">
        <?php else: ?>
            <img src="../../images/tours/default/big/tour_default.jpg">
        <?php endif; ?>

        <div class="edit-menu hover">

            <div class="menu-list right fade hide-element">
                <span class="close-pop-up"></span>
                <div><a href="/programs/preview/<?= $program->id ?>">Предпросмотр</a></div>

                <?php if (in_array($program->status, [
                    Program::STATUS_DRAFT,
                    Program::STATUS_COMPLETED,
                    Program::STATUS_REJECTED,
                    Program::STATUS_PUBLISHED,
                    Program::STATUS_UNPUBLISHED,
                ])): ?>
                    <div><a href="/programs/edit/<?= $program->id ?>">Редактировать</a></div>
                <?php else: ?>
                    <?php if ($program->status != Program::STATUS_ARCHIVED): ?>
                        <div class="grey"><span>Редактировать</span></div>
                    <?php endif; ?>
                <?php endif; ?>

                <div><span class="submit_duplicate_program">Дублировать</span></div>

                <?php if (in_array($program->status, [
                    Program::STATUS_COMPLETED,
                    Program::STATUS_REJECTED,
                    Program::STATUS_PUBLISHED,
                    Program::STATUS_UNPUBLISHED,
                ])): ?>
                    <div class="blue add-new-date"><span>Опубликовать</span></div>
                <?php else: ?>
                    <?php if ($program->status != Program::STATUS_ARCHIVED): ?>
                        <div class="grey"><span>Опубликовать</span></div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (in_array($program->status, [
                    Program::STATUS_DRAFT,
                    Program::STATUS_COMPLETED,
                ])): ?>
                    <div class="red"><span class="link_delete_program">Удалить</span></div>
                <?php endif; ?>

                <?php if (in_array($program->status, [Program::STATUS_IN_MODERATION])
                    && Tour::isUnpublished($program->id)): ?>
                    <div class="grey"><span>Убрать в архив</span></div>
                <?php elseif (in_array($program->status, [Program::STATUS_IN_MODERATION])
                    && !Tour::isUnpublished($program->id)): ?>
                    <div class="grey"><span>Удалить</span></div>
                <?php endif; ?>

                <?php if (in_array($program->status, [Program::STATUS_REJECTED])
                    && Tour::isUnpublished($program->id)): ?>
                    <div class="red"><span class="link_archive_program">Убрать в архив</span></div>
                <?php elseif (in_array($program->status, [Program::STATUS_REJECTED])
                    && !Tour::isUnpublished($program->id)): ?>
                    <div class="red"><span class="link_delete_program">Удалить</span></div>
                <?php endif; ?>

                <?php if (in_array($program->status, [Program::STATUS_UNPUBLISHED])): ?>
                    <div class="red"><span class="link_archive_program">Убрать в архив</span></div>
                <?php endif; ?>

                <?php if (in_array($program->status, [Program::STATUS_PUBLISHED])): ?>
                    <div class="grey"><span>Убрать в архив</span></div>
                <?php endif; ?>

            </div>

        </div>

        <?php if (in_array($program->status, [Program::STATUS_COMPLETED])): ?>
            <?php $classStatus = 'filed' ?>
        <?php elseif (in_array($program->status, [Program::STATUS_REJECTED, Program::STATUS_IN_MODERATION])): ?>
            <?php $classStatus = 'moderation' ?>
        <?php elseif (in_array($program->status, [Program::STATUS_PUBLISHED, Program::STATUS_UNPUBLISHED])): ?>
            <?php $classStatus = 'published' ?>
        <?php else: ?>
            <?php $classStatus = '' ?>
        <?php endif; ?>
        <div class="image__bottom-left-tag <?= $classStatus ?>">
            <?php if ($program->status == Program::STATUS_REJECTED): ?>
                <div class="rejected"></div>
            <?php endif; ?>
            <span><?= (Program::STATUS_NAMES)[$program->status] ?></span>
        </div>

    </div>

    <div class="program__info">

        <div class="program__country"><?= $countryName ?></div>

        <div class="program__name"><?= $program->name ?></div>

        <div class="program__stats">

            <div class="program__comfort">
                <span><?= $comfort ?></span>
                <span class="slash-txt">3</span>
                <span class="txt-small-narrow">комфорт</span>
            </div>

            <div class="program__dynamics">
                <span><?= $dynamic ?></span>
                <span class="slash-txt">3</span>
                <span class="txt-small-narrow">динамика</span>
            </div>

            <div class="program__meal">
                <span><?= $meal ?></span>
                <span class="slash-txt">3</span>
                <span class="txt-small-narrow">питание</span>
            </div>

        </div>

    </div>

</div>