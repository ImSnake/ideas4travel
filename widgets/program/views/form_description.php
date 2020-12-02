<?php

use app\helpers\HtmlHelpers;
use app\Models\program\PrGeo;
use app\Models\program\Program;
use app\services\Geo;

/** @var $program Program */
/** @var $geo Geo */
/** @var $countriesArr array */
/** @var $prGeoStart PrGeo */
/** @var $prGeoFinish PrGeo */
/** @var $arrCountry array */
/** @var $arrTourTypeIds array */
/** @var $arrTargetAudienceIds array */

?>

<div id="description" class="program-form__step">

    <form action="#" method="post" id="program-form-edit-description">

        <div class="program-form__field">

            <div class="program-form__title">

                <span>Название&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <!-- id пока не использован-->
                <input id="program-name" class="program-form__text" type="text"
                       name="description[program_name]" value="<?= htmlspecialchars($program->name, ENT_QUOTES) ?>"
                       placeholder="до 100 символов"
                       data-program-name="<?= htmlspecialchars($program->name, ENT_QUOTES) ?>">
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <span>Размер&nbsp;группы&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <label for="group-min" class="default">от</label>
                <input id="group-min" type="number" min="2" max="50" placeholder="2" name="description[group_min]"
                       value="<?= $program->group_min ?>">
                <label for="group-max" class="default">до</label>
                <input id="group-max" type="number" min="2" max="50" placeholder="50"
                       name="description[group_max]" value="<?= $program->group_max ?>">
                <span class="default">человек</span>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <span>Возраст&nbsp;участников&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <label for="age-min" class="default">от</label>
                <input id="age-min" type="number" min="0" max="100" placeholder="0" name="description[age_min]"
                       value="<?= $program->age_min ?>">
                <label for="age-max" class="default">до</label>
                <input id="age-max" type="number" min="0" max="100" placeholder="100" name="description[age_max]"
                       value="<?= $program->age_max ?>">
                <span class="default">лет</span>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Выбери от <span class="blue bold">1</span> до <span class="blue bold">4</span> значений, соответствующих теме и программе тура.</p>
                        <p>Не знаешь что выбрать?<br>
                            Обратись к базе знаний:
                        <a href="/support/knowledge-base#filters" target="_blank" class="link">
                            <span class="img_search">&nbsp;Поиск&nbsp;по&nbsp;тегам</span></a></p>
                    </div>
                </div>

                <span>Тип&nbsp;тура&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text">

                <div class="cover-box">

                    <div class="group fade">
                        <div class="text default">выбери до 4-х значений</div>
                        <div class="down-arr toggle"></div>
                        <div class="up-arr toggle hide-element"></div>
                    </div>

                    <div id="tour-type" class="checkbox-block">
                        <?php foreach (Program::getArrTourType() as $key => $val): ?>
                            <?php if (in_array($val['id'], $arrTourTypeIds)): ?>
                                <?php $checked = 'checked'; ?>
                            <?php else: ?>
                                <?php $checked = ''; ?>
                            <?php endif; ?>
                            <div>
                                <input type="checkbox" id="tour-type-<?= $key + 1 ?>" data-name="<?= $val['name'] ?>"
                                       name="tour_type[]" value="<?= $val['id'] ?>" <?= $checked ?>>
                                <label for="tour-type-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Продолжительность программы:<br>
                            минимум - <span class="blue bold">2</span>&nbsp;дня, максимум - <span class="blue bold">30</span>&nbsp;дней.</p>
                    </div>
                </div>

                <span>Длительность&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <input id="duration" type="number" min="2" max="30" placeholder="2"
                       name="description[duration]" value="<?= $program->duration ?>">
                <label for="duration" class="default">дней</label>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Если программа рассчитана на определенную аудиторию или социальную группу, отметь
                            подходящие значения.</p>
                        <p>Не знаешь что выбрать?<br>
                            Обратись к базе знаний:
                        <a href="/support/knowledge-base#filters" target="_blank" class="link">
                            <span class="img_search">&nbsp;Поиск&nbsp;по&nbsp;тегам</span></a></p>
                    </div>
                </div>

                <span>Целевая&nbsp;аудитория&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text">

                <div class="cover-box">

                    <div class="group fade">
                        <div class="text default">выбери до 4-х значений</div>
                        <div class="down-arr toggle"></div>
                        <div class="up-arr toggle hide-element"></div>
                    </div>

                    <div id="target-audience" class="checkbox-block">

                        <?php foreach (Program::getArrTargetAudience() as $key => $val): ?>
                            <?php if (in_array($val['id'], $arrTargetAudienceIds)): ?>
                                <?php $checked = 'checked'; ?>
                            <?php else: ?>
                                <?php $checked = ''; ?>
                            <?php endif; ?>
                            <div>
                                <?php if ($key == 0): ?>
                                    <input type="checkbox" id="target-audience-everyone" data-name="<?= $val['name'] ?>"
                                           name="target_audience[]" value="<?= $val['id'] ?>" <?= $checked ?>>
                                    <label for="target-audience-everyone"><span><?= $val['name'] ?></span></label>
                                <?php else: ?>
                                    <input type="checkbox" id="target-audience-<?= $key ?>"
                                           data-name="<?= $val['name'] ?>"
                                           name="target_audience[]" value="<?= $val['id'] ?>" <?= $checked ?>>
                                    <label for="target-audience-<?= $key ?>"><span><?= $val['name'] ?></span></label>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Укажи, входит ли питание в стоимость тура.</p>
                        <p>Не знаешь что выбрать?<br>
                            Обратись к базе знаний:
                        <a href="/support/knowledge-base#program-filling" target="_blank" class="link">
                            <span class="program__meal">&nbsp;Питание</span>
                        </a></p>
                    </div>
                </div>

                <span>Питание&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                <div class="radio-cover">

                    <?php foreach (Program::getArrMeals() as $key => $val): ?>
                        <?php if ($val['id'] == $program->meal_id): ?>
                            <?php $checked = 'checked'; ?>
                        <?php else: ?>
                            <?php $checked = ''; ?>
                        <?php endif; ?>
                        <div>
                            <input type="radio" id="meal-<?= $key + 1 ?>" name="meal[]"
                                   value="<?= $val['id'] ?>" <?= $checked ?>>
                            <label for="meal-<?= $key + 1 ?>"><?= $val['name'] ?></label>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Степень физических нагрузок на участников во время тура.</p>
                        <p>Не знаешь что выбрать?<br>
                            Обратись к базе знаний:
                        <a href="/support/knowledge-base#program-filling" target="_blank" class="link">
                            <span class="program__dynamics">&nbsp;Динамика</span>
                        </a></p>

                    </div>
                </div>

                <span>Динамика&nbsp;тура&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                <div class="radio-cover">

                    <?php foreach (Program::getArrDynamic() as $key => $val): ?>
                        <?php if ($val['id'] == $program->dynamic_id): ?>
                            <?php $checked = 'checked'; ?>
                        <?php else: ?>
                            <?php $checked = ''; ?>
                        <?php endif; ?>
                        <div>
                            <input type="radio" id="dynamic-<?= $key + 1 ?>" name="dynamic[]"
                                   value="<?= $val['id'] ?>" <?= $checked ?>>
                            <label for="dynamic-<?= $key + 1 ?>"><?= $val['name'] ?></label>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Условия проживания участников:</p>
                        <p><span class="blue bold">Минимум</span> – проживание в палатке или в общем номере
                        </p>
                        <p><span class="blue bold">Стандарт</span> – отдельный номер, каюта или комната</p>
                        <p><span class="blue bold">Повышенный</span> – отель не менее 3*, санузел в номере
                        </p>
                        <p>Не знаешь что выбрать?<br>
                            Обратись к базе знаний:
                        <a href="/support/knowledge-base#program-filling" target="_blank" class="link">
                            <span class="program__comfort">&nbsp;Комфорт</span></a></p>
                    </div>
                </div>

                <span>Уровень&nbsp;комфорта&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">
                <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                <div class="radio-cover">

                    <?php foreach (Program::getArrComfort() as $key => $val): ?>
                        <?php if ($val['id'] == $program->comfort_id): ?>
                            <?php $checked = 'checked'; ?>
                        <?php else: ?>
                            <?php $checked = ''; ?>
                        <?php endif; ?>
                        <div>
                            <input type="radio" id="comfort-<?= $key + 1 ?>" name="comfort[]"
                                   value="<?= $val['id'] ?>" <?= $checked ?>>
                            <label for="comfort-<?= $key + 1 ?>"><?= $val['name'] ?></label>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">
                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Добавь короткое описание тура: почему путешественнику следует выбрать именно этот
                            тур
                            и что его ждет в поездке.</p>
                    </div>
                </div>
                <span>О&nbsp;программе&nbsp;<span class="red">*</span></span>
            </div>

            <div class="program-form__text">
                <textarea data-autoresize rows="4" maxlength="1600" placeholder="до 1500 символов"
                          name="description[about]"><?= $program->about ?></textarea>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Укажи место сбора группы: страну и город, откуда начинается тур.</p>
                    </div>
                </div>

                <span>Место&nbsp;старта&nbsp;<span class="red">*</span></span>

            </div>

            <div class="program-form__text group">

                <div class="select-cover">

                    <select id="start-country" name="description[start_country_id]" required>
                        <!--не удалять в option disabled значение атрибута value="" -->
                        <?php if (!$prGeoStart->country_id): ?>
                            <option value="" disabled selected>страна</option>
                        <?php else: ?>
                            <option value="" disabled>страна</option>
                        <?php endif; ?>

                        <option value="RU">Россия</option>
                        <?php foreach ($countriesArr as $item): ?>
                            <?php if ($item['id'] == $prGeoStart->country_id): ?>
                                <?php $selected = 'selected' ?>
                            <?php else: ?>
                                <?php $selected = '' ?>
                            <?php endif; ?>
                            <option value="<?= $item['id'] ?>" <?= $selected ?>><?= $item['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="select-cover">
                    <input type="text" id="start-city"
                           placeholder="город (введи первые буквы названия и выбери из списка)"
                           name="description[start_city_name]"
                           value="<?= $geo->getCityName($prGeoStart->city_id) ?>" required>
                    <input type="hidden" value="<?= $prGeoStart->city_id ?>" name="description[start_city_id]"
                           id="start-city-id">
                    <input type="hidden" value="<?= $prGeoStart->area_id ?>" name="description[start_area_id]"
                           id="start-area-id">

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Отметь, если программа заканчивается в другом месте и укажи место окончания.</p>
                    </div>
                </div>

                <span>Финиш&nbsp;в&nbsp;ином&nbsp;месте</span>

            </div>

            <div class="program-form__text filled">

                <div class="checkbox-cover">

                    <div class="fade hide-element">

                        <div class="group">

                            <div class="select-cover">
                                <select id="finish-country" class="clone" name="description[finish_country_id]"
                                        required>
                                    <?php if ($program->finish_checkbox == true): ?>
                                        <!-- при активном чекбоксе дублирует элементы из '#start-country option' -->
                                        <?php if (!$prGeoFinish->country_id): ?>
                                            <option value="" disabled selected>страна</option>
                                        <?php endif; ?>
                                        <option value="RU">Россия</option>
                                        <?php foreach ($countriesArr as $item): ?>
                                            <?php if ($item['id'] == $prGeoFinish->country_id): ?>
                                                <?php $selected = 'selected' ?>
                                            <?php else: ?>
                                                <?php $selected = '' ?>
                                            <?php endif; ?>
                                            <option value="<?= $item['id'] ?>"
                                                    <?= $selected ?>><?= $item['name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="select-cover">
                                <!--                                <select id="finish-city" class="clone" required>-->
                                <!-- при активном чекбоксе дублирует элементы из '#start-city option' -->
                                <!--                                </select>-->
                                <input type="text" id="finish-city"
                                       placeholder="город (введи первые буквы названия и выбери из списка)"
                                       name="description[finish_city_name]"
                                       value="<?= $geo->getCityName($prGeoFinish->city_id) ?>" required>
                                <input type="hidden" value="<?= $prGeoFinish->city_id ?>"
                                       name="description[finish_city_id]" id="finish-city-id">
                                <input type="hidden" value="<?= $prGeoFinish->area_id ?>"
                                       name="description[finish_area_id]" id="finish-area-id">
                            </div>

                        </div>

                    </div>

                    <?php if ($program->finish_checkbox == true): ?>
                        <input type="checkbox" id="finish" name="description[finish_checkbox]" checked><label
                                for="finish"></label>
                    <?php else: ?>
                        <input type="checkbox" id="finish" name="description[finish_checkbox]"><label
                                for="finish"></label>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Отметь, если в рамках тура запланировано посещение нескольких стран и добавь их в
                            программу.</p>
                    </div>
                </div>

                <span>Мульти-тур</span>

            </div>

            <div class="program-form__text filled">

                <div class="checkbox-cover">

                    <div class="fade hide-element">

                        <input id="country-list" value="<?= $arrCountry['ids'] ?>" type="hidden"
                               name="description[multitour]">

                        <div id="country-added" class="country-list">
                            <?php if ($arrCountry['other_names']): ?>
                                <?php foreach ($arrCountry['countryOther'] as $key => $value): ?>
                                    <?php
                                    echo "<span data-country=$key>$value<span class='delete-clone'></span></span>";
                                    ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- если #multi-country:changed, JS добавит в тег данные из geoObject.countryExtra[] -->
                        </div>

                        <div class="select-cover plus-sign">
                            <select id="multi-country" class="clone" required>
                                <!-- при активном чекбоксе дублирует элементы #start-country option -->
                                <?php if ($arrCountry['other_names']): ?>
                                    <option value="" selected disabled>страна</option>
                                    <?php foreach ($countriesArr as $item): ?>
                                        <?php if (in_array($item['id'], explode(',', $arrCountry['ids']))): ?>
                                            <?php $selected = 'disabled' ?>
                                        <?php else: ?>
                                            <?php $selected = '' ?>
                                        <?php endif; ?>
                                        <option value="<?= $item['id'] ?>"
                                                <?= $selected ?>><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>

                    <?php if ($arrCountry['other_names']): ?>
                        <input type="checkbox" id="multi-tour" checked><label for="multi-tour"></label>
                    <?php else: ?>
                        <input type="checkbox" id="multi-tour"><label for="multi-tour"></label>
                    <?php endif; ?>

                    <?php if ($program->multitur == true): ?>
                        <?php $style = "style='display: inline-block;'"; ?>
                    <?php else: ?>
                        <?php $style = ''; ?>
                    <?php endif; ?>
                    <span id="country-count" class="text hidden" <?= $style ?>">
                    <?= $arrCountry['start_finish_names'] ?>
                    <!-- если :checked, JS добавит в тег значение переменной geoObject.countryList -->
                    </span>

                </div>

            </div>

        </div>

    </form>

</div>