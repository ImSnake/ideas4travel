<!-- <div class="center"> -->

<section id="organizer-profile" class="container organizer__profile hide-element">

    <div id="profile-wrap" class="back-n-wrap" data-page="profile">
        <span>профль организатора</span>
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
                    <span class="blue">1 день</span>

                </div>

            </div>

            <div class="organizer__contacts">

                <div class="organizer__info-field">

                    <span class="info-field__head">Организатор</span>

                    <div class="help hover">
                        <div class="help-pop-up right fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>При необходимости изменить регистрационные данные следуйте инструкции в базе знаний:
                                <a class="link" href="#">Профиль организатора</a></p>
                        </div>
                    </div>

                    <span class="info-field__content">Приключения с Артуром Ивановым</span>

                </div>

                <div class="organizer__info-field">

                    <span class="info-field__head">Контактное лицо</span>

                    <span class="info-field__content">Артур Иванов</span>

                </div>

                <div class="organizer__info-field">

                    <span class="info-field__head">Email</span>

                    <span class="info-field__content link">aivanov@gmail.com</span>

                </div>

                <div class="organizer__info-field">

                    <span class="info-field__head">Телефон</span>

                    <span class="info-field__content">+7-903-963-25-75</span>

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
                        <p>Подробности здесь: <a class="link" href="#">Проверка профиля организатора</a></p>
                    </div>
                </div>

                <button class="btn-grey" type="submit">
                    <span>Подтвердить профиль</span>
                </button>

            </div>

        </div>

        <!-- ИНФОРМАЦИЯ_ЧАСТНЫЙ ГИД: отображение блока по умолчанию (до сохранения пользователем каких-либо данных в форме -->

        <div class="organizer__personal-data">

            <h2 class="block-title">ЧАСТНЫЙ ГИД</h2>

            <form action="#" method="post">

                <div class="organizer__info-field">

                    <div class="radio-btn-cover">

                        <span class="info-field__head">Пол&nbsp;<span class="red">*</span></span>
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

                    <label for="person-registration" class="info-field__head">Регистрация&nbsp;<span
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
                    <div>Адрес&nbsp;проживания&nbsp;<span class="red">*</span></div>
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
                        <input id="region-fac aria-labelledby='person-fact-address' type=" text" placeholder="регион">
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

                <div class="organizer__info-field">

                    <label for="person-experience" class="info-field__head">Опыт&nbsp;и&nbsp;экспертиза&nbsp;<span
                                class="red">*</span></label>

                    <input id="person-experience" type="number" min="0" max="50"
                           placeholder="стаж в туризме, лет">
                    <input id="tour-experience" aria-labelledby="person-experience" type="number" min="0" max="50"
                           placeholder="опыт в организации туров, лет">
                    <input id="tours-number" aria-labelledby="person-experience" type="number" min="0" max="500"
                           placeholder="кол-во проведенных туров">
                </div>

                <div class="organizer__button">
                    <button type="submit" class="btn-blue">
                        <span>Сохранить</span>
                    </button>
                </div>

            </form>

        </div>

        <!-- КОНТАКТЫ: отображение блока по умолчанию (до сохранения пользователем каких-либо данных в форме -->

        <div class="organizer__links">

            <h2 class="block-title">Контакты</h2>

            <form action="#" method="post">

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

        </div>

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

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
</div>