<!--открывающий <div class="center"> зашит в nav.php -->

<div class="container">

    <section class="organizer__profile">

        <div class="organizer__information">

            <div class="back-n-wrap" data-page="">
                <span><a href="/organizer">назад в Меню</a></span>
                <h2>Редактировать реквизиты</h2>
            </div>

            <!-- ФОРМА ДЛЯ "ОРГАНИЗАЦИЯ" -->
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__personal-data">

                <h2 class="block-title">Организация</h2>

                    <div class="organizer__info-field">

                        <label for="partner-type" class="info-field__head">Деятельность&nbsp;<span class="red">*</span></label>
                        <!-- select-cover - обертка для стелизации тега select-->
                        <div class="select-cover">
                            <!-- не удалять в select атрибут required-->
                            <select id="partner-type" required>
                                <!--не удалять в option disabled значение атрибута value="" -->
                                <option value="" selected disabled>из списка</option>
                                <option value="tour-operator">Туроператор</option>
                                <option value="tour-agency">Турагенство</option>
                                <option value="company">Другое</option>
                            </select>
                        </div>

                    </div>

                    <div class="organizer__info-field">

                        <label for="company-type" class="info-field__head">Правовая форма&nbsp;<span
                                    class="red">*</span></label>
                        <!-- select-cover - обертка для стелизации тега select-->
                        <div class="select-cover">
                            <!-- не удалять в select атрибут required-->
                            <select id="company-type" required>
                                <!--не удалять в option disabled значение атрибута value="" -->
                                <option value="" selected disabled>из списка</option>
                                <option value="tour-operator">Самозанятый</option>
                                <option value="tour-agency">Индивидуальный предприниматель</option>
                                <option value="company">Общество с ограниченной отвественностью</option>
                                <option value="company">Другое</option>
                            </select>
                        </div>

                    </div>

                    <div class="organizer__info-field">

                        <label for="company-name" class="info-field__head">Название&nbsp;<span
                                    class="red">*</span></label>

                        <input id="company-name" type="text" placeholder="по учредительным документам">

                    </div>

                    <div class="organizer__info-field">

                        <label for="company-inn" class="info-field__head">ИНН&nbsp;<span class="red">*</span></label>

                        <input id="company-inn" type="number">

                    </div>

                    <div class="organizer__info-field">

                        <label for="company-address" class="info-field__head">Юридический&nbsp;адрес&nbsp;<span
                                    class="red">*</span></label>

                        <input id="index" aria-labelledby='company-address' type="text" maxlength="6"
                               placeholder="индекс">
                        <input id="region" aria-labelledby='company-address' type="text"
                               placeholder="регион">
                        <!-- select-cover - обертка для стелизации тега select-->
                        <div class="select-cover">
                            <!-- не удалять в select атрибут required-->
                            <select id="city" aria-labelledby='company-address' required>
                                <!--не удалять в option disabled значение атрибута value="" -->
                                <option value="" selected disabled>город</option>
                                <option value="Москва">Москва</option>
                                <option value="Самара">Самара</option>
                                <option value="Санкт-Петербург">Санкт-Петербург</option>
                                <option value="Владивосток">Владивосток</option>
                            </select>
                        </div>
                        <input id="company-address" type="text" placeholder="улица, дом, офис">

                    </div>

                    <div class="info-field__head checkbox-cover">
                        <div>Фактический&nbsp;адрес&nbsp;<span class="red">*</span></div>
                        <!-- не менять id: связан с JS (открытие\закрытие блока "Фактический адрес")-->
                        <input type="checkbox" id="fact-address">
                        <label for="fact-address" class="info-field__head"><span>совпадает с юридическим</span></label>
                    </div>

                    <div class="organizer__info-field">

                        <div id="compare">
                            <input id="index-fact" aria-labelledby='company-fact-address' type="text"
                                   maxlength="6"
                                   placeholder="индекс">
                            <input id="region-fact" aria-labelledby='company-fact-address'
                                   type="text" placeholder="регион">
                            <!-- select-cover - обертка для стелизации тега select-->
                            <div class="select-cover">
                                <!-- не удалять в select атрибут required-->
                                <select id="city-fact" aria-labelledby='company-fact-address' required>
                                    <!--не удалять в option disabled значение атрибута value="" -->
                                    <option value="" selected disabled>город</option>
                                    <option value="Москва">Москва</option>
                                    <option value="Самара">Самара</option>
                                    <option value="Санкт-Петербург">Санкт-Петербург</option>
                                    <option value="Владивосток">Владивосток</option>
                                </select>
                            </div>
                            <input id="company-fact-address" type="text" placeholder="улица, дом, офис">
                        </div>
                    </div>

                    <div class="organizer__info-field">

                        <label for="company-phone" class="info-field__head">Доп.&nbsp;телефон</label>

                        <input id="company-phone" type="number" placeholder="стационарный или мобильный">

                    </div>

                    <div class="organizer__info-field">

                        <label for="company-email" class="info-field__head">Доп.&nbsp;Email</label>

                        <input id="company-email" type="email" placeholder="для обмена документами">

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
</div>