<?php

use app\helpers\HtmlHelpers;
use app\Models\program\Program;
use app\services\Geo;

/** @var $program Program */
/** @var $geo Geo */
/** @var $days array */
/** @var $arrAccommodation array */
/** @var $arrAccommodationRoom array */
/** @var $arrDayMeal array */
/** @var $dayMeal array */
/** @var $arrDayTransfer array */
/** @var $dayTransfer array */
/** @var $dayPoint array */
/** @var $dayActivity array */
/** @var $dayImg array */
/** @var $arrCountry array */
/** @var $imgString string */

// Количество дней в программе.
$countDays = count($days);

?>

<div id="plan-by-days" class="program-form__step hide-element"><!-- step 2 -->

    <div class="notice">
        Зачем нужна подробная программа по дням?! А заполнять все поля обязательно?! Что будет, если я не заполню программу по дням?!
        <a href="/support/knowledge-base#plan-by-days" target="_blank" class="link">Ответы здесь</span></a>
    </div>

    <form action="#" method="post" id="program-form-edit-plan-by-days">

        <?php for ($i = 1; $i <= count($days); $i++): ?>

            <?php
            // Получаем объект дня.
            $day = $days[$i];
            //            var_dump($day);
            // Приводим день к виду O1, 02, 12, 15 и т.д.
            $numDay = HtmlHelpers::doubleNumber($i);
            ?>

            <?php if ($i == 1): ?>

                <!-- Первый день -->
                <div id="day-1" data-day="1" class="day-box opened">

                    <div class="program-form__field start day opened">

                        <div class="day-title opened">
                            <span class="group">1&nbsp;день</span>
                        </div>

                        <div class="group day-nav">
                            <div class="help hover">
                                <div class="help-pop-up top fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Первый день содержит подсказки по заполнению программы.</p>
                                    <p><span class="day-clone blue"></span> - копировать день с заполненной
                                        информацией
                                    </p>
                                    <p><span class="day-delete blue"></span> - удалить день</p>
                                    <p><span class="unlocked"></span> / <span class="locked"></span> -
                                        автозаполнение полей с блокивкой внесения изменений.
                                        Установить и снять блокировку можно только в "1 ДЕНЬ"</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- day 1 -->

                    <div class="day-cover">

                        <div class="program-form__field night-place day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Выбери место ночевки группы: страну и город.</p>
                                        <p>Если в списке нет нужного населенного пункта, то оставь поле "город" пустым.</p>
                                    </div>
                                </div>

                                <span>Ночевка&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group day-place">
                                    <div class="select-cover">
                                        <select id="d01-country" class="day-country" name="d[01][country_id]" required>
                                            <?php if (empty($arrCountry)): ?>
                                                <?php $nameOption = 'страна не указана'; ?>
                                            <?php elseif (!empty($arrCountry) && empty($day['geo']->country_id)): ?>
                                                <?php $nameOption = 'страна из списка'; ?>
                                            <?php endif; ?>

                                            <option value="" selected disabled><?= $nameOption ?></option>
                                            <?php foreach ($arrCountry as $value): ?>
                                                <?php if ($value['id'] == $day['geo']->country_id): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['name'] ?></option>
                                            <?php endforeach; ?>
                                            <!-- при клике по select создает теги option ко всем выбранным странам' -->
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <input type="text" id="d01-city"
                                               placeholder="город (введи первые буквы названия и выбери из списка)"
                                               name="d[01][city_name]"
                                               value="<?= $geo->getCityName($day['geo']->city_id) ?>" required>
                                        <input type="hidden" value="<?= $day['geo']->city_id ?>" name="d[01][city_id]"
                                               id="d01-city-id" class="day__city-id">
                                        <input type="hidden" value="<?= $day['geo']->area_id ?>" name="d[01][area_id]"
                                               id="d01-area-id" class="day__area-id">
                                    </div>
                                </div>

                                <div class="repeat-4-all unlocked">
                                    <?php if ($day['day_place_checkbox'] == 1): ?>
                                        <?php $checked = 'checked' ?>
                                    <?php else: ?>
                                        <?php $checked = '' ?>
                                    <?php endif; ?>
                                    <input type="checkbox" id="d01-day-place"
                                           name="d[01][day_place_checkbox]" <?= $checked ?>>
                                    <label for="d01-day-place"></label>
                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field night-place day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Выбери тип жилья и условия размещения группы в этот день.</p>
                                        <p>Нет нужного значения?<br>
                                            Обратись к базе знаний:
                                        <a href="/support/knowledge-base#program-filling" target="_blank" class="link">
                                            <span class="img_accommodation">&nbsp;Размещение</span></a></p>
                                    </div>
                                </div>

                                <span>Размещение&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text day-accommodation group">
                                    <div class="select-cover">
                                        <select id="d01-accommodation" class="text accommodation-type" name="d[01][accommodation]"
                                                required>
                                            <option value="" selected disabled>тип жилья</option>
                                            <?php foreach ($arrAccommodation as $val): ?>
                                                <?php if ($day['accommodation_id'] == $val['id']): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <select id="d01-accommodation_room" class="text" name="d[01][accommodation_room]" required>
                                            <option value="" selected disabled>вместимость номера</option>
                                            <?php foreach ($arrAccommodationRoom as $val): ?>
                                                <?php if ($day['accommodation_room_id'] == $val['id']): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="repeat-4-all unlocked">
                                    <?php if ($day['accommodation_checkbox'] == 1): ?>
                                        <?php $checked = 'checked' ?>
                                    <?php else: ?>
                                        <?php $checked = '' ?>
                                    <?php endif; ?>
                                    <input type="checkbox" id="d01-day-accommodation" data-name="accommodation-lock"
                                           name="d[01][accommodation_checkbox]" <?= $checked ?>>
                                    <label for="d01-day-accommodation"></label>
                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Отметь включенное в стоимость питание.</p>
                                        <p>Не знаешь что выбрать?<br>
                                            Обратись к базе знаний:
                                        <a href="/support/knowledge-base#program-filling" target="_blank" class="link">
                                            <span class="program__meal">&nbsp;Питание</span></a></p>
                                    </div>
                                </div>

                                <span>Питание&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text day-meal">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">включенное в стоимость</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>
                                        <!-- 1) для всех id префикс "d(x)-" назначается через JS автоматически -->
                                        <div id="d01-meal" class="checkbox-block meal-box">

                                            <?php foreach ($arrDayMeal as $key => $val): ?>
                                                <?php if (in_array($val['id'], $dayMeal[$i])): ?>
                                                    <?php $checked = 'checked'; ?>
                                                <?php else: ?>
                                                    <?php $checked = ''; ?>
                                                <?php endif; ?>
                                                <div>
                                                    <input type="checkbox" id="d01-meal-<?= $key + 1 ?>"
                                                           data-name="<?= $val['name'] ?>"
                                                           name="d[01][meal][]"
                                                           value="<?= $val['id'] ?>" <?= $checked ?>>
                                                    <label for="d01-meal-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                                </div>
                                            <?php endforeach; ?>

                                            <!-- 2) #no-meal, #meal-na привязан к JS-скрипту-->
                                        </div>

                                    </div>

                                </div>

                                <div class="repeat-4-all unlocked">
                                    <?php if ($day['meal_checkbox'] == 1): ?>
                                        <?php $checked = 'checked' ?>
                                    <?php else: ?>
                                        <?php $checked = '' ?>
                                    <?php endif; ?>
                                    <input type="checkbox" id="d01-day-meal" data-name="meal-lock"
                                           name="d[01][meal_checkbox]" <?= $checked ?>>
                                    <label for="d01-day-meal"></label>
                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Если в этот день планируется перемещение группы по маршруту или
                                            смена места проживания, укажи расстояние и способы перемещения от точки
                                            до
                                            точки.
                                        <p>Подробнее о трансферах в базе знаний:
                                        <a href="/support/knowledge-base#place-activity" target="_blank" class="link">
                                            <span class="img_map-and-route">&nbsp;Локации&nbsp;и&nbsp;активности</span></a></p>
                                    </div>
                                </div>

                                <span>Трансфер&nbsp;</span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group day-transfer">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">способ перемещения группы по маршруту</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d01-transfer-type" class="checkbox-block transfer-box">

                                            <?php foreach ($arrDayTransfer as $key => $val): ?>
                                                <?php if (in_array($val['id'], $dayTransfer[$i])): ?>
                                                    <?php $checked = 'checked'; ?>
                                                <?php else: ?>
                                                    <?php $checked = ''; ?>
                                                <?php endif; ?>
                                                <div><input type="checkbox" id="d01-transfer-type-<?= $key + 1 ?>"
                                                            data-name="<?= $val['name'] ?>" name="d[01][transfer][]"
                                                            value="<?= $val['id'] ?>" <?= $checked ?>>
                                                    <label for="d01-transfer-type-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>

                                        <div class="distance-box hide-element">
                                            <label for="d<?= $numDay ?>-distance" class="default">приблизительное
                                                расстояние
                                                <input id="d<?= $numDay ?>-distance" type="number" min="0" max='99999'
                                                       placeholder="около" value="<?= $day['distance'] ?>"
                                                       name="d[<?= $numDay ?>][transfer_distance]">
                                                км за день</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="repeat-4-all unlocked">
                                    <?php if ($day['transfer_checkbox'] == 1): ?>
                                        <?php $checked = 'checked' ?>
                                    <?php else: ?>
                                        <?php $checked = '' ?>
                                    <?php endif; ?>
                                    <input type="checkbox" id="d01-day-transfer" data-name="transfer-lock"
                                           name="d[01][transfer_checkbox]" <?= $checked ?>>
                                    <label for="d01-day-transfer"></label>
                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Укажи названия конкретных мест (достопримечательностей или интересных локаций),
                                            которые группа посетит в этот день.</p>
                                        <p>Используй&nbsp;&nbsp;<span class="add-elem"></span>, чтобы добавить в список новую локацию.</p>
                                        <p>Подробнее о Локациях в базе знаний:
                                        <a href="/support/knowledge-base#place-activity" target="_blank" class="link">
                                            <span class="img_map-and-route">&nbsp;Локации&nbsp;и&nbsp;активности</span></a></p>
                                    </div>
                                </div>

                                <span>Локация&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <?php if (empty($dayPoint[$i])): ?>
                                    <div class="day__text group">
                                        <input id="d01-point-1" type="text" maxlength="70"
                                               placeholder="до 50 символов" name="d[01][point][1]">
                                        <span class="add-elem"></span>
                                    </div>
                                <?php endif; ?>

                                <?php for ($a = 0; $a < count($dayPoint[$i]); $a++): ?>

                                    <?php

                                    $value = $dayPoint[$i][$a];

                                    if ($a == 0) {
                                        $classDiv = '';
                                        $classSpan = 'add-elem';
                                    } else {
                                        $classDiv = 'dashed-line';
                                        $classSpan = 'delete-elem';
                                    }

                                    ?>

                                    <div class="day__text group <?= $classDiv ?>">
                                        <input id="d01-point-<?= $a + 1 ?>" type="text" maxlength="70"
                                               placeholder="до 50 символов" name="d[01][point][<?= $a + 1 ?>]"
                                               value="<?= htmlspecialchars($value['name'], ENT_QUOTES) ?>">
                                        <span class="<?= $classSpan ?>"></span>
                                    </div>

                                <?php endfor; ?>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Добавь планируемые в этот день групповые активности (экскурсии, прогулки,
                                           развлечения, обучение и прочие мероприятия)</p>
                                        <p>Используй&nbsp;&nbsp;<span class="add-elem"></span>, чтобы добавить в список новую активность.</p>
                                        <p>Подробнее об активностях в базе знаний:
                                        <a href="/support/knowledge-base#place-activity" target="_blank" class="link">
                                            <span class="img_map-and-route">&nbsp;Локации&nbsp;и&nbsp;активности</span></a></p>
                                    </div>
                                </div>

                                <span>Активность&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <?php if (empty($dayActivity[$i])): ?>
                                    <div class="day__text group">
                                        <input id="d01-activity-1" type="text" maxlength="100"
                                               placeholder="до 70 символов" name="d[01][activity][1]">
                                        <span class="add-elem"></span>
                                    </div>
                                <?php endif; ?>

                                <?php for ($a = 0; $a < count($dayActivity[$i]); $a++): ?>

                                    <?php

                                    $value = $dayActivity[$i][$a];

                                    if ($a == 0) {
                                        $classDiv = '';
                                        $classSpan = 'add-elem';
                                    } else {
                                        $classDiv = 'dashed-line';
                                        $classSpan = 'delete-elem';
                                    }

                                    ?>

                                    <div class="day__text group <?= $classDiv ?>">
                                        <input id="d01-activity-<?= $a + 1 ?>" type="text" maxlength="100"
                                               placeholder="до 70 символов" name="d[01][activity][<?= $a + 1 ?>]"
                                               value="<?= htmlspecialchars($value['name'], ENT_QUOTES) ?>">
                                        <span class="<?= $classSpan ?>"></span>
                                    </div>

                                <?php endfor; ?>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Добавь развернутое описание программы на день: планы, описание
                                            достопримечательностей или другую полезную информацию.</p>
                                    </div>
                                </div>

                                <span>Программа&nbsp;дня&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <div class="day__text">

                            <textarea data-autoresize rows="4" id="d01-day-plan" maxlength="1200" placeholder="до 1000 символов"
                                      name="d[01][description]"><?= $day['description'] ?></textarea>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day end">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Выбери из Галереи одно изображение, подходящее под программу дня (фото
                                            достопримечательности или активности).</p>
                                    </div>
                                </div>

                                <span>Фото&nbsp;</span>

                            </div>

                            <div class="program-form__text day group end">
                                <div id="d01-image" class="checked-img">
                                    <?php if ($dayImg[$i]): ?>
                                        <span class="delete-clone"></span>
                                        <img src="../../images/tours/<?= $program->partner_id ?>/<?= $program->id ?>/mini/<?= $dayImg[$i] ?>"
                                             alt="day_01-image" data-img-name="<?= $dayImg[$i] ?>">
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="d[01][img]" value="<?= $dayImg[$i] ?>">
                                <div class="day__text group">
                                    <div class="choose-img btn-grey-mini">
                                        <span>выбрать из галереи</span>
                                    </div>
                                </div>
                            </div>

                        </div>  <!-- day 1 -->

                    </div>

                </div>

            <?php else: ?>

                <!-- Последующие дни -->
                <div id="day-<?= $i ?>" data-day="<?= $i ?>" class="day-box closed">

                    <div class="program-form__field start day closed">

                        <div class="day-title closed">
                            <span class="group"><?= $i ?>&nbsp;день</span>
                        </div>

                        <div class="group day-nav">
                            <div class="day-clone"></div>
                            <div class="day-delete"></div>
                        </div>

                    </div>

                    <div class="day-cover hide-element">

                        <div class="program-form__field night-place day">

                            <div class="program-form__title day">

                                <span>&nbsp;Ночевка&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group day-place">
                                    <div class="select-cover">
                                        <select id="d<?= $numDay ?>-country" class="day-country"
                                                name="d[<?= $numDay ?>][country_id]" required>
                                            <?php if (empty($arrCountry)): ?>
                                                <?php $nameOption = 'страна не указана'; ?>
                                            <?php elseif (!empty($arrCountry) && empty($day['geo']->country_id)): ?>
                                                <?php $nameOption = 'страна из списка'; ?>
                                            <?php endif; ?>

                                            <option value="" selected disabled><?= $nameOption ?></option>
                                            <?php foreach ($arrCountry as $value): ?>
                                                <?php if ($value['id'] == $day['geo']->country_id): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['name'] ?></option>
                                            <?php endforeach; ?>
                                            <!-- привязан к JS при клике по select создает теги option ко всем выбранным странам' -->
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <input type="text" id="d<?= $numDay ?>-city"
                                               placeholder="город (введи первые буквы названия и выбери из списка)"
                                               name="d[<?= $numDay ?>][city_name]"
                                               value="<?= $geo->getCityName($day['geo']->city_id) ?>" required>
                                        <input type="hidden" value="<?= ($day['geo'])->city_id ?>"
                                               name="d[<?= $numDay ?>][city_id]"
                                               id="d<?= $numDay ?>-city-id" class="day__city-id">
                                        <input type="hidden" value="<?= $day['geo']->area_id ?>"
                                               name="d[<?= $numDay ?>][area_id]"
                                               id="d<?= $numDay ?>-area-id" class="day__area-id">
                                        <!--<select id="d<?= $numDay ?>-city" required>
                                            <option value="" selected disabled>город не указан</option>
                                            <option value="other">нет в списке</option>
                                        </select>-->
                                    </div>
                                </div>

                                <div class="repeat-4-all"></div>

                            </div>

                        </div>

                        <div class="program-form__field night-place day">

                            <div class="program-form__title day">

                                <span>&nbsp;Размещение&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text day-accommodation group">
                                    <div class="select-cover">
                                        <select id="d<?= $numDay ?>-accommodation" class="text accommodation-type"
                                                name="d[<?= $numDay ?>][accommodation]"
                                                required>
                                            <option value="" selected disabled>тип жилья</option>
                                            <?php foreach ($arrAccommodation as $val): ?>
                                                <?php if ($day['accommodation_id'] == $val['id']): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <select id="d<?= $numDay ?>-accommodation_room" class="text" name="d[<?= $numDay ?>][accommodation_room]" required>
                                            <option value="" selected disabled>вместимость номера</option>
                                            <?php foreach ($arrAccommodationRoom as $val): ?>
                                                <?php if ($day['accommodation_room_id'] == $val['id']): ?>
                                                    <?php $select = 'selected'; ?>
                                                <?php else: ?>
                                                    <?php $select = ''; ?>
                                                <?php endif; ?>
                                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="repeat-4-all"></div>

                            </div>

                        </div>

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Питание&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text day-meal">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">включенное в стоимость</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d<?= $numDay ?>-meal" class="checkbox-block meal-box">
                                            <!-- #no-meal, #meal-na привязан к JS-скрипту -->

                                            <?php foreach ($arrDayMeal as $key => $val): ?>
                                                <?php if (in_array($val['id'], $dayMeal[$i])): ?>
                                                    <?php $checked = 'checked'; ?>
                                                <?php else: ?>
                                                    <?php $checked = ''; ?>
                                                <?php endif; ?>
                                                <div><input type="checkbox"
                                                            id="d<?= $numDay ?>-meal-<?= $key + 1 ?>"
                                                            data-name="<?= $val['name'] ?>"
                                                            name="d[<?= $numDay ?>][meal][]"
                                                            value="<?= $val['id'] ?>" <?= $checked ?>>
                                                    <label for="d<?= $numDay ?>-meal-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>

                                </div>

                                <div class="repeat-4-all"></div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Трансфер&nbsp;</span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group day-transfer">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">способ перемещения группы по маршруту</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d<?= $numDay ?>-transfer-type" class="checkbox-block transfer-box">

                                            <?php foreach ($arrDayTransfer as $key => $val): ?>
                                                <?php if (in_array($val['id'], $dayTransfer[$i])): ?>
                                                    <?php $checked = 'checked'; ?>
                                                <?php else: ?>
                                                    <?php $checked = ''; ?>
                                                <?php endif; ?>
                                                <div><input type="checkbox"
                                                            id="d<?= $numDay ?>-transfer-type-<?= $key + 1 ?>"
                                                            data-name="<?= $val['name'] ?>"
                                                            name="d[<?= $numDay ?>][transfer][]"
                                                            value="<?= $val['id'] ?>" <?= $checked ?>>
                                                    <label for="d<?= $numDay ?>-transfer-type-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>

                                        <div class="distance-box hide-element">
                                            <label for="d<?= $numDay ?>-distance" class="default">приблизительное
                                                расстояние</label>
                                            <input id="d<?= $numDay ?>-distance" type="number" min="0" max='99999'
                                                   placeholder="около" value="<?= $day['distance'] ?>"
                                                   name="d[<?= $numDay ?>][transfer_distance]">
                                            <span class="default">км за день</span>
                                        </div>

                                    </div>

                                </div>

                                <div class="repeat-4-all"></div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>Локация&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <?php if (empty($dayPoint[$i])): ?>
                                    <div class="day__text group">
                                        <input id="d<?= $numDay ?>-point-1" type="text" maxlength="70"
                                               placeholder="до 50 символов" name="d[<?= $numDay ?>][point][1]">
                                        <span class="add-elem"></span>
                                    </div>
                                <?php endif; ?>

                                <?php for ($a = 0; $a < count($dayPoint[$i]); $a++): ?>

                                    <?php

                                    $value = $dayPoint[$i][$a];

                                    if ($a == 0) {
                                        $classDiv = '';
                                        $classSpan = 'add-elem';
                                    } else {
                                        $classDiv = 'dashed-line';
                                        $classSpan = 'delete-elem';
                                    }

                                    ?>

                                    <div class="day__text group <?= $classDiv ?>">
                                        <input id="d<?= $numDay ?>-point-<?= $a + 1 ?>" type="text" maxlength="70"
                                               placeholder="до 50 символов"
                                               name="d[<?= $numDay ?>][point][<?= $a + 1 ?>]"
                                               value="<?= htmlspecialchars($value['name'], ENT_QUOTES) ?>">
                                        <span class="<?= $classSpan ?>"></span>
                                    </div>

                                <?php endfor; ?>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>Активность&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <?php if (empty($dayActivity[$i])): ?>
                                    <div class="day__text group">
                                        <input id="d<?= $numDay ?>-activity-1" type="text" maxlength="100"
                                               placeholder="до 70 символов" name="d[<?= $numDay ?>][activity][1]">
                                        <span class="add-elem"></span>
                                    </div>
                                <?php endif; ?>

                                <?php for ($a = 0; $a < count($dayActivity[$i]); $a++): ?>

                                    <?php

                                    $value = $dayActivity[$i][$a];

                                    if ($a == 0) {
                                        $classDiv = '';
                                        $classSpan = 'add-elem';
                                    } else {
                                        $classDiv = 'dashed-line';
                                        $classSpan = 'delete-elem';
                                    }

                                    ?>

                                    <div class="day__text group <?= $classDiv ?>">
                                        <input id="d<?= $numDay ?>-activity-<?= $a + 1 ?>" type="text" maxlength="100"
                                               placeholder="до 70 символов"
                                               name="d[<?= $numDay ?>][activity][<?= $a + 1 ?>]"
                                               value="<?= htmlspecialchars($value['name'], ENT_QUOTES) ?>">
                                        <span class="<?= $classSpan ?>"></span>
                                    </div>

                                <?php endfor; ?>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>Программа&nbsp;дня&nbsp;</span>

                            </div>

                            <div class="program-form__text day">

                                <div class="day__text">

                            <textarea data-autoresize id="d<?= $numDay ?>-day-plan" rows="4" maxlength="1200"
                                      placeholder="до 1000 символов"
                                      name="d[<?= $numDay ?>][description]"><?= $day['description'] ?></textarea>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day end">

                                <span>Фото&nbsp;</span>

                            </div>

                            <div class="program-form__text day group end">
                                <div id="d<?= $numDay ?>-image" class="checked-img">
                                    <?php if ($dayImg[$i]): ?>
                                        <span class="delete-clone"></span>
                                        <img src="../../images/tours/<?= $program->partner_id ?>/<?= $program->id ?>/mini/<?= $dayImg[$i] ?>"
                                             alt="day_<?= $numDay ?>-image" data-img-name="<?= $dayImg[$i] ?>">
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="d[<?= $numDay ?>][img]" value="<?= $dayImg[$i] ?>">
                                <div class="day__text group">
                                    <div class="choose-img btn-grey-mini">
                                        <span>выбрать из галереи</span>
                                    </div>
                                </div>
                            </div>

                        </div>  <!-- day 2 -->

                    </div>

                </div>
            <?php endif; ?>

        <?php endfor; ?>

        <!-- add new day -->
        <div id="add-day" class="add-day">
            <span><i class="icon-doc-new"></i>&nbsp;добавить&nbsp;&nbsp;день</span>
        </div>

    </form>

    <!-- day template for add-new-day action-->
    <div id="day-0" data-day="0" class="day-box opened hide-element">

        <div class="program-form__field start day opened">

            <div class="day-title opened">
                <span class="group">0&nbsp;день</span>
            </div>

            <div class="group day-nav">
                <div class="day-clone"></div>
                <div class="day-delete"></div>
            </div>

        </div>

        <div class="day-cover">

            <div class="program-form__field night-place day">

                <div class="program-form__title day">

                    <span>&nbsp;Ночевка&nbsp;<span class="red">*</span></span>

                </div>

                <div class="program-form__text day group">

                    <div class="day__text group day-place">
                        <div class="select-cover">
                            <select id="d00-country" class="day-country" name="d[00][country_id]" required>
                                <?php if (empty($arrCountry)): ?>
                                    <?php $nameOption = 'страна не указана'; ?>
                                <?php elseif (!empty($arrCountry) && empty($day['geo']->country_id)): ?>
                                    <?php $nameOption = 'страна из списка'; ?>
                                <?php endif; ?>

                                <option value="" selected disabled><?= $nameOption ?></option>
                                <?php foreach ($arrCountry as $value): ?>
                                    <?php if ($value['id'] == $day['geo']->country_id): ?>
                                        <?php $select = 'selected'; ?>
                                    <?php else: ?>
                                        <?php $select = ''; ?>
                                    <?php endif; ?>
                                    <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="select-cover">
                            <input type="text" id="d00-city"
                                   placeholder="город (введи первые буквы названия и выбери из списка)"
                                   name="d[00][city_name]"
                                   value="" required>
                            <input type="hidden" value="" name="d[00][city_id]"
                                   id="d00-city-id" class="day__city-id">
                            <input type="hidden" value="" name="d[00][area_id]"
                                   id="d00-area-id" class="day__area-id">
                        </div>
                    </div>

                    <div class="repeat-4-all"></div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field night-place day">

                <div class="program-form__title day">

                    <span>&nbsp;Размещение&nbsp;<span class="red">*</span></span>

                </div>

                <div class="program-form__text day group">

                    <div class="day__text day-accommodation group">
                        <div class="select-cover">
                            <select id="d00-accommodation" class="text accommodation-type" name="d[00][accommodation]" required>
                                <option value="" selected disabled>тип жилья</option>
                                <?php foreach ($arrAccommodation as $val): ?>
                                    <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="select-cover">
                            <select id="d00-accommodation_room" class="text" name="d[00][accommodation_room]" required>
                                <option value="" selected disabled>вместимость номера</option>
                                <?php foreach ($arrAccommodationRoom as $val): ?>
                                    <?php if ($day['accommodation_room_id'] == $val['id']): ?>
                                        <?php $select = 'selected'; ?>
                                    <?php else: ?>
                                        <?php $select = ''; ?>
                                    <?php endif; ?>
                                    <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="repeat-4-all"></div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day">
                    <span>&nbsp;Питание&nbsp;<span class="red">*</span></span>

                </div>

                <div class="program-form__text day group">

                    <div class="day__text day-meal">

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default">включенное в стоимость</div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id="d00-meal" class="checkbox-block meal-box">
                                <!-- #no-meal, #meal-na привязан к JS-скрипту -->
                                <?php foreach ($arrDayMeal as $key => $val): ?>
                                    <div>
                                        <input type="checkbox" id="d00-meal-<?= $key + 1 ?>"
                                               data-name="<?= $val['name'] ?>"
                                               name="d[00][meal][]"
                                               value="<?= $val['id'] ?>">
                                        <label for="d00-meal-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>

                    <div class="repeat-4-all"></div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day">

                    <span>&nbsp;Трансфер&nbsp;</span>

                </div>

                <div class="program-form__text day group">

                    <div class="day__text group day-transfer">

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default">способ перемещения группы по маршруту</div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id="d00-transfer-type" class="checkbox-block transfer-box">
                                <?php foreach ($arrDayTransfer as $key => $val): ?>
                                    <div><input type="checkbox" id="d00-transfer-type-<?= $key + 1 ?>"
                                                data-name="<?= $val['name'] ?>" name="d[00][transfer][]"
                                                value="<?= $val['id'] ?>">
                                        <label for="d00-transfer-type-<?= $key + 1 ?>"><span><?= $val['name'] ?></span></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="distance-box hide-element">
                                <label for="d00-distance" class="default">приблизительное расстояние</label>
                                <input id="d00-distance" type="number" min="0" max='99999' placeholder="около"
                                       name="d[00][transfer_distance]">
                                <span class="default">км за день</span>
                            </div>

                        </div>

                    </div>

                    <div class="repeat-4-all"></div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day">

                    <span>Локация&nbsp;</span>

                </div>

                <div class="program-form__text day">
                    <div class="day__text group">
                        <input id="d00-point-1" type="text" maxlength="70"
                               placeholder="до 50 символов" name="d[00][point][1]">
                        <span class="add-elem"></span>
                    </div>
                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day">

                    <span>Активность&nbsp;</span>

                </div>

                <div class="program-form__text day">

                    <div class="day__text group">
                        <input id="d00-activity-1" type="text" maxlength="100"
                               placeholder="до 70 символов" name="d[00][activity][1]">
                        <span class="add-elem"></span>
                    </div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day">

                    <span>Программа&nbsp;дня&nbsp;</span>

                </div>

                <div class="program-form__text day">

                    <div class="day__text">

                    <textarea data-autoresize id="d00-day-plan" rows="4" maxlength="1200" placeholder="до 1000 символов"
                              name="d[00][description]"></textarea>

                    </div>

                </div>

            </div>  <!-- day 00 -->

            <div class="program-form__field day">

                <div class="program-form__title day end">

                    <span>Фото&nbsp;</span>

                </div>

                <div class="program-form__text day group end">
                    <div id="d00-image" class="checked-img"></div>
                    <input type="hidden" name="d[00][img]">
                    <div class="day__text group">
                        <div class="choose-img btn-grey-mini">
                            <span>выбрать из галереи</span>
                        </div>
                    </div>
                </div>

            </div>  <!-- day 00 -->

        </div>

    </div>

</div>

<!-- add photo from gallery -->
<div id="choose-img" class="body-disable hide-element" data-checked-img="<?= $imgString ?>">
    <div class="choose-img-box">
        <span class="close-pop-up"></span>
        <h2 class="block-title"></h2>
        <p>Чтобы добавить иллюстрацию к программе дня, выбери подходящее изображение из загруженных в "Галерею"
            фотографий или добавь новое фото.</p>
        <div id="img-archive-box"></div>

    </div>
</div>
