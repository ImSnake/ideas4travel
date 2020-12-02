<?php

use app\Models\tour\Tour;
use app\helpers\HtmlHelpers;
use app\Models\program\Program;

/* @var $program array */
/* @var $imgMain string */
/* @var $countryName array */

?>

<div class="programs-table__row">

    <div class="programs-table__img">
        <?php if ($imgMain[0]['img']): ?>
            <img src="/images/tours/<?= $program['partner_id'] ?>/<?= $program['id'] ?>/micro/<?= $imgMain[0]['img'] ?>"
                 alt="tour-img">
        <?php else: ?>
            <img src="/images/tours/default/micro/tour_default.jpg"
                 alt="tour-img">
        <?php endif; ?>
    </div>

    <div class="programs-table__info">
        <div class="programs-table__duration"><?= $program['duration'] ? $program['duration'] . ' ' . HtmlHelpers::dayDeclination((int)$program['duration']) : '-' ?></div>
        <div class="programs-table__direction"><?= implode(', ', $countryName) ?></div>
        <div class="programs-table__name" data-program-id="<?= $program['id'] ?>"><?= $program['name'] ?></div>
    </div>

    <div class="programs-table__action">
        <?php if (in_array($program['status'], [Program::STATUS_COMPLETED, Program::STATUS_PUBLISHED, Program::STATUS_UNPUBLISHED])): ?>
            <div class="btn-blue"><span>Выбрать</span></div>
        <?php elseif ($program['status'] == Program::STATUS_IN_MODERATION): ?>
            <div class="btn-blue"><span>Выбрать</span></div>
        <?php else: ?>
            <div class="btn-grey"><a href="/programs/edit/<?= $program['id'] ?>"><span>Заполнить</span></a></div>
        <?php endif; ?>
    </div>

</div>