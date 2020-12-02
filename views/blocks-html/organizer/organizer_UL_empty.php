<!--открывающий <div class="center"> зашит в nav.php -->

<div class="container">

    <section id="organizer-profile" class="organizer__profile hide-element">

        <div id="profile-wrap" class="back-n-wrap" data-page="profile">
            <span>профиль партнера</span>
        </div>


        <div class="organizer__information">

            <div class="main__group">

                <div class="organizer__main">

                    <div class="organizer__avatar">
                        <!-- АВАТАР по умолчанию для всех пользователей 100px*100px -->
                        <img src="../../images/icons/avatar.png" alt="organizer_avatar">

                        <div class="avatar__edit fade hide-element">
                            <span class="close-pop-up"></span>
                            <form action="#" method="post">
                                <label for="partner-avatar" class="info-field__head">Аватар профиля</label>
                                <input type="file" id="partner-avatar" accept=".jpg, .jpeg, .png">
                                <button type="submit" class="btn-blue"><span>Загрузить</span></button>
                            </form>
                        </div>

                    </div>

                    <div class="organizer__registered">

                        <span class="info-field__head">на сайте</span>
                        <span class="blue">1 год и 12 месяцев</span>

                    </div>

                </div>

                <div class="organizer__contacts">

                    <div class="organizer__info-field">

                        <span class="info-field__head">Организатор</span>

                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>При необходимости изменить регистрационные данные следуйте инструкции в базе знаний:
                                    <a class="link" href="#">Личный кабинет партнера</a></p>
                            </div>
                        </div>

                        <span class="info-field__content">YourOwnAdventure</span>

                    </div>

                    <div class="organizer__info-field">

                        <span class="info-field__head">Контактное лицо</span>

                        <span class="info-field__content">Константин Константинопольский</span>

                    </div>

                    <div class="organizer__info-field">

                        <span class="info-field__head">Email</span>

                        <span class="info-field__content link">info@yowad.ru</span>

                    </div>

                    <div class="organizer__info-field">

                        <span class="info-field__head">Телефон</span>

                        <span class="info-field__content">+7-916-111-14-51</span>

                    </div>


                </div>

            </div>

            <div class="organizer__activate">

                <div>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Чтобы публиковать предложения на сайте необходимо пройти проверку СБ.</p>
                            <p>Внесите необходимую информацию и нажмите кнопку "Подтвердить профиль".</p>
                            <p>Подробности здесь: <a class="link" href="#">Личный кабинет партнера</a></p>
                        </div>
                    </div>

                    <button class="btn-grey" type="submit">
                        <span>Подтвердить профиль</span>
                    </button>

                </div>

            </div>

            <div class="organizer__personal-data">

                <h2 class="block-title">Организация</h2>

                <form action="#" method="post">

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
                        <button type="submit" class="btn-blue">
                            <span>Сохранить</span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- КОНТАКТЫ: отображение блока по умолчанию (до сохранения пользователем каких-либо данных в форме -->

            <form action="#" method="post" class="organizer__links">

                <h2 class="block-title">Контакты</h2>

                <div class="links__group">

                    <div class="organizer__info-field">

                        <label for="website" class="info-field__icon website empty-icon"></label>

                        <input id="website" type="text" class="info-field__content" placeholder="адрес сайта">

                    </div>

                    <div class="organizer__info-field">

                        <label for="facebook" class="info-field__icon facebook empty-icon"></label>

                        <input id="facebook" type="text" class="info-field__content" placeholder="страница в facebook">

                    </div>

                    <div class="organizer__info-field">

                        <label for="instagram" class="info-field__icon instagram empty-icon"></label>

                        <input id="instagram" type="text" class="info-field__content"
                               placeholder="страница в instagram">

                    </div>

                    <div class="organizer__info-field">

                        <label class="info-field__icon vkontacte empty-icon"></label>

                        <input id="vkontacte" type="text" class="info-field__content"
                               placeholder="страница в vkontacte">

                    </div>

                    <div class="organizer__info-field">

                        <label class="info-field__icon youtube empty-icon"></label>

                        <input id="youtube" type="text" class="info-field__content" placeholder="страница в youtube">

                    </div>

                </div>

                <div class="links__group">

                    <div class="organizer__info-field">

                        <label for="telegram" class="info-field__icon telegram empty-icon"></label>

                        <input id="telegram" type="text" class="info-field__content" placeholder="контакт в telegram">

                    </div>

                    <div class="organizer__info-field">

                        <label for="whatsapp" class="info-field__icon whatsapp empty-icon"></label>

                        <input id="whatsapp" type="text" class="info-field__content" placeholder="контакт в whatsapp">

                    </div>

                    <div class="organizer__info-field">

                        <label for="viber" class="info-field__icon viber empty-icon"></label>

                        <input id="viber" type="text" class="info-field__content" placeholder="контакт в viber">

                    </div>

                    <div class="organizer__info-field">

                        <label for="skype" class="info-field__icon skype empty-icon"></label>

                        <input id="skype" type="text" class="info-field__content" placeholder="контакт в skype">

                    </div>

                    <div class="organizer__info-field">

                        <label for="phone" class="info-field__icon phone empty-icon"></label>

                        <input id="phone" type="tel" class="info-field__content" placeholder="телефон для заявок">

                    </div>

                </div>

                <div class="organizer__button">
                    <button type="submit" class="btn-blue">
                        <span>Сохранить</span>
                    </button>
                </div>

            </form>

            <!-- ОБ ОРГАНИЗАТОРЕ: отображение блока по умолчанию до проверки профиля -->

            <div class="organizer__about">

                <h2 class="block-title">Об&nbsp;организаторе</h2>

                <form action="#" method="post">

                    <div class="organizer__info-field">
                        <textarea id="organizer-about" rows="6" maxlength="1000"
                                  placeholder="краткое описание вашей деятельности"></textarea>
                    </div>

                    <div class="organizer__button">
                        <button type="submit" class="btn-blue">
                            <span>Сохранить</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </section>

</div>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
</div>