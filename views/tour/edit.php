<?php

use app\base\App;
use app\Models\program\Program;
use app\Models\tour\Tour;
use app\services\Currency;
use app\services\renderer\TemplateRenderer;

/* @var $tour Tour */
/* @var $program Program */
/* @var $arrStatus array */
/* @var $arrSeason array */
/* @var $arrCurrency array */
/* @var $arrExtraCostPreset array */
/* @var $extraCostPreset array */
/* @var $arrExtraCostByType array */
/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Добавить тур на сайт";
$this->description = "Добавление нового тура";

$this->cssFiles = ['organizer/tour-form.css'];

$this->jsFiles = [
    'organizer/organizer_common.js',
    'jquery/jquery.common_plugins.js',
    'jquery/jquery.inputmask.js',
    'organizer/organizer_tour_edit.js',
    'ajax/tour/tour-ajax.js'
];

// Подключаем добавление новой программы.
//include VIEWS_DIR . "/blocks-html/tour/create.php";

$preset = $arrExtraCostByType['preset'];
$required = $arrExtraCostByType['required'];
$additional = $arrExtraCostByType['additional'];

/** @var Currency $currency */
$currency = App::get()->currency;

?>

<section class="container organizer__new-tour" xmlns="http://www.w3.org/1999/html">

    <div class="back-n-wrap" data-page="">
        <a href="/tours"><span>назад в Туры</span></a>
    </div>

    <div class="new-tour__heading">
        <div>Редактировать тур:</div>
        <div class="heading__program-name"><?= mb_strtoupper($program->name) ?></div>
    </div>

    <form id="tour-form-edit" action="#" method="post" data-tour-id="<?= $tour->id ?>">

        <div>

            <div class="new-tour__form-block">

                <h2 class="block-title">Подробнее о туре</h2>

                <div class="form-block__field">
                    <label for="start-date" class="label-width title">Дата начала<span
                                class="required-sign"></span></label>
                    <input id="start-date" name="tour[start_at]" type="date" value="<?= $tour->start_at ?>"
                           data-placeholder="дд.мм.гггг" required>
                </div>

                <div class="form-block__field">
                    <label for="status" class="label-width title">Статус тура<span class="required-sign"></span></label>

                    <div class="select-cover">
                        <select id="status" name="tour[t_status_id]" required>
                            <option selected disabled value="">из списка</option>
                            <?php foreach ($arrStatus as $val): ?>
                                <?php if ($tour->t_status_id == $val['id']): ?>
                                    <?php $select = 'selected'; ?>
                                <?php else: ?>
                                    <?php $select = ''; ?>
                                <?php endif; ?>
                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p><span class="blue bold">Идет набор</span> - тур может быть отменен</p>
                            <p><span class="blue bold">Гарантирован</span> - тур 100% состоится</p>
                        </div>
                    </div>
                </div>

                <div class="form-block__field">
                    <label for="season" class="label-width title">Тип сезона<span class="required-sign"></span></label>
                    <div class="select-cover">
                        <select id="season" name="tour[t_season_id]" required>
                            <option selected disabled value="">из списка</option>
                            <?php foreach ($arrSeason as $val): ?>
                                <?php if ($tour->t_season_id == $val['id']): ?>
                                    <?php $select = 'selected'; ?>
                                <?php else: ?>
                                    <?php $select = ''; ?>
                                <?php endif; ?>
                                <option value="<?= $val['id'] ?>" <?= $select ?>><?= $val['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Укажи тип сезона на планируемую дату тура.</p>
                            <p>По многим направлениями стоимость билетов, отелей и прочих услуг зависит от типа
                                сезона.</p>
                        </div>
                    </div>
                </div>

                <div class="form-block__field">
                    <label for="t-min" class="label-width title">Погода&nbsp;&nbsp;от</label>
                    <input id='t-min' type="text" class="degree" placeholder="t" name="tour[temp_min]"
                           value="<?= $tour->temp_min ?>">
                    <label for="t-max" class="title">до</label>
                    <input id='t-max' type="text" class="degree" placeholder="t" name="tour[temp_max]"
                           value="<?= $tour->temp_max ?>">
                    <span class="title">C&deg;</span>

                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Ожидаемые погодные условия на даты проведения тура</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="new-tour__form-block">

                <h2 class="block-title">Цены и наличие мест</h2>

                <div class="form-block__field">
                    <label for="price" class="title">Стоимость<span class="required-sign"></span></label>
                    <input id="price" name="tour[price]" value="<?= $tour->price ?>" type="number" placeholder="сумма"
                           required>
                    <div class="select-cover currency">
                        <select name="tour[currency]" required>
                            <option selected disabled value="">валюта</option>
                            <?php foreach ($currency->getCurrency() as $item): ?>
                                <?php if ($tour->currency == $item['id']): ?>
                                    <?php $select = 'selected'; ?>
                                <?php else: ?>
                                    <?php $select = ''; ?>
                                <?php endif; ?>
                                <option value="<?= $item['id'] ?>" <?= $select ?>><?= $item['symbol'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!--<span>за 1 место</span>-->
                </div>

                <div class="form-block__field">
                    <label for="available" class="title">Свободно<span class="required-sign"></span></label>
                    <input id="available" type="number" min="1" max="50" placeholder="0" name="tour[available]"
                           value="<?= $tour->available ?>" required>
                    <span class="title">мест</span>
                </div>

                <div class="form-block__field">
                    <label for="discount" class="title">Установить скидку</label>
                    <input id="discount" type="number" name="tour[discount]" value="<?= $tour->discount ?>"
                           placeholder=" 0 ">
                    <span class="title">%</span>
                    <label for="discount-timeOut" class="title"> до</label>
                    <input id="discount-timeOut" name="tour[discount_at]" value="<?= $tour->discount_at ?>" type="date"
                           data-placeholder="дд.мм.гггг" required>
                    <!--                    <div class="help hover">
                                            <div class="help-pop-up top fade hide-element">
                                                <span class="close-pop-up"></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima
                                                    obcae</p>
                                            </div>
                                        </div>-->
                </div>

                <!--
                            <div class="form-block__field">
                                <input id="kids-price" type="checkbox">
                                <label for="kids-price"></label>
                                <span>есть скидки на участие детей</span>
                            </div>-->

            </div>

            <div class="new-tour__form-block">

                <h2 class="block-title">Бронирование</h2>

                <div class="form-block__field">
                    <label for="book-term" class="title">Прием заявок не позднее
                        <!--<span class="required"></span>--></label>
                    <input id="book-term" name="tour[booking_until]" value="<?= $tour->booking_until ?>" type="number"
                           min='2' max="99" placeholder="2">
                    <span class="title">дней до начала</span>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Если поле не заполнено, то объявление будет снято с публикации за&nbsp;<span
                                        class="blue bold">&nbsp;2&nbsp;</span>&nbsp;дня до начала тура</p>
                        </div>
                    </div>
                </div>

                <div class="form-block__field">
                    <label for="pre-pay" class="title">Предоплата</label>
                    <input id="pre-pay" type="number" name="tour[prepayment]" value="<?= $tour->prepayment ?>" min="0"
                           max="99" placeholder=" 0 ">
                    <span class="title">%</span>
                </div>

                <div class="form-block__field">
                    <label for="pay-term" class="title">Оплата участия не позднее</label>
                    <input id="pay-term" type="number" name="tour[pay_until]" value="<?= $tour->pay_until ?>" min="0"
                           placeholder=" 2 ">
                    <span class="title">дней до начала</span>
                </div>

                <!--                <div class="form-block__field">-->
                <!--                    <label for="tour-contact" class="title">Контакты для бронирования тура</label>-->
                <!--                    <div class="help hover">-->
                <!--                        <div class="help-pop-up top fade hide-element">-->
                <!--                            <span class="close-pop-up"></span>-->
                <!--                            <p>Если необходимо, укажи контакты конкретного лица, кто будет отвечать на вопросы об этом-->
                <!--                                туре-->
                <!--                                и принимать запросы по бронированию</p>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <textarea id="tour-contact" rows="2" name="tour[booking_contact]"-->
                <!--                              placeholder="">--><? //= $tour->booking_contact ?><!--</textarea>-->
                <!--                </div>-->

                <div class="form-block__field">
                    <label for="payment-extra" class="title">Условия бронирования и оплаты</label>
                    <textarea id="payment-extra" rows="2" name="tour[booking_conditions]"
                              placeholder=""><?= $tour->booking_conditions ?></textarea>
                </div>

                <div class="form-block__field">
                    <label for="refund" class="title">Условия отмены и возврата</label>
                    <textarea id="refund" rows="2" name="tour[refund]"
                              placeholder=""><?= $tour->refund ?></textarea>
                </div>

            </div>

        </div>

        <div id="extra-costs">

            <h2>В ЦЕНУ ТУРА НЕ ВКЛЮЧЕНО</h2>

            <div class="group">

                <div class="extra-costs__title">Обязательные затраты
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Добавь расходы по программе не включеные в цену тура, но требующие <span
                                        class="blue bold">обязательной</span>
                                оплаты для участия.</p>
                            <p>Все не отмеченные в данном блоке расходы по программе считаются включенными в цену
                                тура.</p>
                            <p>Больше информации в базе знаний:
                                <a href="/support/knowledge-base#extra-costs" target="_blank" class="link">
                                    Неучтенные расходы</a></p>
                        </div>
                    </div>
                </div>

                <?php foreach ($arrExtraCostPreset as $item): ?>

                    <?php if (isset($extraCostPreset[$item['id']])) {
                        $preset_checkbox = 'checked';
                        $preset_hide = '';
                        $preset_comment = $extraCostPreset[$item['id']]['comment'];
                        $preset_cost = $extraCostPreset[$item['id']]['cost'];
                        $preset_currency = $extraCostPreset[$item['id']]['currency'];
                        $classClosedOpened = 'opened';
                    } else {
                        $preset_checkbox = '';
                        $preset_hide = 'hide-element';
                        $preset_comment = '';
                        $preset_cost = '';
                        $preset_currency = '';
                        $classClosedOpened = 'closed';
                    } ?>

                    <div class="extra-costs__field <?= $classClosedOpened ?>">

                        <div class="extra-costs__heading">
                            <input id="<?= $item['id'] ?>-checkbox" type="checkbox"
                                   name="tour[extra_cost_preset][<?= $item['id'] ?>][checkbox]" <?= $preset_checkbox ?>>
                            <label for="<?= $item['id'] ?>-checkbox"><span><?= $item['name'] ?></span></label>
                        </div>

                        <div class="extra-costs__block <?= $preset_hide ?>">
                            <!--                    <div class="text">Как добраться из Москвы</div>-->
                            <textarea id="<?= $item['id'] ?>-comment" rows="3" placeholder="<?= $item['description'] ?>"
                                      name="tour[extra_cost_preset][<?= $item['id'] ?>][comment]"><?= $preset_comment ?></textarea>
                            <div class="group">
                                <label for="<?= $item['id'] ?>-costs" class="title">Приблизительно<span
                                            class="required-sign"></span></label>
                                <input id="<?= $item['id'] ?>-costs" type="number" min="0" placeholder="сумма затрат"
                                       name="tour[extra_cost_preset][<?= $item['id'] ?>][cost]"
                                       value="<?= $preset_cost ?>">
                                <div class="select-cover currency">
                                    <select name="tour[extra_cost_preset][<?= $item['id'] ?>][currency]" required>
                                        <option selected disabled value="">валюта</option>
                                        <?php foreach ($currency->getCurrency() as $value): ?>
                                            <?php if ($preset_currency == $value['id']): ?>
                                                <?php $select = 'selected'; ?>
                                            <?php else: ?>
                                                <?php $select = ''; ?>
                                            <?php endif; ?>
                                            <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['symbol'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

                <?php for ($i = 0; $i < count($arrExtraCostByType['required']); $i++): ?>
                    <?php $item = $arrExtraCostByType['required'][$i] ?>

                    <div class="extra-costs__field added-by-user opened">

                        <div class="extra-costs__heading">
                            <div class="delete-elem"></div>
                        </div>

                        <div class="extra-costs__block">
                            <textarea rows="2" placeholder="комментарий"
                                      name="tour[extra_cost_required][<?= $i + 1 ?>][comment]"><?= $item['comment'] ?></textarea>
                            <div class="group">
                                <label></label>
                                <input name="tour[extra_cost_required][<?= $i + 1 ?>][cost]" type="number" min="0"
                                       placeholder="сумма затрат" value="<?= $item['cost'] ?>">
                                <div class="select-cover currency">
                                    <select name="tour[extra_cost_required][<?= $i + 1 ?>][currency]" required>
                                        <option selected disabled value="">валюта</option>
                                        <?php foreach ($currency->getCurrency() as $value): ?>
                                            <?php if ($item['currency'] == $value['id']): ?>
                                                <?php $select = 'selected'; ?>
                                            <?php else: ?>
                                                <?php $select = ''; ?>
                                            <?php endif; ?>
                                            <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['symbol'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endfor; ?>

                <div id="add-required" class="add-elem"></div>
            </div>

            <div class="group">

                <div class="extra-costs__title">Дополнительные услуги
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Добавь доп.услуги по программе:<br>
                                - одноместное размещение,<br>
                                - дополнительные экскурсии,<br>
                                - аренда сняряжения<br>
                                или другие опции.</p>
                        </div>
                    </div>
                </div>

                <?php for ($i = 0; $i < count($arrExtraCostByType['additional']); $i++): ?>

                    <?php $item = $arrExtraCostByType['additional'][$i] ?>

                    <div class="extra-costs__field added-by-user opened">

                        <div class="extra-costs__heading">
                            <div class="delete-elem"></div>
                        </div>

                        <div class="extra-costs__block">
                            <textarea rows="2" placeholder="комментарий"
                                      name="tour[extra_cost_additional][<?= $i + 1 ?>][comment]"><?= $item['comment'] ?></textarea>
                            <div class="group">
                                <label></label>
                                <input name="tour[extra_cost_additional][<?= $i + 1 ?>][cost]" type="number"
                                       min="0"
                                       placeholder="сумма затрат" value="<?= $item['cost'] ?>">
                                <div class="select-cover currency">
                                    <select name="tour[extra_cost_additional][<?= $i + 1 ?>][currency]"
                                            required>
                                        <option selected disabled value="">валюта</option>
                                        <?php foreach ($currency->getCurrency() as $value): ?>
                                            <?php if ($item['currency'] == $value['id']): ?>
                                                <?php $select = 'selected'; ?>
                                            <?php else: ?>
                                                <?php $select = ''; ?>
                                            <?php endif; ?>
                                            <option value="<?= $value['id'] ?>" <?= $select ?>><?= $value['symbol'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endfor; ?>

                <div id="add-additional" class="add-elem"></div>

            </div>

        </div>

    </form>

    <div class="new-tour__bottom">

        <button id='save-exit' class="btn-grey">
            <span>Сохранить&nbsp;и&nbsp;выйти</span>
        </button>

        <?php if (!in_array($tour->t_status_admin_id, [Tour::STATUS_PUBLISHED])): ?>
            <div id="tour-submit" class="btn-orange">
                <span>Опубликовать&nbsp;тур</span>
            </div>
        <?php endif; ?>

    </div>

</section>

<div id="template-required" class="extra-costs__field added-by-user closed hide-element">

    <div class="extra-costs__heading">
        <div class="delete-elem"></div>
    </div>

    <div class="extra-costs__block">
        <textarea rows="2" placeholder="что не включено в стоимость, но требует оплаты для участия?"
                  name="tour[extra_cost_required][0][comment]"></textarea>
        <div class="group">
            <label class="title">Приблизительно<span class="required-sign"></span></label>
            <input name="tour[extra_cost_required][0][cost]" type="number" min="0" placeholder="сумма затрат">
            <div class="select-cover currency">
                <select name="tour[extra_cost_required][0][currency]" required>
                    <option selected disabled value="">валюта</option>
                    <?php foreach ($currency->getCurrency() as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['symbol'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div id="template-additional" class="extra-costs__field added-by-user closed hide-element">

    <div class="extra-costs__heading">
        <div class="delete-elem"></div>
    </div>

    <div class="extra-costs__block">
        <textarea rows="2" placeholder="дополнительные услуги, оплата по желанию участника"
                  name="tour[extra_cost_additional][0][comment]"></textarea>
        <div class="group">
            <label class="title">Приблизительно<span class="required-sign"></span></label>
            <input name="tour[extra_cost_additional][0][cost]" type="number" min="0" placeholder="сумма затрат">
            <div class="select-cover currency">
                <select name="tour[extra_cost_additional][0][currency]" required>
                    <option selected disabled value="">валюта</option>
                    <?php foreach ($currency->getCurrency() as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['symbol'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>