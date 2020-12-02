<!-- <div class="center"> -->

<section class="container organizer__profile">

    <div class="organizer__information">

        <div class="back-n-wrap" data-page="">
            <span><a href="/organizer">назад в Меню</a></span>
            <h2>Редактировать персональные данные</h2>
        </div>

        <!-- ФОРМА ДЛЯ "ЧАСТНЫЙ ГИД" -->

        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__personal-data">

            <h2 class="block-title">ЧАСТНЫЙ ГИД</h2>

            <!--           <form action="--><? //= $_SERVER['REQUEST_URI'] ?><!--" method="post">-->

            <div class="organizer__info-field">

                <div class="radio-btn-cover">

                    <span class="info-field__head"Пол&nbsp;<span class="red">*</span></span>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="male" name="gender" value="man">
                    <label for="male"><span>мужчина</span></label>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="female" name="gender" value="woman">
                    <label for="female"><span>женщина</span></label>
                </div>

            </div>

            <div class="organizer__info-field">

                <label for="person-birthday" class="info-field__head">Дата&nbsp;рождения&nbsp;<span
                            class="red">*</span></label>

                <input id="person-birthday" type="date" data-placeholder="дд.мм.гггг" required aria-required="true">

            </div>

            <div class="organizer__info-field">

                <label for="person-registration" class="info-field__head">Адрес&nbsp;регистрации&nbsp;по&nbsp;паспорту<span
                            class="red">*</span></label>
                <!-- select-cover - обертка для стелизации тега select-->
                <div class="select-cover">
                    <!-- не удалять в select атрибут required-->
                    <select id="country" aria-labelledby='person-registration' required>
                        <!--не удалять в option disabled значение атрибута value="" -->
                        <option value="" disabled selected>страна</option>
                        <option value="1">Россия</option>
                        <option value="2">Украина</option>
                        <option value="3">Белорусь</option>
                        <option value="3">Испания</option>
                    </select>
                </div>
                <input id="index" aria-labelledby='person-registration' type="text" maxlength="6"
                       placeholder="индекс">
                <input id="region" aria-labelledby='person-registration' type="text" placeholder="регион">
                <!-- select-cover - обертка для стелизации тега select-->
                <div class="select-cover">
                    <!-- не удалять в select атрибут required-->
                    <select id="city" aria-labelledby='person-registration' required>
                        <!--не удалять в option disabled значение атрибута value="" -->
                        <option value="" selected disabled>город</option>
                        <option value="Москва">Москва</option>
                        <option value="Самара">Самара</option>
                        <option value="Санкт-Петербург">Санкт-Петербург</option>
                        <option value="Владивосток">Владивосток</option>
                    </select>
                </div>
                <input id="person-registration" type="text" placeholder="адрес">

            </div>

            <div class="info-field__head checkbox-cover">
                <div>Фактический&nbsp;адрес&nbsp;проживания&nbsp;<span class="red">*</span></div>
                <!-- не менять id: связан с JS (открытие\закрытие блока "Фактический адрес")-->
                <input type="checkbox" id="fact-address">
                <label for="fact-address"
                       class="info-field__head"><span>совпадает&nbsp;с&nbsp;регистрацией</span></label>
            </div>

            <div class="organizer__info-field">

                <div id="compare">
                    <!-- select-cover - обертка для стелизации тега select-->
                    <div class="select-cover">
                        <!-- не удалять в select атрибут required-->
                        <select id="country-fact" aria-labelledby='person-fact-address' required>
                            <!--не удалять в option disabled значение атрибута value="" -->
                            <option value="" selected disabled>страна</option>
                            <option value="1">Россия</option>
                            <option value="2">Украина</option>
                            <option value="3">Белорусь</option>
                            <option value="3">Испания</option>
                        </select>
                    </div>
                    <input id="index-fact" aria-labelledby='person-fact-address' type="text" maxlength="6"
                           placeholder="индекс">
                    <input id="region-fac aria-labelledby='person-fact-address" type="text" placeholder="регион">
                    <input id="city-fact" aria-labelledby='person-fact-address' type="text"
                           placeholder="населенный пункт">
                    <!-- select-cover - обертка для стелизации тега select-->
                    <div class="select-cover">
                        <!-- не удалять в select атрибут required-->
                        <select id="city-fact" aria-labelledby='person-fact-address' required>
                            <!--не удалять в option disabled значение атрибута value="" -->
                            <option value="" selected disabled>город</option>
                            <option value="Москва">Москва</option>
                            <option value="Самара">Самара</option>
                            <option value="Санкт-Петербург">Санкт-Петербург</option>
                            <option value="Владивосток">Владивосток</option>
                        </select>
                    </div>
                    <input id="person-fact-address" type="text" placeholder="улица, дом, офис">

                </div>

            </div>

            <div class="organizer__info-field experience">

                <div class="info-field__head">Опыт&nbsp;и&nbsp;экспертиза&nbsp;<span class="red">*</span></div>

                <input id="person-experience" type="number" min="0" max="50"
                       placeholder=" 0"><label for="person-experience">стаж&nbsp;в&nbsp;туризме, лет</label>
                <input id="tour-experience" type="number" min="0" max="50"
                       placeholder=" 0"><label for="tour-experience">опыт&nbsp;в&nbsp;организации&nbsp;туров, лет</label>
                <input id="tours-number" type="number" min="0" max="1000"
                       placeholder=" 0"><label for="tours-number">количество&nbsp;проведенных&nbsp;туров</label>
            </div>

            <div class="organizer__button">
                <button type="submit" class="btn-blue" name="person[submit-person]">
                    <span>Сохранить</span>
                </button>
            </div>

            <!--            </form>-->

        </form>

    </div>

</section>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
</div>