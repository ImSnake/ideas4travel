<?php

use app\base\App;
use app\Models\tour\Tour;
use app\services\Currency;

/* @var $toursBySort array */
/* @var $tourStatus integer */
/* @var $arrStatus array */
/* @var $arrSeason array */
/* @var $arrCurrency array */

/** @var Currency $currency */
$currency = App::get()->currency;

?>

<div class="tours-table__head">
    <div class="tours-table__program">Программа</div>
    <div class="tours-table__sub-row">
        <div class="group">
            <div class="tours-table__data">Начало</div>
            <div class="tours-table__duration">Дней</div>
            <div class="tours-table__available">Мест</div>
            <div class="tours-table__price">Цена</div>
            <div class="tours-table__discount">Скидка</div>
            <!--            <div class="tours-table__guide">Гид</div>-->
            <div class="tours-table__status">Статус</div>
            <div class="tours-table__season">Сезон</div>
            <div class="tours-table__edit">...</div>
        </div>
    </div>
</div>

<?php foreach ($toursBySort as $items): ?>

    <?php
    // TODO убрать
    // var_dump($items);
    ?>

    <div class="tours-table__row">
        <div class="tours-table__program">
            <div class="tours-table__img">
                <img src="/images/tours/<?= $items[0]['partner_id'] ?>/<?= $items[0]['program_id'] ?>/micro/<?= $items[0]['img'] ?>"
                     alt="tour-img">
            </div>
            <div class="tours-table__program-name"
                 data-program-id="<?= $items[0]['program_id'] ?>"><?= mb_strtoupper($items[0]['name']) ?></div>
        </div>
        <div class="tours-table__sub-row">

            <?php foreach ($items as $item): ?>

                <div class="group" data-tour-id="<?= $item['tour_id'] ?>">
                    <div class="tours-table__data">
                        <?= date('d.m.Y', strtotime($item['start_at'])) ?>
                    </div>
                    <div class="tours-table__duration">
                        <?= $item['duration'] ? $item['duration'] : '-' ?>
                    </div>
                    <div class="tours-table__available">
                        <?= $item['available'] ? $item['available'] : '-' ?>
                    </div>
                    <div class="tours-table__price">
                        <?= $item['price'] ? $currency->format($item['price']) . " " . $currency->getCurrency()[$item['currency']]['symbol'] : '-' ?>
                    </div>
                    <div class="tours-table__discount">
                        <?= $item['discount'] ? $item['discount'] : '-' ?>
                    </div>
                    <!--            <div class="tours-table__guide">Мусияченко Нина Анатольевна</div>-->
                    <?php $key_status = array_search($item['t_status_id'], array_column($arrStatus, 'id')); ?>
                    <div class="tours-table__status"><?= $item['t_status_id'] ? $arrStatus[$key_status]['name'] : '-' ?></div>
                    <?php $key_season = array_search($item['t_season_id'], array_column($arrSeason, 'id')); ?>
                    <div class="tours-table__season"><?= $item['t_season_id'] ? $arrSeason[$key_season]['name'] : '-' ?></div>
                    <div class="tours-table__edit">

                        <?php if ($tourStatus == Tour::TOUR_STATUS_PUBLISHED): ?>
                            <div class="edit-menu hover">
                                <div class="menu-list right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <div><a href="/tours/edit/<?= $item['tour_id'] ?>">Редактировать</a></div>
                                    <div class="duplicate-tour"><span>Дублировать</span></div>
                                    <div class=" red finish-tour"><span>Снять с публикации</span></div>
                                </div>
                            </div>
                        <?php elseif ($tourStatus == Tour::TOUR_STATUS_IN_MODERATION): ?>
                            <img src="/images/icons/icon_on-moderation.svg" alt="">
                        <?php elseif ($tourStatus == Tour::TOUR_STATUS_UNPUBLISHED): ?>
                            <div class="edit-menu hover">
                                <div class="menu-list right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <div class="blue publish-tour"><a href="#">Опубликовать</a></div>
                                    <div><a href="/tours/edit/<?= $item['tour_id'] ?>">Редактировать</a></div>
                                    <div class="duplicate-tour"><span>Дублировать</span></div>
                                    <div class="red delete-tour"><span>Удалить</span></div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

<?php endforeach; ?>

