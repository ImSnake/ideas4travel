<?php

use app\base\App;
use app\helpers\HtmlHelpers;
use app\Models\organizer\Company;
use app\Models\organizer\Person;
use app\Models\Partner;
use app\Models\program\PrDay;
use app\Models\program\PrGeo;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\Models\tour\ExtraCost;
use app\Models\User;
use app\services\Geo;
use app\Models\program\PrStatusRejected;
use app\Models\tour\Tour;
use app\helpers\PriceHelpers;
use app\helpers\DateHelpers;

/* @var $partner Partner */
/* @var $partnerProfile Person|Company */
/* @var $program Program */
/* @var $tours array */
/* @var $geo Geo */
/* @var $countryName array */
/* @var $countryCount int */
/* @var $comfort int */
/* @var $dynamic int */
/* @var $meal int */

/** @var $mainImg PrImg */
/** @var $mapImg PrImg */
/** @var $allImg array */
/** @var $videos array */

/* @var $route_stats array */
/** @var $arrTourTypeIds array */
/** @var $arrTargetAudienceIds array */

/** @var $arrPointName array */
/** @var $arrActivityName array */

/** @var $arrAllFilters array */
/** @var $arrFiltersIds array */

/** @var $arrTransfer array */
/** @var $arrDayGeoByCountry array */
/** @var $arrDays array */
/** @var $distance int */

/** @var int $countImg общее количество фотографий в программе */
$countImg = 0;
/** @var int $countAllImg общее количество фотографий в фото-архиве */
$countAllImg = 0;

//var_dump($countryName);

if ($allImg) {
    $countAllImg = count($allImg);
    $countImg += $countAllImg;
}

if ($mainImg) {
    $countImg++;
}

if ($mapImg) {
    $countImg++;
}

$countDays = count($arrDays);

$currency = App::get()->currency;
$getUserCurrencyID = $currency->getUserCurrencyID();

?>

<?php if (App::get()->auth->getRole() == User::ROLE_USER): ?>

    <div class="container programs__preview back-n-wrap" data-page="">
        <a href="/programs"><span>назад в Программы</span></a>
    </div>

    <?php if (!in_array($program->status, [Program::STATUS_IN_MODERATION, Program::STATUS_ARCHIVED])): ?>
        <!-- ВИДЖЕТ "program-edit-bar"-->
        <div class="container">
            <div id='program-edit-bar'>
                <button class="btn-orange">
                    <a href="/programs/edit/<?= $program->id ?>">Редактировать</a>
                </button>
            </div>
        </div>
    <?php endif; ?>

<?php elseif (App::get()->auth->getRole() == User::ROLE_MODERATOR): ?>
    <!-- ВИДЖЕТ "program-moderation"-->
    <div id="program-moderation" class="container" data-program-id="<?= $program->id ?>">

        <?php if (in_array($program->status, [Program::STATUS_PUBLISHED, Program::STATUS_UNPUBLISHED])): ?>
            <h4 class="green">ПРОГРАММА ПРОШЛА МОДЕРАЦИЮ</h4>
        <?php elseif ($program->status == Program::STATUS_IN_MODERATION): ?>
            <h4 class="orange">ПРОГРАММА НА МОДЕРАЦИИ</h4>
        <?php elseif ($program->status == Program::STATUS_REJECTED): ?>
            <h4 class="red">ПРОГРАММА ОТКЛОНЕНА</h4>
        <?php endif; ?>

        <?php if (in_array($program->status, [Program::STATUS_IN_MODERATION, Program::STATUS_REJECTED])): ?>
            <div class="moderation__history">

                <?php
                // Получаем комментарии к октлоненной программы.
                $programStatusRejected = (new PrStatusRejected())->getAllWhere(['program_id' => $program->id]);
                ?>

                <?php if (!empty($programStatusRejected)): ?>
                    <?php foreach ($programStatusRejected as $comment): ?>
                        <div class="group">
                            <div class="history__data"><?= date('d.m.Y', strtotime($comment['create_at'])) ?></div>
                            <div class="history__comment"><?= HtmlHelpers::wrapTextInTag($comment['comment'],
                                    'p') ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if ($program->status == Program::STATUS_IN_MODERATION): ?>
            <button id="button-approve">ПОДТВЕРДИТЬ</button>
            <!--            <form id="form-rejected">-->
            <label for="moderation__comment">Комментарий модератора</label>
            <textarea name="" id="moderation__comment" required></textarea>
            <button id="button-reject">ОТКЛОНИТЬ</button>
            <!--            </form>-->
        <?php endif; ?>

    </div>
<?php endif; ?>

