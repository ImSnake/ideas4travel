<?php

use app\Models\organizer\Person;
use app\services\renderer\TemplateRenderer;
use app\helpers\HtmlHelpers;

/* @var $errors */
/* @var $form Person */
/* @var $countriesArr array */
/* @var $this TemplateRenderer */

$this->title = "Персональная информация организатора";

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

<!-- <div class="center"> -->

<section class="container organizer__profile">

    <div class="organizer__information">

        <div class="back-n-wrap" data-page="">
            <a href="/organizer"><span>назад</span><span class="mobile">&nbsp;в&nbsp;Меню</span></a>
            <h2>Редактировать персональные данные</h2>
        </div>

        <!-- ФОРМА ДЛЯ "ЧАСТНЫЙ ГИД" -->

        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__personal-data">

            <h2 class="block-title">Частный гид</h2>

            <div class="organizer__info-field">

                <div class="radio-btn-cover">

                    <span class="info-field__head">Пол&nbsp;<span class="red">*</span></span>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="male" name="person[sex]"
                           value="m" <?php if ($form->sex == 'm') echo 'checked' ?>>
                    <label for="male"><span>мужчина</span></label>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="female" name="person[sex]"
                           value="w" <?php if ($form->sex == 'w') echo 'checked' ?>>
                    <label for="female"><span>женщина</span></label>
                </div>

            </div>

            <div class="organizer__info-field">

                <label for="name" class="info-field__head">Имя&nbsp;<span
                        class="red">*</span></label>
                <input id="name" type="text" value="<?= $form->first_name ?>" name="person[first_name]" placeholder="как указано в паспорте" required>

                <label for="patronymic" class="info-field__head">Отчество&nbsp;<span
                        class="red">*</span></label>
                <input id="patronymic" type="text" value="<?= $form->patronymic ?>" name="person[patronymic]" placeholder="как указано в паспорте">

                <label for="surname" class="info-field__head">Фамилия&nbsp;<span
                        class="red">*</span></label>
                <input id="surname" type="text" value="<?= $form->last_name ?>" name="person[last_name]" placeholder="как указано в паспорте" required>

            </div>

            <div class="organizer__info-field">

                <label for="person-birthday" class="info-field__head">Дата&nbsp;рождения&nbsp;<span
                            class="red">*</span></label>

                <input id="person-birthday" type="date" data-placeholder="дд.мм.гггг" value="<?= $form->birthday ?>"
                       name="person[birthday]" required aria-required="true">

            </div>

            <div class="organizer__info-field">

                <label for="person-registration" class="info-field__head">Адрес&nbsp;регистрации&nbsp;<span
                            class="red">*</span></label>
                <!-- select-cover - обертка для стелизации тега select-->
                <div class="select-cover">
                    <!-- не удалять в select атрибут required-->
                    <select id="reg_country" aria-labelledby='person-registration' name="person[reg_country]" required>
                        <!--не удалять в option disabled значение атрибута value="" -->
                        <?php if (!$form->reg_country): ?>
                            <option value="" disabled selected>страна</option>
                        <?php endif; ?>
                        <option value="RU">Россия</option>
                        <?php foreach ($countriesArr as $item): ?>
                            <?php if ($item['id'] == $form->reg_country): ?>
                                <?php $selected = 'selected' ?>
                            <?php else: ?>
                                <?php $selected = '' ?>
                            <?php endif; ?>
                            <option value="<?= $item['id'] ?>" <?= $selected ?>><?= $item['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input id="index" aria-labelledby='person-registration' type="text" value="<?= $form->reg_index ?>"
                       name="person[reg_index]" pattern="[0-9]{4,9}" placeholder="индекс">
                <!-- class="select-cover" - обертка для стелизации тега select-->

                <div>
                    <input type="text" id="reg_city_name" placeholder="город (введи первые буквы названия и выбери из списка)" name="person[reg_city_name]"
                           value="<?= HtmlHelpers::getCityName($form->reg_city) ?>" required>
                    <input type="hidden" value="<?= $form->reg_city ?>" name="person[reg_city]" id="reg_city">
                    <input type="hidden" value="<?= $form->reg_area ?>" name="person[reg_area]" id="reg_area">
                </div>

                <input id="person-registration" type="text" value="<?= $form->reg_address ?>"
                       name="person[reg_address]" placeholder="адрес" required>

            </div>

            <div class="info-field__head checkbox-cover">
                <div>Фактический&nbsp;адрес&nbsp;(место постоянного проживания) <span class="red">*</span></div>
                <!-- не менять id: связан с JS (открытие\закрытие блока "Фактический адрес")-->
                <?php if ($form->fact_match == 'on'): ?>
                    <input type="checkbox" id="fact-address" name="person[fact_match]" checked>
                <?php else: ?>
                    <input type="checkbox" id="fact-address" name="person[fact_match]">
                <?php endif; ?>
                <label for="fact-address"
                       class="info-field__head"><span>совпадает&nbsp;с&nbsp;регистрацией</span></label>
            </div>

            <div class="organizer__info-field">

                <div id="compare">
                    <!-- select-cover - обертка для стелизации тега select-->
                    <div class="select-cover">
                        <!-- не удалять в select атрибут required-->
                        <select id="fact_country" aria-labelledby='person-fact-address'
                                name="person[fact_country]" required>
                            <!--не удалять в option disabled значение атрибута value="" -->
                            <?php if (!$form->fact_country): ?>
                                <option value="" disabled selected>страна</option>
                            <?php endif; ?>
                            <option value="RU">Россия</option>
                            <?php foreach ($countriesArr as $item): ?>
                                <?php if ($item['id'] == $form->fact_country): ?>
                                    <?php $selected = 'selected' ?>
                                <?php else: ?>
                                    <?php $selected = '' ?>
                                <?php endif; ?>
                                <option value="<?= $item['id'] ?>" <?= $selected ?>><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input id="index-fact" aria-labelledby='person-fact-address' type="text" value="<?= $form->fact_index ?>"
                           name="person[fact_index]" pattern="[0-9]{4,9}" placeholder="индекс">
                    <div>
                        <!-- не удалять в input атрибут required-->
                        <input type="text" id="fact_city_name" placeholder="город (введи первые буквы названия и выбери из списка)" name="person[fact_city_name]"
                               value="<?= HtmlHelpers::getCityName($form->fact_city) ?>" required>
                        <input type="hidden" value="<?= $form->fact_city ?>" name="person[fact_city]" id="fact_city">
                        <input type="hidden" value="<?= $form->fact_area ?>" name="person[fact_area]" id="fact_area">
                    </div>

                    <input id="fact-address" type="text" value="<?= $form->fact_address ?>"
                           name="person[fact_address]" placeholder="адрес" required>

                </div>

            </div>

            <div class="organizer__info-field experience">

                <div class="info-field__head">Опыт&nbsp;и&nbsp;экспертиза&nbsp;<span class="red">*</span></div>

                <label for="person-experience" class="info-field__head">стаж&nbsp;в&nbsp;туризме</label>
                <input id="person-experience" type="number" min="0" max="50"
                       value="<?= $form->person_experience ?>" name="person[person_experience]"
                       placeholder="лет" required>

                <label for="tour-experience" class="info-field__head">опыт&nbsp;в&nbsp;организации&nbsp;туров</label>
                <input id="tour-experience" type="number" min="0" max="50"
                       value="<?= $form->tour_experience ?>" name="person[tour_experience]"
                       placeholder="лет" required>

                <label for="tours-number" class="info-field__head">количество&nbsp;проведенных&nbsp;туров</label>
                <input id="tours-number" type="number" min="0" max="10000"
                       value="<?= $form->tour_number ?>" name="person[tour_number]"
                       placeholder="групп" required>
            </div>

            <div class="organizer__button">
                <button type="submit" class="btn-blue" name="person[submit-person]">
                    <span>Сохранить</span>
                </button>
            </div>

        </form>

    </div>

</section>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->