<?php

use app\helpers\HtmlHelpers;
use app\Models\program\Program;

/* @var $program Program */
/* @var $countryCount int */
/* @var $comfort int */
/* @var $dynamic int */
/* @var $meal int */
/* @var $route_stats array */
/** @var $arrTourTypeIds array */
/** @var $arrTargetAudienceIds array */

?>

<section class="container tour__description">

    <div class="group">

        <div class="main-stats">

            <div class="day-group-age">

                <div class="duration">
                    <span><?= $program->duration ?></span>
                    <span class="small-txt">дней</span>
                </div>

                <div class="group-size">
                    <span><?= $program->group_min ?>-<?= $program->group_max ?></span>
                    <span class="small-txt">человек</span>
                </div>

                <div class="age-limit"><?= ($program->age_min != '') ? $program->age_min : 0 ?></div>

            </div>

            <div class="comfort-dynamics-meal">

                <div class="comfort">
                    <div>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if ($i <= $comfort): ?>
                                <span class="program__comfort"></span>
                            <?php else: ?>
                                <span class="program__comfort-empty"></span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php if ($comfort == 1): ?>
                        <div class="small-txt">минимум удобств при размещении</div>
                    <?php elseif ($comfort == 2): ?>
                        <div class="small-txt">стандартное размещение</div>
                    <?php elseif ($comfort == 3): ?>
                        <div class="small-txt">комфортное размещение</div>
                    <?php endif; ?>
                </div>

                <div class="dynamics">
                    <div>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if ($i <= $dynamic): ?>
                                <span class="program__dynamics"></span>
                            <?php else: ?>
                                <span class="program__dynamics-empty"></span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php if ($dynamic == 0): ?>
                        <div class="small-txt">без физических активностей</div>
                    <?php elseif ($dynamic == 1): ?>
                        <div class="small-txt">мало физических активностей</div>
                    <?php elseif ($dynamic == 2): ?>
                        <div class="small-txt">много физических активностей</div>
                    <?php elseif ($dynamic == 3): ?>
                        <div class="small-txt">для подготовленных</div>
                    <?php endif; ?>
                </div>

                <div class="meal">
                    <div>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if ($i <= $meal): ?>
                                <span class="program__meal"></span>
                            <?php else: ?>
                                <span class="program__meal-empty"></span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <?php if ($meal == 0): ?>
                        <div class="small-txt">питание не включено</div>
                    <?php elseif ($meal == 1): ?>
                        <div class="small-txt">питание частично включено</div>
                    <?php elseif ($meal == 2): ?>
                        <div class="small-txt">питание частично включено</div>
                    <?php elseif ($meal == 3): ?>
                        <div class="small-txt">питание включено</div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <div class="type-suites-block">

            <div class="tour-block tour-type">
                <h3 class="description__heading">Тип тура</h3>
                <div class="content">
                    <?php foreach (Program::getArrTourType() as $key => $val): ?>
                        <?php if (in_array($val['id'], $arrTourTypeIds)): ?>
                            <div class="string"><?= $val['name'] ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if ($countryCount > 1): ?>
                        <div class="string">Мульти-тур</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tour-block tour-suites">
                <h3 class="description__heading">Подойдет</h3>
                <div class="content">
                    <?php foreach (Program::getArrTargetAudience() as $key => $val): ?>
                        <?php if (in_array($val['id'], $arrTargetAudienceIds)): ?>
                            <div class="string"><?= $val['name'] ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

    </div>

    <div class="group">

        <div class="route-about">

            <div class="route-stats">

                <h3 class="program__heading">О МАРШРУТЕ</h3>

                <div class="route-stats__box">
                    <div class="route-stats__start">
                        <div class="start__img"></div>
                        <div class="start__country"><?= $route_stats['start_country'] ?></div>
                        <div class="start__city"><?= $route_stats['start_city'] ?></div>
                    </div>
                    <div class="route-stats_center">
                        <div class="stats__places"><span>9</span>локаций</div>
                        <div class="stats__img"></div>
                        <div class="stats__activities"><span>9</span>активностей</div>
                    </div>
                    <div class="route-stats__finish">
                        <div class="finish__img"></div>
                        <div class="finish__country"><?= $route_stats['finish_country'] ?></div>
                        <div class="finish__city"><?= $route_stats['finish_city'] ?></div>
                    </div>
                </div>

            </div>

            <div class="about-program">

                <h3 class="program__heading">ЧТО ВАС ЖДЕТ</h3>

                <div class="about-program__content">
                    <?= HtmlHelpers::wrapTextInTag($program->about, 'p') ?>
                </div>

            </div>

        </div>

        <div class="tour_tags">

            <div class="place-tags">

                <div class="tour-block description__table">
                    <h3 class="description__heading">Где побываем</h3>

                    <div class="table_field">
                        <h4 class="table__heading">Культура и&nbsp;быт</h4>
                        <div class="table__content">
                            <div class="string">фермы и деревни</div>
                            <div class="string">этнические резервации</div>
                        </div>
                    </div>

                    <div class="table_field">
                        <h4 class="table__heading">Необычные места</h4>
                        <div class="table__content">
                            <div class="string">дома и города призраки</div>
                            <div class="string">уникальная природа</div>
                        </div>
                    </div>

                    <div class="table_field">
                        <h4 class="table__heading">Природа</h4>
                        <div class="table__content">
                            <div class="string">водопады</div>
                            <div class="string">заповедники и заказники</div>
                            <div class="string">пустыни</div>
                            <div class="string">степи и вельды</div>
                            <div class="string">саванны</div>
                            <div class="string">океаны</div>
                            <div class="string">реки</div>
                            <div class="string">фьорды</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="activity-tags">

                <div class="tour-block description__table">
                    <h3 class="description__heading">Чем займемся</h3>

                    <div class="table_field">
                        <h4 class="table__heading">Адреналин</h4>
                        <div class="table__content">
                            <div class="string">off-road езда</div>
                            <div class="string">сплавы (рафтинг, байдарки, каноэ, каякинг)</div>
                        </div>
                    </div>

                    <div class="table_field">
                        <h4 class="table__heading">Впечатления</h4>
                        <div class="table__content">
                            <div class="string">водные прогулки</div>
                            <div class="string">наблюдение за животными</div>
                            <div class="string">национальные \ местные кухни</div>
                            <div class="string">рассветы и закаты</div>
                            <div class="string">самолетные прогулки</div>
                            <div class="string">сафари</div>
                            <div class="string">созерцание природы</div>
                        </div>
                    </div>

                    <div class="table_field">
                        <h4 class="table__heading">Дух и тело</h4>
                        <div class="table__content">
                            <div class="string">пешие прогулки</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>