<div id="tour_view" class="tour_view" data-partner-id="<?= $program->partner_id ?>"
     data-program-id="<?= $program->id ?>">

    <nav id="nav-tour" class="nav-tour"> <!--навигация для таблет и десктоп-->

        <ul class="container nav-tour__menu">

            <li class="nav-tour__link">
                <a href="#tour-header">Описание</a>
            </li>

            <li class="nav-tour__link">
                <a href="#tour-program">Программа</a>
            </li>

            <li class="nav-tour__link">
                <a href="#tour-schedule">Даты&nbsp;и&nbsp;цены</a>
            </li>

            <li class="nav-tour__link">
                <a href="#tour-additional">Дополнительно</a>
            </li>

            <li class="nav-tour__link">
                <a href="#tour-contacts">Организатор</a>
            </li>

        </ul>

    </nav> <!--навигация для таблет и десктоп-->

    <section id="tour-header" class="container">

        <h2><?= implode(', ', $countryName) ?></h2>

        <!-- <h1><? /*= mb_strtoupper($program->name); */ ?></h1>-->
        <h1><?= $program->name ?></h1>

        <div class="header__tags">
            <!--            <h4 class="">тип тура</h4>-->
            <?php foreach (Program::getArrTourType() as $key => $val): ?>
                <?php if (in_array($val['id'], $arrTourTypeIds)): ?>
                    <span class="header__item"><?= $val['name'] ?></span>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($countryCount > 1): ?>
                <span class="header__item">Мульти-тур</span>
            <?php endif; ?>
        </div>

    </section>  <!--заголовок тура (список стран и название) -->

    <!-- GALLERY -->
    <section id="tour-gallery"> <!--tour main images-->

        <div class="container">

            <div class="tour__main-image">

                <?php if ($mainImg): ?>
                    <img src="../../images/tours/<?= $mainImg->partner_id ?>/<?= $mainImg->program_id ?>/big/<?= $mainImg->img ?>"
                         alt="main-image">
                <?php else: ?>
                    <img src="../../images/tours/default/big/tour_default.jpg" alt="main-image">
                <?php endif; ?>

                <div class="switch-to-gallery">

                    <!--                    <i class="icon-camera"></i><span>(<? /*= $countImg */ ?>)</span>-->
                    <div id='show-gallery' class="group">
                        <i class="icon-camera"></i>
                        <span>(<?= $countImg ?>)</span>
                    </div>

                    <div id='play-video' class="group">
                        <i class="icon-videocam-3"></i>
                        <span id="gallery-video" data-video-id="<?= $videos['ids'] ?>">(<?= $videos['count'] ?>)</span>
                    </div>

                </div>

            </div>

            <div class="tour__image-bar">
                <?php for ($i = 0; $i < $countAllImg; $i++): ?>
                    <?php if ($i < 5): ?>
                        <div>
                            <img src="../../images/tours/<?= $allImg[$i]['partner_id'] ?>/<?= $allImg[$i]['program_id'] ?>/mini/<?= $allImg[$i]['img'] ?>"
                                 alt="gallery"></div>
                    <?php else: ?>
                        <div class="image_bar__tablet">
                            <img src="../../images/tours/<?= $allImg[$i]['partner_id'] ?>/<?= $allImg[$i]['program_id'] ?>/mini/<?= $allImg[$i]['img'] ?>"
                                 alt="gallery"></div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

        </div>

    </section>

    <div class="mobile-section-heading">
        <div class="container group">
            <h2>Описание</h2>
            <span class="toggle pointer-down"></span>
        </div>
    </div>

    <!-- ОПИСАНИЕ -->
    <!--    --><?php //new PreviewDescription(['program' => $program, 'countryCount' => $countryCount]); ?>

    <section id="tour-description" class="container">

        <div class="tour__right-bar">

            <div class="description__people">
                <h3 class="description__heading">Кому подойдет</h3>
                <?php foreach (Program::getArrTargetAudience() as $key => $val): ?>
                    <?php if (in_array($val['id'], $arrTargetAudienceIds)): ?>
                        <div class="cover-box"><?= $val['name'] ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="tour_tags">

                <div class="place-tags">

                    <div class="description__table">


                        <h3 class="description__heading">где побываем</h3>

                        <?php foreach ($arrAllFilters[1]['data'] as $item): ?>

                            <div class="table_field">

                                <?php
                                // Подсчитываем количество элементов в каждой рубрике второго уровня.
                                $valIdLev_2 = [];
                                foreach ($item['data'] as $val) {
                                    if (in_array($val['id'], $arrFiltersIds)) {
                                        $valIdLev_2[] = $val['id'];
                                        break;
                                    }
                                }
                                ?>

                                <?php if (!empty($valIdLev_2)): ?>

                                    <h4 class="table__heading"><?= $item['name'] ?></h4>

                                    <div class="table__content">

                                        <?php foreach ($item['data'] as $val): ?>

                                            <?php if (in_array($val['id'], $arrFiltersIds)): ?>
                                                <div class="string"><?= $val['name'] ?></div>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>

                                <?php $valIdLev_2 = []; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

                <div class="activity-tags">

                    <div class="description__table">
                        <h3 class="description__heading">чем займемся</h3>

                        <?php foreach ($arrAllFilters[2]['data'] as $item): ?>

                            <div class="table_field">

                                <?php
                                // Подсчитываем количество элементов в каждой рубрике второго уровня.
                                $valIdLev_2 = [];
                                foreach ($item['data'] as $val) {
                                    if (in_array($val['id'], $arrFiltersIds)) {
                                        $valIdLev_2[] = $val['id'];
                                        break;
                                    }
                                }
                                ?>

                                <?php if (!empty($valIdLev_2)): ?>

                                    <h4 class="table__heading"><?= $item['name'] ?></h4>

                                    <div class="table__content">

                                        <?php foreach ($item['data'] as $val): ?>

                                            <?php if (in_array($val['id'], $arrFiltersIds)): ?>
                                                <div class="string"><?= $val['name'] ?></div>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>

                                <?php $valIdLev_2 = []; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

            <div class="tour_actions"></div>

        </div>

        <div class="main-stats">

            <div class="day-group-age">

                <div class="duration">
                    <span><?= $program->duration ?></span>
                    <span class="small-txt"><?= HtmlHelpers::getDeclination($program->duration,
                            ['день', 'дня', 'дней']) ?></span>
                </div>

                <div class="group-size">
                    <?php if (!is_null($program->group_min) && !is_null($program->group_max) && ($program->group_max != $program->group_min)): ?>
                        <span><?= $program->group_min ?>-<?= $program->group_max ?></span>
                        <span class="small-txt"><?= HtmlHelpers::getDeclination($program->group_max,
                                ['человека', 'человек', 'человек']) ?></span>
                    <?php elseif ($program->group_max = $program->group_min): ?>
                        <span><?= $program->group_min ?></span>
                        <span class="small-txt"><?= HtmlHelpers::getDeclination($program->group_min,
                                ['человек', 'человека', 'человек']) ?></span>
                    <?php elseif (!is_null($program->group_min) && is_null($program->group_max)): ?>
                        <span><?= $program->group_min ?></span>
                        <span class="small-txt"><?= HtmlHelpers::getDeclination($program->group_min,
                                ['человек', 'человека', 'человек']) ?></span>
                    <?php elseif (is_null($program->group_min) && !is_null($program->group_max)): ?>
                        <span><?= $program->group_max ?></span>
                        <span class="small-txt"><?= HtmlHelpers::getDeclination($program->group_max,
                                ['человек', 'человека', 'человек']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="age-limit"><?= ($program->age_min != '') ? $program->age_min : '' ?></div>

            </div>

            <div class="comfort-dynamics-meal">

                <?php if ($comfort): ?>
                    <div class="comfort">
                        <div><?= $comfort['html_view'] ?></div>
                        <div class="small-txt"><?= $comfort['name_user'] ?></div>
                    </div>
                <?php endif; ?>

                <?php if ($dynamic): ?>
                    <div class="dynamics">
                        <div><?= $dynamic['html_view'] ?></div>
                        <div class="small-txt"><?= $dynamic['name_user'] ?></div>
                    </div>
                <?php endif; ?>

                <?php if ($meal): ?>
                    <div class="meal">
                        <div><?= $meal['html_view'] ?></div>
                        <div class="small-txt"><?= $meal['name_user'] ?></div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <h3 class="program__heading">Описание</h3>

        <div class="description__about">

            <?= HtmlHelpers::wrapTextInTag($program->about, 'p') ?>
        </div>

        <div class="description__stats">

            <div class="stats__start-finish">
                <div class="group">
                    <img src="../../images/icons/icon_tour-start.svg" alt="">
                    <div>
                        <div class="title">старт</div>
                        <div class="country"><?= $route_stats['start_country'] ?></div>
                        <div class="city"><?= $route_stats['start_city'] ?></div>
                    </div>
                </div>
                <img class="line" src="../../images/icons/icon_line-vertical.svg" alt="">
                <div class="group">
                    <img src="../../images/icons/icon_tour-finish.svg" alt="">
                    <div>
                        <div class="title">финиш</div>
                        <div class="country"><?= $route_stats['finish_country'] ?></div>
                        <div class="city"><?= $route_stats['finish_city'] ?></div>
                    </div>
                </div>
            </div>

            <?php if ($mapImg): ?>

                <div class="map__img">

                    <div class="map__top-right-tag">
                        <span><?= $countDays ?></span><?= HtmlHelpers::dayDeclination($countDays) ?>
                    </div>

                    <img id="map__img"
                         src="../../images/tours/<?= $mapImg->partner_id ?>/<?= $mapImg->program_id ?>/big/<?= $mapImg->img ?>"
                         alt="tour-map">

                    <?php if ($distance): ?>
                        <div class="map__bottom-left-tag"><span><?= $distance ?></span>км</div>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php if (!empty($arrDayGeoByCountry) || !empty($arrActivityName) || !empty($arrPointName) || !empty($arrTransfer)): ?>
                <div class="program__stats">
                    <!--                    <h3 class="program__heading">Коротко о главном</h3>-->

                    <?php if (!empty($arrActivityName)): ?>
                        <div class="stats__table">

                            <div class="stats__heading">
                                <span class="program__activities"></span>
                                <span class="stats__title">Активности</span>
                                <span class="stats__qty">(<?= count($arrActivityName) ?>)</span>
                                <span class="toggle pointer-down"></span>
                            </div>
                            <div class="stats__content list-point hide-element">
                                <?php foreach ($arrActivityName as $activityName): ?>
                                    <p><?= $activityName ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arrPointName)): ?>
                        <div class="stats__table">

                            <div class="stats__heading">
                                <span class="program__places"></span>
                                <span class="stats__title">Локации</span>
                                <span class="stats__qty">(<?= count($arrPointName) ?>)</span>
                                <span class="toggle pointer-down"></span>
                            </div>

                            <div class="stats__content list-point hide-element">
                                <?php foreach ($arrPointName as $pointName): ?>
                                    <p><?= $pointName ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arrTransfer)): ?>
                        <div class="stats__table">

                            <div class="stats__heading">
                                <span class="program__transfer"></span>
                                <span class="stats__title">Перемещения</span>
                                <span class="stats__qty">(<?= count($arrTransfer) ?>)</span>
                                <span class="toggle pointer-down"></span>
                            </div>

                            <div class="stats__content hide-element">
                                <?php foreach ($arrTransfer as $transfer): ?>
                                    <p><?= $transfer['name'] ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($arrDayGeoByCountry)): ?>
                        <div class="stats__table">

                            <div class="stats__heading">
                                <span class="program__nights"></span>
                                <span class="stats__title">Ночёвки</span>
                                <span class="toggle pointer-down"></span>
                            </div>

                            <div class="stats__content hide-element">

                                <?php foreach ($arrDayGeoByCountry as $key => $val): ?>
                                    <div class="nights__locations">
                                        <span class="stats__country"><?= $geo->getCountryName($key) ?></span>
                                        <span class="stats__cities">
                                    <?php $arrCityName = []; ?>
                                    <?php foreach ($val as $elem): ?>
                                        <?php
                                        array_push($arrCityName, $geo->getCityName($elem['city_id']));
                                        $arrCityNameString = implode($arrCityName, ', ');
                                        ?>
                                    <?php endforeach; ?>
                                    <?= $arrCityNameString ?>
                                </span>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <!--<div class="route-stats__box">
                <div class="route-stats__start">
                    <div class="start__img"></div>
                    <div class="start__country"><?= $route_stats['start_country'] ?></div>
                    <div class="start__city"><?= $route_stats['start_city'] ?></div>
                </div>
                <div class="route-stats_center">
                                        <?php /*if (!empty($arrPointName)): */ ?>
                        <div class="stats__places">
                            <span><? /*= count($arrPointName) */ ?></span><? /*= HtmlHelpers::getDeclination(count($arrPointName),
                                ['локация', 'локации', 'локаций']) */ ?></div>
                    <?php /*else: */ ?>
                        <div class="stats__places"><span></span></div>
                    <?php /*endif; */ ?>
                    <div class="stats__places"><span></span></div>
                    <div class="stats__img"></div>
                    <div class="stats__activities"><span></span></div>
                    <?php /*if (!empty($arrActivityName)): */ ?>
                        <div class="stats__activities">
                            <span><? /*= count($arrActivityName) */ ?></span><? /*= HtmlHelpers::getDeclination(count($arrPointName),
                                ['активность', 'активности', 'активностей']) */ ?></div>
                    <?php /*else: */ ?>
                        <div class="stats__activities"><span></span></div>
                    <?php /*endif; */ ?>
                </div>
                <div class="route-stats__finish">
                    <div class="finish__img"></div>
                    <div class="finish__country"><?= $route_stats['finish_country'] ?></div>
                    <div class="finish__city"><?= $route_stats['finish_city'] ?></div>
                </div>
            </div>-->

        </div>

    </section>

    <div class="mobile-section-heading">
        <div class="container group">
            <h2>Программа</h2>
            <span class="toggle pointer-down"></span>
        </div>
    </div>

    <!-- ПРОГРАММА ПО ДНЯМ -->
    <section id="tour-program" class="container">

        <h3 class="program__heading">Программа по дням</h3>

        <div class="days__list">

            <?php foreach ($arrDays as $day): ?>
                <div class="day__circle"><?= $day->day ?></div>
            <?php endforeach; ?>

        </div>

        <div class="days__block">

            <?php foreach ($arrDays as $day): ?>

                <?php
                // ЭТОТ PHP блок переедет в виджет карточки дня, пока он будет жить сдесь.

                /**  @var $day PrDay */

                // Получаем локации.
                $dayPoint = $day->getDayPoint();
                // Получаем массив из названий локаций.
                $dayPointNameArray = [];
                if (!empty($dayPoint)) {
                    foreach ($dayPoint as $value) {
                        $dayPointNameArray[] = $value['name'];
                    }
                }

                // Получаем активности.
                $dayActivity = $day->getDayActivity();
                // Получаем массив из названий активностей.
                $dayActivityNameArray = [];
                if (!empty($dayActivity)) {
                    foreach ($dayActivity as $value) {
                        $dayActivityNameArray[] = $value['name'];
                    }
                }

                // Получаем питание.
                $dayMealName = $day->getDayMealName();

                // Получаем размещение.
                $dayAccommodation = $day->getAccommodation();
                $dayAccommodationRoom = $day->getAccommodationRoom();

                /** @var PrGeo $dayGeo Получаем геолакацию по дню. */
                $dayGeo = (new PrGeo())->getOne($day->geo_id);
                // Название страны и города.
                $dayCountryName = $geo->getCountryName($dayGeo->country_id);
                $dayCityName = $geo->getCityName($dayGeo->city_id);

                // Получаем трансфер для дня.
                $arrDayTransfer = $day->getDayTransferInfo();
                $arrDayTransferName = [];
                foreach ($arrDayTransfer as $value) {
                    $arrDayTransferName[] = $value['name'];
                }
                $dayTransferNameString = implode($arrDayTransferName, ', ');
                $arrDayTransferName = [];

                // Получаем картинку дня.
                $dayImg = (new PrImg())->getOne($day->img_id);

                ?>

                <div id="day-<?= $day->day ?>" class="day__window hide-element">

                    <div class="day__number"><?= $day->day ?> день</div>

                    <?php if ($dayImg): ?>
                        <img src="/images/tours/<?= $dayImg->partner_id ?>/<?= $dayImg->program_id ?>/middle/<?= $dayImg->img ?>"
                             alt="<?= $dayImg->description ?>">
                    <?php endif; ?>

                    <?php if ($program->duration > $day->day): ?>
                        <div class="day__row">
                            <div class="day__title">
                                <span class="day__night"></span>
                            </div>
                            <div class="day__content">
                                <?php if (!empty($dayCountryName) && !empty($dayCityName)): ?>
                                    <span class="night__country"><?= $dayCountryName ?></span>
                                    <span class="night__city">, <?= $dayCityName ?></span>
                                <?php else: ?>
                                    <span class="night__country"><?= $dayCountryName ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($program->duration > $day->day): ?>
                        <div class="day__row">
                            <div class="day__title">
                                <span class="day__accommodation"></span>
                            </div>
                            <div class="day__content">
                                <?= $program->duration != $day->day ? $dayAccommodation['name_user'] : '-' ?>
                                <?= $program->duration != $day->day && $dayAccommodationRoom && !in_array((int)$dayAccommodation['id'],
                                    [1, 2, 17]) ? "/ " . ($dayAccommodationRoom['name_user']) : '' ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="day__row">
                        <div class="day__title">
                            <span class="day__meal"></span>
                        </div>
                        <?php if (!empty($dayMealName)): ?>
                            <div class="day__content"><?= implode($dayMealName, ', ') ?></div>
                        <?php else: ?>
                            <div class="day__content">неизвестно</div>
                        <?php endif; ?>
                    </div>

                    <div class="day__row">
                        <div class="day__title">
                            <span class="day__transfer"></span>
                        </div>
                        <?php if (!empty($dayTransferNameString)): ?>
                            <div class="day__content"><?= $dayTransferNameString ?> <?= !is_null($day->distance) ? ", " . $day->distance . " км" : '' ?></div>
                        <?php else: ?>
                            <div class="day__content">-</div>
                        <?php endif; ?>
                    </div>

                    <div class="day__row">
                        <div class="day__title">
                            <span class="day__places"></span>
                        </div>
                        <div class="day__content">
                            <?php if (!empty($dayPointNameArray)): ?>
                                <span><?= implode(', ', $dayPointNameArray) ?></span>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="day__row">
                        <div class="day__title">
                            <span class="day__activities"></span>
                        </div>
                        <div class="day__content">
                            <?php if (!empty($dayActivityNameArray)): ?>
                                <span><?= implode(', ', $dayActivityNameArray) ?></span>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?></div>
                    </div>

                    <div class="day__description">
                        <?php if (!empty($day->description)): ?>
                            <?= HtmlHelpers::wrapTextInTag($day->description, 'p') ?>
                        <?php else: ?>
                            <span></span>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="days__actions">

            <!--            <div class="days__bottom"></div>-->

            <button id="program-show" class="btn-linear-blue">
                <span>раскрыть программу</span>
            </button>
            <button id="program-close" class="btn-linear-blue hide-element">
                <span>свернуть программу</span>
            </button>
        </div>

    </section>

    <div class="mobile-section-heading">
        <div class="container group">
            <h2>Даты и цены</h2>
            <span class="toggle pointer-down"></span>
        </div>
    </div>

    <section id="tour-schedule" class="container">

        <h3 class="program__heading">Даты и цены</h3>

        <div class="schedule__table">

            <div class="schedule__head">
                <div class="schedule__data">начало</div>
                <div class="schedule__price">цена</div>
                <div class="schedule__available">места</div>
                <div class="schedule__status">статус
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, deleniti dicta dolore eius
                                fuga iure, molestiae nihil perferendis quaerat quasi, quia repudiandae sequi
                                voluptatem.</p>
                        </div>
                    </div>
                </div>
                <!--                <div class="schedule__season">сезон
                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, deleniti dicta dolore eius fuga iure, molestiae nihil perferendis quaerat quasi, quia repudiandae sequi voluptatem.</p>
                                        </div>
                                    </div>
                                </div>-->
                <div class="schedule__button"></div>
            </div>

            <?php if ($tours): ?>
                <?php foreach ($tours as $tour): ?>
                    <?php
                    /* @var $tour Tour */
                    // Получаем список элементов названий обязательных названий для дополнительной стоимости туров.
                    $arrExtraCostPreset = [];
                    foreach (Tour::getArrExtraCostPreset() as $item) {
                        $arrExtraCostPreset[$item['id']] = $item;
                    }
                    // Получаем массив предустановленной дополнительной стоимости.
                    $extraCostPreset = $tour->getExtraCostPreset();
                    // Получаем массив элементов дополнительной стоимости.
                    $arrExtraCost = ExtraCost::find(['tour_id' => $tour->id]);
                    // Получаем отсортированный массив элементов дополнительной стоимости.
                    $arrExtraCostByType = Tour::getExtraCostByType($arrExtraCost);
                    // Получаем ID валюты выбранной пользователем для отображения.
                    $getUserCurrencyID = $currency->getUserCurrencyID();

                    // Вычисляем стоимость обязательных доп расходов.
                    $commonCostExtraCost = 0;
                    if ($extraCostPreset) {
                        foreach ($extraCostPreset as $item){
                            $commonCostExtraCost += $currency->convert($item['cost'], $item['currency'], $getUserCurrencyID);
                        }
                    }

                    if ($arrExtraCostByType['required']) {
                        foreach ($arrExtraCostByType['required'] as $item){
                            $commonCostExtraCost += $currency->convert($item['cost'], $item['currency'], $getUserCurrencyID);
                        }
                    }

                    ?>
                    <div class="schedule__row">
                        <div class="schedule__data"><?= date('d.m.Y', strtotime($tour->start_at)) ?></div>
                        <div class="schedule__price">
                            <?php if ($tour->discount && (strtotime($tour->discount_at) >= strtotime(date('Y-m-d', time())))): ?>
                                <div class="price__old"><?= $currency->convertFormat($tour->price, $tour->currency,
                                        $getUserCurrencyID) ?> <span class="currency"><?= $currency->$getUserCurrencyID['symbol'] ?></span></div>
                            <?php endif; ?>
                            <div class="price_current"><?= $currency->convertFormat(PriceHelpers::getPriceWithDiscount($tour), $tour->currency,
                                    $getUserCurrencyID) ?> <span class="currency"><?= $currency->$getUserCurrencyID['symbol'] ?></span></div>
                        </div>
                        <div class="schedule__available"><?= $tour->available ?><span><?= $program->group_max ?></span>
                        </div>
                        <?php if ($tour->t_status_id == 1): ?>
                            <?php $t_status_class = 'guarantied' ?>
                        <?php elseif ($tour->t_status_id == 2): ?>
                            <?php $t_status_class = 'searching' ?>
                        <?php endif; ?>
                        <div class="schedule__status"><span class="<?= $t_status_class ?>"></span><!--гарантирован-->
                        </div>
                        <!--                <div class="schedule__season">низкий</div>-->
                        <div class="schedule__button">
                            <button class="btn-linear-blue tour__details">детали тура</button>
                            <button class="btn-linear-blue tour__close hide-element">скрыть</button>
                        </div>
                    </div>

                    <div class="schedule__details hide-element">
                        <h4><?= $program->duration ?> <?= HtmlHelpers::dayDeclination($program->duration) ?></h4>
                        <!--                <h4>c 28.03.2020 по 07.04.2020</h4>-->
                        <div class="details__title">Начало: <?= DateHelpers::getDayMonth($tour->start_at) ?>
                            (<?= DateHelpers::getTextDay($tour->start_at) ?>)
                        </div>
                        <div class="details__title">
                            Окончание: <?= DateHelpers::getDayMonth($tour->start_at . ' + ' . $program->duration . ' day') ?>
                            (<?= DateHelpers::getTextDay($tour->start_at . ' + ' . $program->duration . ' day') ?>)
                        </div>
                        <div class="details__title">Сезон: <?= $tour->getSeason()['name'] ?></div>

                        <?php if (!is_null($tour->temp_min) && !is_null($tour->temp_max)): ?>
                            <div class="details__title">Ожидаемая погода:
                                от <?= HtmlHelpers::signedNumber($tour->temp_min) ?>С
                                до <?= HtmlHelpers::signedNumber($tour->temp_max) ?>С
                            </div>
                        <?php endif; ?>

                        <h3 class="blue">бронирование и оплата</h3>
                        <div class="details__title">
                            Предоплата<span><?= $tour->prepayment ? $tour->prepayment . '%' : '0%' ?></span></div>
                        <div class="details__title">Оплатить
                            за<span><?= $tour->booking_until ?></span><?= HtmlHelpers::dayDeclination($tour->booking_until) ?>
                            до начала тура
                        </div>

                        <?php if ($tour->booking_conditions): ?>
                            <h4>Условия бронирования и оплаты</h4>
                            <div class="details__text"><?= HtmlHelpers::wrapTextInTag($tour->booking_conditions,
                                    'p') ?></div>
                        <?php endif; ?>

                        <?php if ($tour->refund): ?>
                            <h4>Условия отмены и возврата</h4>
                            <div class="details__text"><?= HtmlHelpers::wrapTextInTag($tour->refund, 'p') ?></div>
                        <?php endif; ?>

                        <h3 class="red">В цену не включено</h3>

                        <?php if ($extraCostPreset): ?>
                            <h4>обязательные расходы<span class="extra__total">~ <?= $currency->format($commonCostExtraCost) ?> <span class="currency"><?= $currency->$getUserCurrencyID['symbol'] ?></span></span>
                            </h4>
                            <?php foreach ($extraCostPreset as $item): ?>
                                <div class="details__extra">
                                    <span class="extra__title"><?= $arrExtraCostPreset[$item['extra_cost_preset_id']]['name'] ?></span>
                                    <span class="extra__text"><?= $item['comment'] ?></span>
                                    <span class="extra__sum">(<?= $currency->convertFormat($item['cost'], $item['currency'],
                                            $item['currency']) ?> <span class="currency"><?= $currency->getCurrency()[$item['currency']]['symbol'] ?></span>)</span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($arrExtraCostByType['required']): ?>
                            <?php foreach ($arrExtraCostByType['required'] as $item): ?>
                                <div class="details__extra">
                                    <span class="extra__text"><?= $item['comment'] ?></span>
                                    <span class="extra__sum">(<?= $currency->convertFormat($item['cost'], $item['currency'],
                                            $item['currency']) ?> <span class="currency"><?= $currency->getCurrency()[$item['currency']]['symbol'] ?></span>)</span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($arrExtraCostByType['additional']): ?>
                            <h4>по желанию участника</h4>
                            <?php foreach ($arrExtraCostByType['additional'] as $item): ?>
                                <div class="details__extra">
                                    <span class="extra__text"><?= $item['comment'] ?></span>
                                    <span class="extra__sum">(<?= $currency->convertFormat($item['cost'], $item['currency'],
                                            $item['currency']) ?> <span class="currency"><?= $currency->getCurrency()[$item['currency']]['symbol'] ?></span>)</span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!$extraCostPreset && !$arrExtraCostByType['required'] && !$arrExtraCostByType['additional']): ?>
                            <div>Уточняйте у организатора</div>
                        <?php endif; ?>

                        <button class="btn-blue"><span>задать вопрос</span></button>
                        <button class="btn-orange"><span>бронировать</span></button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <div class="reserve">
            <h4>Поиск билетов</h4>
        </div>


    </section>  <!-- ДАТЫ И ЦЕНЫ -->

    <div class="mobile-section-heading">
        <div class="container group">
            <h2>Дополнительно</h2>
            <span class="toggle pointer-down"></span>
        </div>
    </div>

    <section id="tour-additional" class="container">

        <!--        <div class="program__heading">Дополнительная информация</div>-->
        <?php if (count($countryName) == 1 && $countryName[0] != 'Россия' || count($countryName) > 1): ?>
            <div class="reserve">
                <h4>Виза для граждан РФ</h4>
            </div>
        <?php endif; ?>

        <?php if (!empty($program->conditions)): ?>
            <div class="additional__box">
                <h3 class="program__heading">Условия участия</h3>
                <?= $program->conditions ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($program->features_region)): ?>
            <div class="additional__box">
                <h3 class="program__heading">Особенности региона</h3>
                <?= $program->features_region ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($program->what_take)): ?>
            <div class="additional__box">
                <h3 class="program__heading">Что взять с собой</h3>
                <?= $program->what_take ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($program->health)): ?>
            <div class="additional__box">
                <h3 class="program__heading">Здоровье</h3>
                <?= $program->health ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($program->additional)): ?>
            <div class="additional__box">
                <h3 class="program__heading">Дополнительно</h3>
                <?= $program->additional ?>
            </div>
        <?php endif; ?>

        <!--        <div class="additional__box">
                    <h3 class="program__heading">Вопрос - ответ</h3>
                </div>-->


    </section>  <!-- ДОПОЛНИТЕЛЬНО -->

    <div class="mobile-section-heading">
        <div class="container group">
            <h2>Организатор</h2>
            <span class="toggle pointer-down"></span>
        </div>
    </div>

    <section id="tour-contacts" class="container">

        <h2 class="program__heading">Организатор</h2>

        <div class="contacts__box">

            <div class="group">

                <div class="contacts__image">
                    <?php if ($partner->getPartnerType()->id == Partner::PARTNER_TYPE_OPERATOR): ?>
                        <img class="tour-operator" src="../../images/icons/icon_tour-operator-symbol.svg"
                             alt="tour-operator-symbol">
                    <?php endif; ?>
                    <img class="avatar" src="/images/avatars/middle/<?= $partner->avatar ?>" alt="avatar">
                </div>

                <div class="contacts__info">
                    <div class="contacts__type">
                        <?php if ($partner->getPartnerType()->id == Partner::PARTNER_TYPE_OPERATOR): ?>
                            <?= Partner::ARR_PARTNER_TYPE[$partner->getPartnerType()->id] ?>,
                            <?= $partner->getProfile()->rto_number ?>
                        <?php elseif ($partner->getPartnerType()->id == Partner::PARTNER_TYPE_AGENCY): ?>
                            <?= Partner::ARR_PARTNER_TYPE[$partner->getPartnerType()->id] ?>
                        <?php elseif ($partner->getPartnerType()->id == Partner::PARTNER_TYPE_PERSON): ?>
                            <?= Partner::ARR_PARTNER_TYPE[$partner->getPartnerType()->id] ?>
                        <?php elseif ($partner->getPartnerType()->id == Partner::PARTNER_TYPE_COMPANY): ?>
                            <?= Partner::ARR_PARTNER_TYPE[$partner->getPartnerType()->id] ?>
                        <?php else: ?>
                            Компания
                        <?php endif; ?>
                    </div>
                    <div class="contacts__name"><?= $partner->name_profile ?></div>
                    <div class="contacts__stats">на сайте<span
                                class="blue">с <?= DateTime::createFromFormat('Y-m-d H:i:s',
                                $partner->created_at)->format('d-m-Y') ?></span></div>
                    <div class="contacts__rating">рейтинг
                        <span class="star-estimation-empty"></span>
                        <span class="star-estimation-empty"></span>
                        <span class="star-estimation-empty"></span>
                        <span class="star-estimation-empty"></span>
                        <span class="star-estimation-empty"></span>
                    </div>
                </div>
            </div>

            <div class="contacts__details hide-element">
                <!--                <a href="#" target="_blank"><span class="website"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="facebook"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="instagram"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="vkontacte"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="youtube"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="telegram"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="whatsapp"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="viber"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="skype"></span></a>-->
                <!--                <a href="#" target="_blank"><span class="phone"></span></a>-->
            </div>

            <div id="show-contacts" class="btn-blue" data-program-id="<?= $program->id ?>">
                <span>ПОКАЗАТЬ КОНТАКТЫ</span>
            </div>

            <div class="contacts__about">
                <?php if (!empty($partner->about)): ?>
                    <?= HtmlHelpers::wrapTextInTag($partner->about, 'p') ?>
                <?php endif; ?>
            </div>

            <div id="show-all-tours">
                <a href="#" class="link">все туры организатора (2)</a>
            </div>

        </div>

    </section>  <!-- ОРГАНИЗАТОР -->

    <div id="gallery-cover" class="body-disable hide-element">
        <div id="gallery" class="container" data-partner="<?= $program->partner_id ?>"
             data-program="<?= $program->id ?>">
            <div id="image-box"></div>
            <div id="gallery__mini-bar"></div>
        </div>
    </div>

    <!-- ВИДЖЕТ "tour-actions-bar": ВАЖНО! ОН ВСЕГДА ДОЛЖЕН СТОЯТЬ В КОНЦЕ СТАНИЦЫ ПЕРЕД ФУТЕРОМ -->
    <!--    <div id="tour-actions-bar" class="tour__fixed-bar">-->
    <!---->
    <!--        <div class="container">-->
    <!--            <div class="tour__price">-->
    <!--                <a href="#">-->
    <!--                    <div class="day-price">171<span class="dollar"></span></div>-->
    <!--                </a>-->
    <!--            </div>-->
    <!---->
    <!--            <div class="tour__user-actions">-->
    <!--                <span class="add-to-favorite"></span>-->
    <!--                <span class="compare-tours"></span>-->
    <!--                <span class="share-link"></span>-->
    <!--                <span class="ask-question"></span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->

</div>