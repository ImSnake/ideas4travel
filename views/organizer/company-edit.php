<?php

use app\helpers\HtmlHelpers;
use app\Models\organizer\Company;
use app\Models\organizer\CompanyType;
use app\Models\organizer\PartnerType;
use app\Models\Partner;
use app\services\renderer\TemplateRenderer;
use app\Models\organizer\PartnerForm;

/* @var $errors */
/* @var $form Company */
/* @var $partner Partner */
/* @var $countriesArr array */
/* @var $this TemplateRenderer */

$this->title = "Контакты и реквизиты компании";

$this->cssFiles = [
    'organizer/profile.css',
    'jquery/jquery-ui.min.css'
];

$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_form.js',
    'jquery/jquery-ui.min.js',
    'ajax/organizer/autocomplete-reg-fact.js',
    'jquery/jquery.inputmask.js'
];

?>

<div class="container">

    <section class="organizer__profile">

        <div class="organizer__information">

            <div class="back-n-wrap" data-page="">
                <a href="/organizer"><span>назад</span><span class="mobile">&nbsp;в&nbsp;Меню</span></a>
                <h2>Редактировать реквизиты</h2>
            </div>

            <!-- ФОРМА ДЛЯ "ОРГАНИЗАЦИЯ" -->
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__personal-data">

                <h2 class="block-title">Организация</h2>

                <div class="organizer__info-field">

                    <label for="company-type" class="info-field__head">Правовая форма&nbsp;<span
                                class="red">*</span></label>
                    <div class="select-cover">
                        <select id="company-type" name="company[partner_form_id]" required>
                            <!--не удалять в option disabled значение атрибута value="" -->
                            <?php if (!$form->partner_form_id): ?>
                                <option value="" selected disabled>из списка</option>
                            <?php endif; ?>
                            <?php foreach (PartnerForm::getPartnerForm($partner->partner_entity_id) as $key => $value): ?>
                                <?php if ($key == $form->partner_form_id): ?>
                                    <?php $selected = 'selected' ?>
                                <?php else: ?>
                                    <?php $selected = '' ?>
                                <?php endif; ?>
                                <option value="<?= $key ?>" <?= $selected ?>><?= $value['form'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="organizer__info-field hide-element">

                    <label for="partner-type" class="info-field__head">Деятельность&nbsp;<span
                                class="red">*</span></label>

                    <div class="select-cover">
                        <select id="partner-type" name="company[partner_type_id]" required>
                            <!--не удалять в option disabled значение атрибута value="" -->
                            <?php if (!$form->partner_type_id): ?>
                                <option value="" selected disabled>из списка</option>
                            <?php endif; ?>
                            <?php foreach (PartnerType::getPartnerTypes(Partner::TYPE_COMPANY) as $key => $value): ?>
                                <?php if ($key == $form->partner_type_id): ?>
                                    <?php $selected = 'selected' ?>
                                <?php else: ?>
                                    <?php $selected = '' ?>
                                <?php endif; ?>
                                <option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <!-- ДОБАВИТЬ В БД ДЛЯ ТИПА ПАРТНЕРА "ОРГАНИЗАТОР-ТУРОПЕРАТОР" СТРОКУ "Номер лицензии" -->
                <div class="organizer__info-field hide-element">

                    <label for="rto-number" class="info-field__head">НОМЕР ЛИЦЕНЗИИ&nbsp;<span
                                class="red">*</span></label>

                    <input type="text" id="rto-number" value="<?= $form->rto_number ?>" name="company[rto_number]" placeholder="реестровый номер туроператора">

                </div>
                <!-- ДОБАВИТЬ В БД ДЛЯ ТИПА ПАРТНЕРА ТУРОПЕРАТОР СТРОКУ "Номер лицензии" -->

                <div class="organizer__info-field">

                    <label for="company-name" class="info-field__head">Название&nbsp;<span
                                class="red">*</span></label>

                    <input id="company-name" type="text" value="<?= $form->name ?>" name="company[name]"
                           placeholder="по учредительным документам" required>

                </div>

                <div class="organizer__info-field">

                    <label for="company-inn" class="info-field__head">ИНН&nbsp;<span class="red">*</span></label>

                    <input id="company-inn" type="text" value="<?= $form->inn ?>" name="company[inn]"
                           pattern="[0-9]{10,12}" placeholder="1234567890" required>

                </div>

                <div class="organizer__info-field">

                    <label for="company-address" class="info-field__head">Юридический&nbsp;адрес&nbsp;<span
                                class="red">*</span></label>

                    <!-- select-cover - обертка для стелизации тега select-->
                    <div class="select-cover">
                        <select id="reg_country" aria-labelledby='person-registration' name="company[reg_country]"
                                required>
                            <option value="RU" selected>Россия</option>
                        </select>
                    </div>

                    <input id="index" aria-labelledby='company-address' type="text" value="<?= $form->reg_index ?>"
                           name="company[reg_index]" pattern="[0-9]{6}" placeholder="индекс">

                    <div>
                        <input type="text" id="reg_city_name"
                               placeholder="город (введи первые буквы названия и выбери из списка)"
                               name="company[reg_city_name]"
                               value="<?= HtmlHelpers::getCityName($form->reg_city) ?>" required>
                        <input type="hidden" value="<?= $form->reg_city ?>" name="company[reg_city]" id="reg_city">
                        <input type="hidden" value="<?= $form->reg_area ?>" name="company[reg_area]" id="reg_area">
                    </div>


                    <input id="company-address" type="text" value="<?= $form->reg_address ?>"
                           name="company[reg_address]" placeholder="улица, дом, офис" required>

                </div>

                <div class="info-field__head checkbox-cover">
                    <div>Фактический&nbsp;адрес&nbsp;<span class="red">*</span></div>
                    <!-- не менять id: связан с JS (открытие\закрытие блока "Фактический адрес")-->
                    <?php if ($form->fact_match == 'on'): ?>
                        <input type="checkbox" id="fact-address" name="company[fact_match]" checked>
                    <?php else: ?>
                        <input type="checkbox" id="fact-address" name="company[fact_match]">
                    <?php endif; ?>
                    <label for="fact-address"
                           class="info-field__head"><span>совпадает&nbsp;с&nbsp;регистрацией</span></label>
                </div>

                <div class="organizer__info-field">

                    <div id="compare">
                        <!-- select-cover - обертка для стелизации тега select-->
                        <div class="select-cover">
                            <select id="fact_country" aria-labelledby='company-registration'
                                    name="company[fact_country]"
                                    required>
                                <option value="RU" selected>Россия</option>
                            </select>
                        </div>

                        <input id="index-fact" aria-labelledby='company-fact-address' type="text"
                               value="<?= $form->fact_index ?>"
                               name="company[fact_index]" pattern="[0-9]{6}" placeholder="индекс">
                        <!-- не удалять в input атрибут required-->
                        <div>
                            <input type="text" id="fact_city_name"
                                   placeholder="город (введи первые буквы названия и выбери из списка)"
                                   name="company[fact_city_name]"
                                   value="<?= HtmlHelpers::getCityName($form->fact_city) ?>" required>
                            <input type="hidden" value="<?= $form->fact_city ?>" name="company[fact_city]"
                                   id="fact_city">
                            <input type="hidden" value="<?= $form->fact_area ?>" name="company[fact_area]"
                                   id="fact_area">
                        </div>

                        <input id="fact-address" type="text" value="<?= $form->fact_address ?>"
                               name="company[fact_address]" placeholder="улица, дом, офис" required>
                    </div>

                </div>

                <div class="organizer__info-field">

                    <label for="company-phone" class="info-field__head">дополнительный телефон</label>

                    <input id="company-phone" type="tel" value="<?= $form->phone ?>" name="company[phone]"
                           pattern="(\+?\d[- .]*){7,13}" placeholder="стационарный или мобильный">

                </div>

                <div class="organizer__info-field">

                    <label for="company-email" class="info-field__head">дополнительный email</label>

                    <input id="company-email" type="email" value="<?= $form->email ?>"
                           name="company[email]" placeholder="для обмена документами">

                </div>

                <div class="organizer__button">
                    <button type="submit" class="btn-blue" name="company[submit-company]">
                        <span>Сохранить</span>
                    </button>
                </div>

            </form>

        </div>

    </section>

</div>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->