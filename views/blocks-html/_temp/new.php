<!-- <div class="center"> -->

<section class="container new-program">

    <div class="back-n-wrap" data-page="programs">
        <a href="/programs"><span>назад в Программы</span></a>
        <div class="mobile-warning">
            <p class="red">Невозможно открыть новую программу: не&nbsp;хватает ширины экрана (минимум&nbsp;-&nbsp;630px).</p>
            <p>Чтобы продолжить работу, попробуйте перевернуть мобильное устройство в&nbsp;горизонтальное положение или
                войдите в&nbsp;кабинет партрнера с&nbsp;персонального компьютера.</p>
        </div>
    </div>

    <div class="program-form">

        <!-- <h2>Новая&nbsp;программа</h2> -->

        <div class="new-program-nav__steps">
            <!-- не изменять! JS привязан к классам .new-program-nav__step и  .current и атрибуту 'data-type'-->
            <span class="new-program-nav__step current" data-step="description">1.&nbsp;Описание</span>
            <span class="new-program-nav__step" data-step="plan-by-days">2.&nbsp;Программа&nbsp;по&nbsp;дням</span>
            <span class="new-program-nav__step" data-step="gallery">3.&nbsp;Галерея</span>
            <span class="new-program-nav__step" data-step="additional">4.&nbsp;Дополнительно</span>
        </div>


        <form action="#" method="post">


            <!-- 1.ОПИСАНИЕ  \  id завязан на JS-->
            <div id="description" class="program-form__step">

                <form action="#" method="post">

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <span>Название&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- id пока не использован-->
                            <input id="program-name" class="program-form__text" type="text"
                                   placeholder="до 100 символов">

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <span>Размер&nbsp;группы&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- id пока не использован-->
                            <input id="group-min" type="number" min="2" max="50" placeholder="от 2" required>
                            <!-- id пока не использован-->
                            <input id="group-max" type="number" min="2" max="50" placeholder="до 50 человек" required>

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <span>Возраст&nbsp;участников&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- id пока не использован-->
                            <input id="age-min" type="number" min="0" max="100" placeholder="от 0">
                            <!-- id пока не использован-->
                            <input id="age-max" type="number" min="0" max="100" placeholder="до 100 лет">

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Выбери от 1-го до 4-х значений, соответствующих теме и программе этого тура.</p>
                                    <p>Нет подходящего значения?<br>
                                        Обратись к базе знаний:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="img_tour-type">&nbsp;Типы&nbsp;туров</span></a>
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

                                    <div><input type="checkbox" id="tour-type-1" data-name="Авто-путешествие">
                                        <label for="tour-type-1"><span>Авто-путешествие</span></label></div>

                                    <div><input type="checkbox" id="tour-type-2" data-name="Активный тур">
                                        <label for="tour-type-2"><span>Активный тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-3" data-name="Арт-тур">
                                        <label for="tour-type-3"><span>Арт-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-4" data-name="Бизнес-тур">
                                        <label for="tour-type-4"><span>Бизнес-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-5" data-name="Гастрономический тур">
                                        <label for="tour-type-5"><span>Гастрономический тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-6" data-name="Горонолыжный тур">
                                        <label for="tour-type-6"><span>Горонолыжный тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-7" data-name="Дайвинг-тур">
                                        <label for="tour-type-7"><span>Дайвинг-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-8" data-name="Йога-тур">
                                        <label for="tour-type-8"><span>Йога-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-9" data-name="Квест-тур">
                                        <label for="tour-type-9"><span>Квест-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-10" data-name="Круиз">
                                        <label for="tour-type-10"><span>Круиз</span></label></div>

                                    <div><input type="checkbox" id="tour-type-11" data-name="Обзорный тур">
                                        <label for="tour-type-11"><span>Обзорный тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-12" data-name="Обучающий тур">
                                        <label for="tour-type-12"><span>Обучающий тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-13" data-name="Оздоровительный тур">
                                        <label for="tour-type-13"><span>Оздоровительный тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-14" data-name="Поход">
                                        <label for="tour-type-14"><span>Поход</span></label></div>

                                    <div><input type="checkbox" id="tour-type-15" data-name="Серф-тур">
                                        <label for="tour-type-15"><span>Серф-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-16" data-name="Сплав">
                                        <label for="tour-type-16"><span>Сплав</span></label></div>

                                    <div><input type="checkbox" id="tour-type-17" data-name="Спортивный тур">
                                        <label for="tour-type-17"><span>Спортивный тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-18" data-name="Фитнес-тур">
                                        <label for="tour-type-18"><span>Фитнес-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-19" data-name="Фото-тур">
                                        <label for="tour-type-19"><span>Фото-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-20" data-name="Эко-тур">
                                        <label for="tour-type-20"><span>Эко-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-21" data-name="Экспедиция">
                                        <label for="tour-type-21"><span>Экспедиция</span></label></div>

                                    <div><input type="checkbox" id="tour-type-22" data-name="Экстрим-тур">
                                        <label for="tour-type-22"><span>Экстрим-тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-23" data-name="Языковой тур">
                                        <label for="tour-type-23"><span>Языковой тур</span></label></div>

                                    <div><input type="checkbox" id="tour-type-24" data-name="Яхтинг">
                                        <label for="tour-type-24"><span>Яхтинг</span></label></div>

                                    <div><input type="checkbox" id="other-tour-type" data-name="Другое">
                                        <label for="other-tour-type"><span>Другое</span></label></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Общая продолжительность программы в днях:<br>
                                        минимум - <span class="blue bold">2</span>&nbsp;дня, максимум - <span
                                                class="blue bold">30</span>&nbsp;дней.</p>
                                </div>
                            </div>

                            <span>Длительность&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text">
                            <!-- id привязан к JS-->
                            <input id="duration" type="number" min="2" max="30" placeholder="от 2 до 30 дней" required>

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Если программа рассчитана на определенную аудиторию или социальную группу, отметь
                                        соответствующие значения.</p>
                                    <p>Узнай больше о системе поиска туров:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="img_search">&nbsp;Поиск по тегам</span></a>
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

                                    <div><input type="checkbox" id="target-audience-everyone" data-name="всем желающим">
                                        <label for="target-audience-everyone"><span>всем желающим</span></label></div>

                                    <div><input type="checkbox" id="target-audience-1" data-name="только женщинам">
                                        <label for="target-audience-1"><span>только женщинам</span></label></div>

                                    <div><input type="checkbox" id="target-audience-2" data-name="только мужчинам">
                                        <label for="target-audience-2"><span>только мужчинам</span></label></div>

                                    <div><input type="checkbox" id="target-audience-3" data-name="одиноким">
                                        <label for="target-audience-3"><span>одиноким</span></label></div>

                                    <div><input type="checkbox" id="target-audience-5" data-name="парам">
                                        <label for="target-audience-5"><span>парам</span></label></div>

                                    <div><input type="checkbox" id="target-audience-13" data-name="семьям">
                                        <label for="target-audience-13"><span>семьям</span></label></div>

                                    <div><input type="checkbox" id="target-audience-4" data-name="компании друзей">
                                        <label for="target-audience-4"><span>компании друзей</span></label></div>

                                    <div><input type="checkbox" id="target-audience-6" data-name="мамам с малышами">
                                        <label for="target-audience-6"><span>мамам с малышами</span></label></div>

                                    <div><input type="checkbox" id="target-audience-7" data-name="маленьким детям">
                                        <label for="target-audience-7"><span>маленьким детям</span></label></div>

                                    <div><input type="checkbox" id="target-audience-8" data-name="подросткам">
                                        <label for="target-audience-8"><span>подросткам</span></label></div>

                                    <div><input type="checkbox" id="target-audience-9" data-name="молодежи">
                                        <label for="target-audience-9"><span>молодежи</span></label></div>

                                    <div><input type="checkbox" id="target-audience-10" data-name="пенсионерам">
                                        <label for="target-audience-10"><span>пенсионерам</span></label></div>

                                    <div><input type="checkbox" id="target-audience-11"
                                                data-name="начинающим путешественникам">
                                        <label for="target-audience-11"><span>начинающим путешественникам</span></label>
                                    </div>

                                    <div><input type="checkbox" id="target-audience-12"
                                                data-name="опытным путешественникам">
                                        <label for="target-audience-12"><span>опытным путешественникам</span></label>
                                    </div>

                                    <div><input type="checkbox" id="target-audience-14" data-name="экстремалам">
                                        <label for="target-audience-14"><span>экстремалам</span></label></div>

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
                                        Обратись к базе знаний:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="program__meal">&nbsp;Питание</span>
                                    </a>
                                </div>
                            </div>

                            <span>Питание&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                            <div class="radio-cover">

                                <div>
                                    <input type="radio" id="meal-1" name="meal" value="Не включено">
                                    <label for="meal-1">не&nbsp;включено</label>
                                </div>

                                <div>
                                    <input type="radio" id="meal-2" name="meal" value="Менее 50%">
                                    <label for="meal-2"><&nbsp;50%</label>
                                </div>

                                <div>
                                    <input type="radio" id="meal-3" name="meal" value="Более 50%">
                                    <label for="meal-3">>&nbsp;50%</label>
                                </div>

                                <div>
                                    <input type="radio" id="meal-4" name="meal" value="Все включено">
                                    <label for="meal-4">все включено</label>
                                </div>

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
                                        Обратись к базе знаний:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="program__dynamics">&nbsp;Динамика</span>
                                    </a>

                                </div>
                            </div>

                            <span>Динамика&nbsp;тура&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                            <div class="radio-cover">

                                <div>
                                    <input type="radio" id="dynamic-1" name="dynamic" value="Без нагрузок">
                                    <label for="dynamic-1">без нагрузок</label>
                                </div>

                                <div>
                                    <input type="radio" id="dynamic-2" name="dynamic" value="Минимум">
                                    <label for="dynamic-2">минимум</label>
                                </div>

                                <div>
                                    <input type="radio" id="dynamic-3" name="dynamic" value="Средняя">
                                    <label for="dynamic-3">средняя</label>
                                </div>

                                <div>
                                    <input type="radio" id="dynamic-4" name="dynamic" value="Высокая">
                                    <label for="dynamic-4">высокая</label>
                                </div>

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
                                    <p>Узнай больше об уровне комфорта:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="program__comfort">&nbsp;Комфорт</span></a>

                                </div>
                            </div>

                            <span>Уровень&nbsp;комфорта&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">
                            <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                            <div class="radio-cover">

                                <div>
                                    <input type="radio" id="comfort-1" name="comfort" value="Минимум">
                                    <label for="comfort-1">минимум</label>
                                </div>

                                <div>
                                    <input type="radio" id="comfort-2" name="comfort" value="Стандарт">
                                    <label for="comfort-2">стандарт</label>
                                </div>

                                <div>
                                    <input type="radio" id="comfort-3" name="comfort" value="Повышенный">
                                    <label for="comfort-3">повышенный</label>
                                </div>

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
                            <textarea rows="3" maxlength="1000" placeholder="до 1000 символов"></textarea>
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
                                <!-- теги <select id="start-country" required>
                                 и <option value="" selected disabled>страна</option>
                                  привязаны к JS-скрипту. О любых изменениях этих тегов сообщать в front-end.-->
                                <select id="start-country" required>
                                    <option value="" selected disabled>страна</option>
                                    <option value="Армения">Армения</option>
                                    <option value="Беларуссия">Беларуссия</option>
                                    <option value="Грузия">Грузия</option>
                                    <option value="Казахстан">Казахстан</option>
                                    <option value="Польша">Польша</option>
                                    <option value="Россия">Россия</option>
                                </select>

                            </div>

                            <div class="select-cover">
                                <!-- <select id="start-city" required>
                                и <option value="" selected disabled>город</option>
                                привязаны к JS-скрипту. О любых изменениях этих тегов сообщать в front-end.-->
                                <select id="start-city" required>
                                    <option value="" selected disabled>город</option>
                                    <option value="Москва">Москва</option>
                                    <option value="Париж">Париж</option>
                                    <option value="Лондон">Лондон</option>
                                    <option value="Нью-Йорк">Нью-Йорк</option>
                                    <option value="Йоханенсбург">Йоханенсбург</option>
                                </select>

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
                                            <select id="finish-country" class="clone" required>
                                                <!-- при активном чекбоксе дублирует элементы из '#start-country option' -->
                                            </select>
                                        </div>

                                        <div class="select-cover">
                                            <select id="finish-city" class="clone" required>
                                                <!-- при активном чекбоксе дублирует элементы из '#start-city option' -->
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <input type="checkbox" id="finish"><label for="finish"></label>

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

                                    <div id="country-added" class="country-list">
                                        <!-- если #multi-country:changed, JS добавит в тег данные из geoObject.countryExtra[] -->
                                    </div>

                                    <div class="select-cover plus-sign">
                                        <select id="multi-country" class="clone" required>
                                            <!-- при активном чекбоксе дублирует элементы #start-country option -->
                                        </select>
                                    </div>

                                </div>

                                <input type="checkbox" id="multi-tour"><label for="multi-tour"></label>

                                <span id="country-count" class="text">
                                <!-- если :checked, JS добавит в тег значение переменной geoObject.countryList -->
                            </span>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <!-- 2.ПЛАН ПО ДНЯМ  \  id завязан на JS-->
            <div id="plan-by-days" class="program-form__step hide-element"> <!-- step 2 -->

                <form action="#" method="post">

                    <!-- day 1 -->
                    <div id="day-1" class="day-box opened">

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
                                            автоматическое
                                            заполнение полей с одинаковой информацией + блокировка внесения изменений.
                                            Установить и снять блокировку можно только в «1 ДЕНЬ»</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- day 1 -->

                        <div class="day-cover">

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Выбери населенный пункт из списка.</p>
                                            <p>Если ночевка планируется вне населенного пункта или если в списке нет
                                                нужного
                                                значения,
                                                выбери <span class="blue bold">"Нет&nbsp;в&nbsp;списке"</span></p>
                                        </div>
                                    </div>

                                    <span>Ночевка&nbsp;<span class="red">*</span></span>

                                </div>

                                <div class="program-form__text day group">

                                    <div class="day__text group day-place">
                                        <div class="select-cover">
                                            <select id="d1-country" class="day-country" required>
                                                <option value="" selected disabled>страна не указана</option>
                                                <!-- при клике по select создает теги option ко всем выбранным странам' -->
                                            </select>
                                        </div>
                                        <div class="select-cover">
                                            <select id="d1-city" class="clone" required>
                                                <option value="" selected disabled>город не указан</option>
                                                <option value="other">нет в списке</option>
                                                <!-- подтягивать список городов через AJAX -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="repeat-4-all unlocked">
                                        <input type="checkbox" id="d1-day-place">
                                        <label for="d1-day-place"></label>
                                    </div>

                                </div>

                            </div>  <!-- day 1 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Выбери условия проживания (тип размещения) группы в этот день.</p>
                                            <p>Нет нужного значения?<br>
                                                Обратись к базе знаний:</p>
                                            <a href="#" target="_blank" class="link">
                                                <span class="img_accommodation">&nbsp;Размещение</span></a>
                                        </div>
                                    </div>

                                    <span>Размещение&nbsp;<span class="red">*</span></span>

                                </div>

                                <div class="program-form__text day group">

                                    <div class="day__text day-accommodation">
                                        <div class="select-cover">
                                            <select id="d1-accommodation" class="text" required>
                                                <option value="" selected disabled>тип размещения</option>
                                                <option value="Нет информации">Нет информации</option>
                                                <option value="Палатка">Палатка</option>
                                                <option value="Кровать в общем номере">Кровать в общем номере</option>
                                                <option value="Кемпинг">Кемпинг</option>
                                                <option value="Апартаменты">Апартаменты</option>
                                                <option value="Отдельный номер без с\у">Отдельный номер без санузла
                                                </option>
                                                <option value="Отдельный номер с с\у">Отдельный номер с санузлом
                                                </option>
                                                <option value="Отель 3* и выше">Отель 3* и выше</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="repeat-4-all unlocked">
                                        <input type="checkbox" id="d1-day-accommodation" data-name="accommodation-lock">
                                        <label for="d1-day-accommodation"></label>
                                    </div>

                                </div>

                            </div>  <!-- day 1 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Укажи только включенное в стоимость питание.</p>
                                            <p>Не знаешь что выбрать?<br>
                                                Обратись к базе знаний:</p>
                                            <a href="#" target="_blank" class="link">
                                                <span class="program__meal">&nbsp;Питание</span></a>
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
                                            <div id="d1-meal" class="checkbox-block meal-box">

                                                <!-- 2) #no-meal, #meal-na привязан к JS-скрипту-->
                                                <div><input type="checkbox" id="d1-meal-1" data-name="Завтрак">
                                                    <label for="d1-meal-1"><span>Завтрак</span></label></div>

                                                <div><input type="checkbox" id="d1-meal-2" data-name="Обед">
                                                    <label for="d1-meal-2"><span>Обед</span></label></div>

                                                <div><input type="checkbox" id="d1-meal-3" data-name="Ужин">
                                                    <label for="d1-meal-3"><span>Ужин</span></label></div>

                                                <div><input type="checkbox" id="d1-meal-4" data-name="Перекус">
                                                    <label for="d1-meal-4"><span>Перекус</span></label></div>

                                                <div><input type="checkbox" id="d1-meal-allIn" data-name="Все включено">
                                                    <label for="d1-meal-allIn"><span>Все включено</span></label></div>

                                                <div><input type="checkbox" id="d1-no-meal" data-name="Без питания">
                                                    <label for="d1-no-meal"><span>Не включено</span></label></div>

                                                <div><input type="checkbox" id="d1-meal-na" data-name="Нет информации">
                                                    <label for="d1-meal-na"><span>Нет информации</span></label></div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="repeat-4-all unlocked">
                                        <input type="checkbox" id="d1-day-meal" data-name="meal-lock">
                                        <label for="d1-day-meal"></label>
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
                                                точки.</p>
                                            <p>Подробнее о трансферах в базе знаний:</p>
                                            <a href="#" target="_blank" class="link">
                                                <span class="img_map-and-route">&nbsp;Места&nbsp;и&nbsp;активности</span></a>
                                        </div>
                                    </div>

                                    <span>Трансфер&nbsp;</span>

                                </div>

                                <div class="program-form__text day group">

                                    <div class="day__text group day-transfer">

                                        <div class="cover-box">

                                            <div class="group fade">
                                                <div class="text default">способ перемещения группы по маршруту
                                                </div>
                                                <div class="down-arr toggle"></div>
                                                <div class="up-arr toggle hide-element"></div>
                                            </div>

                                            <div id="d1-transfer-type" class="checkbox-block transfer-box">

                                                <div><input type="checkbox" id="d1-no-transfer"
                                                            data-name="Без перемещения">
                                                    <label for="d1-no-transfer"><span>Без перемещения</span></label>
                                                </div>

                                                <div>
                                                    <input id="d1-distance" type="number" placeholder="расстояние">
                                                    <label for="d1-distance">км</label>
                                                </div>


                                                <div><input type="checkbox" id="d1-transfer-type-1"
                                                            data-name="Велосипед">
                                                    <label for="d1-transfer-type-1"><span>Велосипед</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-2"
                                                            data-name="Внедорожник">
                                                    <label for="d1-transfer-type-2"><span>Внедорожник</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-3"
                                                            data-name="Водное такси (катер, паром)">
                                                    <label for="d1-transfer-type-3"><span>Водное такси (катер, паром)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-4"
                                                            data-name="Дом на колесах">
                                                    <label for="d1-transfer-type-4"><span>Дом на колесах</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-5"
                                                            data-name="Легковой автомобиль">
                                                    <label for="d1-transfer-type-5"><span>Легковой автомобиль</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-6"
                                                            data-name="Лодка (байдарка, плот)">
                                                    <label for="d1-transfer-type-6"><span>Лодка (байдарка, плот)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-7"
                                                            data-name="Мини-вэн">
                                                    <label for="d1-transfer-type-7"><span>Мини-вэн</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-8"
                                                            data-name="Мотоцикл">
                                                    <label for="d1-transfer-type-8"><span>Мотоцикл</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-9"
                                                            data-name="Общественный транспорт">
                                                    <label for="d1-transfer-type-9"><span>Общественный транспорт</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-10"
                                                            data-name="Пеший переход">
                                                    <label for="d1-transfer-type-10"><span>Пеший переход</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-11" data-name="Поезд">
                                                    <label for="d1-transfer-type-11"><span>Поезд</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-12"
                                                            data-name="Самолет">
                                                    <label for="d1-transfer-type-12"><span>Самолет</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-13"
                                                            data-name="Корабль, круизный лайнер">
                                                    <label for="d1-transfer-type-13"><span>Корабль (круизный лайнер)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-14"
                                                            data-name="Туристический автобус">
                                                    <label for="d1-transfer-type-14"><span>Туристический автобус</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d1-transfer-type-15" data-name="Яхта">
                                                    <label for="d1-transfer-type-15"><span>Яхта</span></label></div>

                                                <div><input type="checkbox" id="d1-transfer-type-16" data-name="Другое">
                                                    <label for="d1-transfer-type-16"><span>Другое</span></label></div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="repeat-4-all unlocked">
                                        <input type="checkbox" id="d1-day-transfer" data-name="transfer-lock">
                                        <label for="d1-day-transfer"></label>
                                    </div>

                                </div>

                            </div>  <!-- day 1 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Если в этот день планируется посещение достопримечательностей или
                                                интересных
                                                мест,
                                                добавь их списком в программу дня.</p>
                                            <p>Чтобы добавить новое место в список нажми (+).</p>
                                            <!--                                        <p>Пользователи смогут просматривать список достопримечательностей отдельно от программы.</p>-->
                                            <p>Подробнее о местах в базе знаний:</p>
                                            <a href="#" target="_blank" class="link">
                                                <span class="img_map-and-route">&nbsp;Места&nbsp;и&nbsp;активности</span></a>
                                        </div>
                                    </div>

                                    <span>Место&nbsp;</span>

                                </div>

                                <div class="program-form__text dynamic-list day">
                                    <div class="day__text group">
                                        <input id="d1-point-1" type="text" maxlength="50"
                                               placeholder="до 50 символов">
                                        <span class="add-elem"></span>
                                    </div>
                                </div>

                            </div>  <!-- day 1 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Если в этот день планируются какие-либо активности: экскурсии, прогулки,
                                                спортивные мероприятия, обучение или развлечения - добавь их списком в
                                                программу дня.</p>
                                            <p>Чтобы добавить новую активность в список нажми (+).</p>
                                            <!--                                        <p>Пользователи смогут просматривать список активностей отдельно от программы.</p>-->
                                            <p>Подробнее об активностях в базе знаний:</p>
                                            <a href="#" target="_blank" class="link">
                                                <span class="img_map-and-route">&nbsp;Места&nbsp;и&nbsp;активности</span></a>
                                        </div>
                                    </div>

                                    <span>Активность&nbsp;</span>

                                </div>

                                <div class="program-form__text dynamic-list day">

                                    <div class="day__text group">
                                        <input id="d1-activity-1" type="text" maxlength="50"
                                               placeholder="до 50 символов">
                                        <span class="add-elem"></span>
                                    </div>

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

                                    <textarea id="d1-day-plan" rows="4" maxlength="1000"
                                              placeholder="до 1000 символов"></textarea>

                                    </div>

                                </div>

                            </div>  <!-- day 1 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day end">

                                    <div class="help hover">
                                        <div class="help-pop-up right fade hide-element">
                                            <span class="close-pop-up"></span>
                                            <p>Добавь одно изображение, подходящее под программу дня: фото
                                                достопримечательности или активности.</p>
                                        </div>
                                    </div>

                                    <span>Фото&nbsp;</span>

                                </div>

                                <div class="program-form__text day end">
                                    <div class="day__text group">
                                        <div class="input-btn-style">
                                            <div class="form-group">
                                                <input type="file" accept=".jpg, .jpeg, .png" id="d1-image"
                                                       name="d1-image"
                                                       class="input-file">
                                                <label for="d1-image" class="btn btn-tertiary js-labelFile">
                                                    <i class="icon"></i>
                                                    <span class="js-fileName">загрузить изображение</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>  <!-- day 1 -->

                        </div>

                    </div>

                    <!-- day 2 -->
                    <div id="day-2" class="day-box opened">

                        <div class="program-form__field start day opened">

                            <div class="day-title opened">
                                <span class="group">2&nbsp;день</span>
                            </div>

                            <div class="group day-nav">
                                <div class="day-clone"></div>
                                <div class="day-delete"></div>
                            </div>

                        </div>
                        <!-- day 2 -->

                        <div class="day-cover">

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <span>&nbsp;Ночевка&nbsp;<span class="red">*</span></span>

                                </div>

                                <div class="program-form__text day group">

                                    <div class="day__text group day-place">
                                        <div class="select-cover">
                                            <select id="d2-country" class="day-country" required>
                                                <option value="" selected disabled>страна не указана</option>
                                                <!-- привязан к JS при клике по select создает теги option ко всем выбранным странам' -->
                                            </select>
                                        </div>
                                        <div class="select-cover">
                                            <select id="d2-city" required>
                                                <option value="" selected disabled>город не указан</option>
                                                <option value="other">нет в списке</option>
                                                <!-- подтягивать список городов через AJAX -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="repeat-4-all"></div>

                                </div>

                            </div>  <!-- day 2 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <span>&nbsp;Размещение&nbsp;<span class="red">*</span></span>

                                </div>

                                <div class="program-form__text day group">

                                    <div class="day__text day-accommodation">
                                        <div class="select-cover">
                                            <select id="d2-accommodation" class="text" required>
                                                <option value="" selected disabled>тип размещения</option>
                                                <option value="Нет информации">Нет информации</option>
                                                <option value="Палатка">Палатка</option>
                                                <option value="Кровать в общем номере">Кровать в общем номере</option>
                                                <option value="Кемпинг">Кемпинг</option>
                                                <option value="Апартаменты">Апартаменты</option>
                                                <option value="Отдельный номер без с\у">Отдельный номер без с\у</option>
                                                <option value="Отдельный номер с с\у">Отдельный номер с с\у</option>
                                                <option value="Отель 3* и выше">Отель 3* и выше</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="repeat-4-all"></div>

                                </div>

                            </div>  <!-- day 2 -->

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

                                            <div id="d2-meal" class="checkbox-block meal-box">
                                                <!-- #no-meal, #meal-na привязан к JS-скрипту -->
                                                <div><input type="checkbox" id="d2-meal-1" data-name="Завтрак">
                                                    <label for="d2-meal-1"><span>Завтрак</span></label></div>

                                                <div><input type="checkbox" id="d2-meal-2" data-name="Обед">
                                                    <label for="d2-meal-2"><span>Обед</span></label></div>

                                                <div><input type="checkbox" id="d2-meal-3" data-name="Ужин">
                                                    <label for="d2-meal-3"><span>Ужин</span></label></div>

                                                <div><input type="checkbox" id="d2-meal-4" data-name="Перекус">
                                                    <label for="d2-meal-4"><span>Перекус</span></label></div>

                                                <div><input type="checkbox" id="d2-meal-allIn" data-name="Все включено">
                                                    <label for="d2-meal-allIn"><span>Все включено</span></label></div>

                                                <div><input type="checkbox" id="d2-no-meal" data-name="Без питания">
                                                    <label for="d2-no-meal"><span>Не включено</span></label></div>

                                                <div><input type="checkbox" id="d2-meal-na" data-name="Нет информации">
                                                    <label for="d2-meal-na"><span>Нет информации</span></label></div>

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

                                            <div id="d2-transfer-type" class="checkbox-block transfer-box">


                                                <div><input type="checkbox" id="d2-no-transfer"
                                                            data-name="Без перемещения">
                                                    <label for="d2-no-transfer"><span>Без перемещения</span></label>
                                                </div>

                                                <div>
                                                    <input id="d2-distance" type="number" placeholder="расстояние">
                                                    <label for="d2-distance">км</label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-1"
                                                            data-name="Велосипед">
                                                    <label for="d2-transfer-type-1"><span>Велосипед</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-2"
                                                            data-name="Внедорожник">
                                                    <label for="d2-transfer-type-2"><span>Внедорожник</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-3"
                                                            data-name="Водное такси (катер, паром)">
                                                    <label for="d2-transfer-type-3"><span>Водное такси (катер, паром)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-4"
                                                            data-name="Дом на колесах">
                                                    <label for="d2-transfer-type-4"><span>Дом на колесах</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-5"
                                                            data-name="Легковой автомобиль">
                                                    <label for="d2-transfer-type-5"><span>Легковой автомобиль</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-6"
                                                            data-name="Лодка (байдарка, плот)">
                                                    <label for="d2-transfer-type-6"><span>Лодка (байдарка, плот)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-7"
                                                            data-name="Мини-вэн">
                                                    <label for="d2-transfer-type-7"><span>Мини-вэн</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-8"
                                                            data-name="Мотоцикл">
                                                    <label for="d2-transfer-type-8"><span>Мотоцикл</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-9"
                                                            data-name="Общественный транспорт">
                                                    <label for="d2-transfer-type-9"><span>Общественный транспорт</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-10"
                                                            data-name="Пеший переход">
                                                    <label for="d2-transfer-type-10"><span>Пеший переход</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-11" data-name="Поезд">
                                                    <label for="d2-transfer-type-11"><span>Поезд</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-12"
                                                            data-name="Самолет">
                                                    <label for="d2-transfer-type-12"><span>Самолет</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-13"
                                                            data-name="Теплоход (круйизный лайнер)">
                                                    <label for="d2-transfer-type-13"><span>Корабль (круйизный лайнер)</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-14"
                                                            data-name="Туристический автобус">
                                                    <label for="d2-transfer-type-14"><span>Туристический автобус</span></label>
                                                </div>

                                                <div><input type="checkbox" id="d2-transfer-type-15" data-name="Яхта">
                                                    <label for="d2-transfer-type-15"><span>Яхта</span></label></div>

                                                <div><input type="checkbox" id="d2-transfer-type-16"
                                                            data-name="Другое">
                                                    <label for="d2-transfer-type-16"><span>Другое</span></label></div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="repeat-4-all"></div>

                                </div>

                            </div>  <!-- day 2 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <span>Место&nbsp;</span>

                                </div>

                                <div class="program-form__text dynamic-list day">
                                    <div class="day__text group">
                                        <input id="d2-point-1" type="text" maxlength="50"
                                               placeholder="до 50 символов">
                                        <span class="add-elem"></span>
                                    </div>
                                </div>

                            </div>  <!-- day 2 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <span>Активность&nbsp;</span>

                                </div>

                                <div class="program-form__text dynamic-list day">

                                    <div class="day__text group">
                                        <input id="d2-activity-1" type="text" maxlength="50"
                                               placeholder="до 50 символов">
                                        <span class="add-elem"></span>
                                    </div>

                                </div>

                            </div>  <!-- day 2 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day">

                                    <span>Программа&nbsp;дня&nbsp;</span>

                                </div>

                                <div class="program-form__text day">

                                    <div class="day__text">

                                    <textarea id="d2-day-plan" rows="4" maxlength="1000"
                                              placeholder="до 1000 символов"></textarea>

                                    </div>

                                </div>

                            </div>  <!-- day 2 -->

                            <div class="program-form__field day">

                                <div class="program-form__title day end">

                                    <span>Фото&nbsp;</span>

                                </div>

                                <div class="program-form__text day end">
                                    <div class="day__text group">
                                        <div class="input-btn-style">
                                            <div class="form-group">
                                                <input type="file" accept=".jpg, .jpeg, .png" id="d2-image"
                                                       name="d2-image"
                                                       class="input-file">
                                                <label for="d2-image" class="btn btn-tertiary js-labelFile">
                                                    <i class="icon"></i>
                                                    <span class="js-fileName">загрузить изображение</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>  <!-- day 2 -->

                        </div>

                    </div>

                    <!-- add new day -->
                    <div id="add-day" class="add-day">
                        <span><i class="icon-doc-new"></i>&nbsp;добавить&nbsp;&nbsp;день</span>
                    </div>

                </form>

            </div>

            <!-- 3.ГАЛЕРЕЯ  \  id завязан на JS-->
            <div id="gallery" class="program-form__step hide-element">

                <form action="#" method="post">

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <span>Заглавное&nbsp;фото&nbsp;<span class="red">*</span></span>

                        </div>

                        <div class="program-form__text group">

                            <div class="input-btn-style">
                                <div class="form-group">
                                    <input type="file" accept=".jpg, .jpeg, .png" id="main-image" name="main-image"
                                           class="input-file">
                                    <label for="main-image" class="btn btn-tertiary js-labelFile">
                                        <i class="icon"></i>
                                        <span class="js-fileName">загрузить изображение</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="program-form__image-result">
                        <img src="../../images/test/img-middle-template.jpg" alt="img-middle-template">
                        <!-- <img src="../../images/test/img-mini-template.jpg" alt="img-mini-template"> -->
                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">
                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Минимум&nbsp;-&nbsp;<span class="blue bolder">9</span>,
                                        максимум&nbsp;-&nbsp;<span
                                                class="blue bolder">27</span> фото альбомной ориентации.</p>
                                    <p>До публикации фото проверяет модератор.<br>
                                        Загружай фото из прошедших поездок вместо сторонних картинок и
                                        изображений, чтобы гарантированно пройти проверку.</p>


                                </div>
                            </div>
                            <span>Фото-архив&nbsp;<span class="red">*</span></span>
                        </div>

                        <div class="program-form__text group">
                            <div class="input-btn-style">
                                <div class="form-group">
                                    <input type="file" accept=".jpg, .jpeg, .png" id="gallery-img-1"
                                           name="gallery-img-1"
                                           class="input-file">
                                    <label for="gallery-img-1" class="btn btn-tertiary js-labelFile">
                                        <i class="icon"></i>
                                        <span class="js-fileName">загрузить изображение</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">
                            <span>Карта&nbsp;маршрута</span>
                        </div>

                        <div class="program-form__text">
                            <div class="input-btn-style">
                                <div class="form-group">
                                    <input type="file" accept=".jpg, .jpeg, .png" id="map-img" name="map-img"
                                           class="input-file">
                                    <label for="map-img" class="btn btn-tertiary js-labelFile">
                                        <i class="icon"></i>
                                        <span class="js-fileName">загрузить изображение</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">
                            <span>Ссылка&nbsp;на&nbsp;видео-ролик</span>
                        </div>

                        <div class="program-form__text">
                            <input type="url" id="">
                        </div>

                    </div>

                </form>

            </div>

            <!-- 4.Дополнительно  \  id завязан на JS-->
            <div id="additional" class="program-form__step hide-element">

                <form action="#" method="post">

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>отметьте теги мест</p>
                                    <p>Узнай больше о системе поиска туров:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="img_search">&nbsp;Поиск&nbsp;по тегам</span></a>
                                </div>
                            </div>

                            <span>Где&nbsp;побываем</span>

                        </div>

                        <div class="program-form__text">

                            <div id="places-tags">

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">История&nbsp;<span class="light-grey">(0)</span></div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-history' class="checkbox-block">
                                        <div><input type="checkbox" id="a-1" data-name="a-1">
                                            <label for="a-1" class="grey">Дворцы и усадьбы</label></div>

                                        <div><input type="checkbox" id="a-2" data-name="a-2">
                                            <label for="a-2">Древние города и руины</label></div>

                                        <div><input type="checkbox" id="a-3" data-name="a-3">
                                            <label for="a-3">Замки и крепости</label></div>

                                        <div><input type="checkbox" id="a-4" data-name="a-4">
                                            <label for="a-4">Исторические центры</label></div>

                                        <div><input type="checkbox" id="a-5" data-name="a-5">
                                            <label for="a-5">Музеи</label></div>

                                        <div><input type="checkbox" id="a-6" data-name="a-6">
                                            <label for="a-6">Памятники и монументы</label></div>
                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Культура и быт&nbsp;<span
                                                    class="light-grey">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-culture' class="checkbox-block">
                                        <div><input type="checkbox" id="b-1" data-name="b-1">
                                            <label for="b-1" class="grey">Архитектура</label></div>

                                        <div><input type="checkbox" id="b-2" data-name="b-2">
                                            <label for="b-2">Винодельни</label></div>

                                        <div><input type="checkbox" id="b-3" data-name="b-3">
                                            <label for="b-3">Выставки и галереи</label></div>

                                        <div><input type="checkbox" id="b-4" data-name="b-4">
                                            <label for="b-4">Заводы</label></div>

                                        <div><input type="checkbox" id="b-5" data-name="b-5">
                                            <label for="b-5">Корпорации</label></div>

                                        <div><input type="checkbox" id="b-6" data-name="b-6">
                                            <label for="b-6">Маяки</label></div>

                                        <div><input type="checkbox" id="b-12" data-name="b-12">
                                            <label for="b-12">Мельницы</label></div>

                                        <div><input type="checkbox" id="b-7" data-name="b-7">
                                            <label for="b-7">Плантации и фабрики</label></div>

                                        <div><input type="checkbox" id="b-8" data-name="b-8">
                                            <label for="b-8">Плотины и каналы</label></div>

                                        <div><input type="checkbox" id="b-9" data-name="b-9">
                                            <label for="b-9">Университеты</label></div>

                                        <div><input type="checkbox" id="b-10" data-name="b-10">
                                            <label for="b-10">Фермы и деревни</label></div>

                                        <div><input type="checkbox" id="b-11" data-name="b-11">
                                            <label for="b-11">Этнические резервации</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Необычные места&nbsp;<span
                                                    class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-unusual' class="checkbox-block">
                                        <div><input type="checkbox" id="c-1" data-name="c-1">
                                            <label for="c-1" class="grey">Аномальные точки</label></div>

                                        <div><input type="checkbox" id="c-2" data-name="c-2">
                                            <label for="c-2">Города и дома призраки</label></div>

                                        <div><input type="checkbox" id="c-3" data-name="c-3">
                                            <label for="c-3">Космодром</label></div>

                                        <div><input type="checkbox" id="c-4" data-name="c-4">
                                            <label for="c-4">Места силы</label></div>

                                        <div><input type="checkbox" id="c-5" data-name="c-5">
                                            <label for="c-5">Места съемки кино</label></div>

                                        <div><input type="checkbox" id="c-6" data-name="c-6">
                                            <label for="c-6">Обсерваторий</label></div>

                                        <div><input type="checkbox" id="c-7" data-name="c-7">
                                            <label for="c-7">Объекты ЮНЕСКО</label></div>

                                        <div><input type="checkbox" id="c-8" data-name="c-8">
                                            <label for="c-8">Уникальная природа</label></div>

                                        <div><input type="checkbox" id="c-9" data-name="c-9">
                                            <label for="c-9">Шаманы и колдуны</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Природа&nbsp;<span class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-nature' class="checkbox-block">
                                        <div><input type="checkbox" id="d-1" data-name="d-1">
                                            <label for="d-1" class="grey">Водопады</label></div>

                                        <div><input type="checkbox" id="d-2" data-name="d-2">
                                            <label for="d-2">Вулканы</label></div>

                                        <div><input type="checkbox" id="d-3" data-name="d-3">
                                            <label for="d-3">Геотермальные зоны</label></div>

                                        <div><input type="checkbox" id="d-4" data-name="d-4">
                                            <label for="d-4">Горы</label></div>

                                        <div><input type="checkbox" id="d-5" data-name="d-5">
                                            <label for="d-5">Гроты и пещеры</label></div>

                                        <div><input type="checkbox" id="d-6" data-name="d-6">
                                            <label for="d-6">Заповедники и заказники</label></div>

                                        <div><input type="checkbox" id="d-7" data-name="d-7">
                                            <label for="d-7">Каньоны</label></div>

                                        <div><input type="checkbox" id="d-8" data-name="d-8">
                                            <label for="d-8">Коралловые рифы</label></div>

                                        <div><input type="checkbox" id="d-9" data-name="d-9">
                                            <label for="d-9">Ледники</label></div>

                                        <div><input type="checkbox" id="d-10" data-name="d-10">
                                            <label for="d-10">Национальные парки</label></div>

                                        <div><input type="checkbox" id="d-11" data-name="d-11">
                                            <label for="d-11">Острова</label></div>

                                        <div><input type="checkbox" id="d-12" data-name="d-12">
                                            <label for="d-12">Парки звездного неба</label></div>

                                        <div><input type="checkbox" id="d-13" data-name="d-13">
                                            <label for="d-13">Побережье (море, океан)</label></div>

                                        <div><input type="checkbox" id="d-14" data-name="d-14">
                                            <label for="d-14">Пустыни</label></div>

                                        <div><input type="checkbox" id="d-15" data-name="d-15">
                                            <label for="d-15">(?)Равнины и холмы</label></div>

                                        <div><input type="checkbox" id="d-16" data-name="d-16">
                                            <label for="d-16">Реки и озера</label></div>

                                        <div><input type="checkbox" id="d-17" data-name="d-17">
                                            <label for="d-17">Саванна</label></div>

                                        <div><input type="checkbox" id="d-18" data-name="d-18">
                                            <label for="d-18">Скалы и холмы</label></div>

                                        <div><input type="checkbox" id="d-19" data-name="d-19">
                                            <label for="d-19">Тайга</label></div>

                                        <div><input type="checkbox" id="d-20" data-name="d-20">
                                            <label for="d-20">Тропические леса</label></div>

                                        <div><input type="checkbox" id="d-21" data-name="d-21">
                                            <label for="d-21">Фьорды</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Развлечения&nbsp;<span class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-fun' class="checkbox-block">
                                        <div><input type="checkbox" id="e-1" data-name="e-1">
                                            <label for="e-1" class="grey">Бары и клубы</label></div>

                                        <div><input type="checkbox" id="e-2" data-name="e-2">
                                            <label for="e-2">Горнолыжные склоны</label></div>

                                        <div><input type="checkbox" id="e-3" data-name="e-3">
                                            <label for="e-3">Зоопарки и океанариумы</label></div>

                                        <div><input type="checkbox" id="e-13" data-name="e-13">
                                            <label for="e-13">Казино</label></div>

                                        <div><input type="checkbox" id="e-4" data-name="e-4">
                                            <label for="e-4">Концерты и представления</label></div>

                                        <div><input type="checkbox" id="e-5" data-name="e-5">
                                            <label for="e-5">Парки развлечений и аквапарки</label></div>

                                        <div><input type="checkbox" id="e-6" data-name="e-6">
                                            <label for="e-6">Пляжи</label></div>

                                        <div><input type="checkbox" id="e-7" data-name="e-7">
                                            <label for="e-7">Рынки и базары</label></div>

                                        <div><input type="checkbox" id="e-8" data-name="e-8">
                                            <label for="e-8">Рэки</label></div>

                                        <div><input type="checkbox" id="e-9" data-name="e-9">
                                            <label for="e-9">Серф-споты</label></div>

                                        <div><input type="checkbox" id="e-14" data-name="e-14">
                                            <label for="e-14">События и фестивали</label></div>

                                        <div><input type="checkbox" id="e-10" data-name="e-10">
                                            <label for="e-10">Тематические парки</label></div>

                                        <div><input type="checkbox" id="e-11" data-name="e-11">
                                            <label for="e-11">Термальные источники</label></div>

                                        <div><input type="checkbox" id="e-12" data-name="e-12">
                                            <label for="e-12">Торговые центры</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Религия&nbsp;<span class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='places-religion' class="checkbox-block">
                                        <div><input type="checkbox" id="f-1" data-name="f-1">
                                            <label for="f-1" class="grey">Ашрамы</label></div>

                                        <div><input type="checkbox" id="f-2" data-name="f-2">
                                            <label for="f-2">Места паломничества</label></div>

                                        <div><input type="checkbox" id="f-3" data-name="f-3">
                                            <label for="f-3">Монастыри и храмы</label></div>

                                        <div><input type="checkbox" id="f-4" data-name="f-4">
                                            <label for="f-4">Священные артефакты</label></div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">

                            <div class="help hover">
                                <div class="help-pop-up right fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>отметьте теги активностей</p>
                                    <p>Узнай больше о системе поиска туров:</p>
                                    <a href="#" target="_blank" class="link">
                                        <span class="img_search">&nbsp;Поиск&nbsp;по тегам</span></a>
                                </div>
                            </div>

                            <span>Чем&nbsp;займемся</span>

                        </div>

                        <div class="program-form__text">

                            <div id="activities-tags">

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Адреналин&nbsp;<span class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-adrenalin' class="checkbox-block">
                                        <div><input type="checkbox" id="g-1" data-name="g-1">
                                            <label for="g-1" class="grey">Восхождения</label></div>

                                        <div><input type="checkbox" id="g-2" data-name="g-2">
                                            <label for="g-2">Джет-боты</label></div>

                                        <div><input type="checkbox" id="g-3" data-name="g-3">
                                            <label for="g-3">Зиплайнинг</label></div>

                                        <div><input type="checkbox" id="g-4" data-name="g-4">
                                            <label for="g-4">Квадроциклы</label></div>

                                        <div><input type="checkbox" id="g-5" data-name="g-5">
                                            <label for="g-5">Парапланы</label></div>

                                        <div><input type="checkbox" id="g-6" data-name="g-6">
                                            <label for="g-6">Роуп-джампинг</label></div>

                                        <div><input type="checkbox" id="g-7" data-name="g-7">
                                            <label for="g-7">Снегоходы</label></div>

                                        <div><input type="checkbox" id="g-8" data-name="g-8">
                                            <label for="g-8">Сплавы</label></div>

                                        <div><input type="checkbox" id="g-9" data-name="g-9">
                                            <label for="g-9">Сэнд-бординг</label></div>

                                        <div><input type="checkbox" id="g-10" data-name="g-10">
                                            <label for="g-10">Тарзанка</label></div>

                                        <div><input type="checkbox" id="g-11" data-name="g-11">
                                            <label for="g-11">Фрирайд</label></div>
                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Впечатления&nbsp;<span class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-impressions' class="checkbox-block">
                                        <div><input type="checkbox" id="h-1" data-name="h-1">
                                            <label for="h-1" class="grey">Вертолетные прогулки</label></div>

                                        <div><input type="checkbox" id="h-2" data-name="h-2">
                                            <label for="h-2">Водные прогулки</label></div>

                                        <div><input type="checkbox" id="h-3" data-name="h-3">
                                            <label for="h-3">Воздухоплавание</label></div>

                                        <div><input type="checkbox" id="h-4" data-name="h-4">
                                            <label for="h-4">Дегустации</label></div>

                                        <div><input type="checkbox" id="h-5" data-name="h-5">
                                            <label for="h-5">ЖД-путешествия</label></div>

                                        <div><input type="checkbox" id="h-6" data-name="h-6">
                                            <label for="h-6">Катание на животных</label></div>

                                        <div><input type="checkbox" id="h-7" data-name="h-7">
                                            <label for="h-7">Наблюдение за животными</label></div>

                                        <div><input type="checkbox" id="h-8" data-name="h-8">
                                            <label for="h-8">Национальные кухни</label></div>

                                        <div><input type="checkbox" id="h-9" data-name="h-9">
                                            <label for="h-9">Ночи под открытым небом</label></div>

                                        <div><input type="checkbox" id="h-10" data-name="h-10">
                                            <label for="h-10">Рассветы и закаты</label></div>

                                        <div><input type="checkbox" id="h-11" data-name="h-11">
                                            <label for="h-11">Редкие природные явления</label></div>

                                        <div><input type="checkbox" id="h-12" data-name="h-12">
                                            <label for="h-12">Самолетные прогулки</label></div>

                                        <div><input type="checkbox" id="h-13" data-name="h-13">
                                            <label for="h-13">Сафари</label></div>

                                        <div><input type="checkbox" id="h-14" data-name="h-14">
                                            <label for="h-14">(?)События и праздники</label></div>

                                        <div><input type="checkbox" id="h-15" data-name="h-15">
                                            <label for="h-15">Созерцание природы</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Дух&nbsp;и&nbsp;тело&nbsp;<span
                                                    class="light-grey"">(0)</span></div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-body-soul' class="checkbox-block">
                                        <div><input type="checkbox" id="i-1" data-name="i-1">
                                            <label for="i-1" class="grey">Альтернативаня медицина</label></div>

                                        <div><input type="checkbox" id="i-2" data-name="i-2">
                                            <label for="i-2">Духовные практики</label></div>

                                        <div><input type="checkbox" id="i-3" data-name="i-3">
                                            <label for="i-3">Йога</label></div>

                                        <div><input type="checkbox" id="i-4" data-name="i-4">
                                            <label for="i-4">Пешие прогулки</label></div>

                                        <div><input type="checkbox" id="i-5" data-name="i-5">
                                            <label for="i-5">Медитации</label></div>

                                        <div><input type="checkbox" id="i-6" data-name="i-6">
                                            <label for="i-6">Оздоровительные процедуры</label></div>

                                        <div><input type="checkbox" id="i-7" data-name="i-7">
                                            <label for="i-7">Пляжный отдых</label></div>

                                        <div><input type="checkbox" id="i-8" data-name="i-8">
                                            <label for="i-8">Ретрит</label></div>

                                        <div><input type="checkbox" id="i-9" data-name="i-9">
                                            <label for="i-9">СПА</label></div>

                                        <div><input type="checkbox" id="i-10" data-name="i-10">
                                            <label for="i-10">Фитнес</label></div>

                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Знания&nbsp;<span class="light-grey"">(0)</span></div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-knowledge' class="checkbox-block">
                                        <div><input type="checkbox" id="j-1" data-name="j-1">
                                            <label for="j-1" class="grey">Бизнес-семинары</label></div>

                                        <div><input type="checkbox" id="j-2" data-name="j-2">
                                            <label for="j-2">Курс фотографии</label></div>

                                        <div><input type="checkbox" id="j-8" data-name="j-8">
                                            <label for="j-8">Мастер-классы</label></div>

                                        <div><input type="checkbox" id="j-3" data-name="j-3">
                                            <label for="j-3">Обучение дайвингу</label></div>

                                        <div><input type="checkbox" id="j-4" data-name="j-4">
                                            <label for="j-4">Познавательные экскурсии</label></div>

                                        <div><input type="checkbox" id="j-5" data-name="j-5">
                                            <label for="j-5">Практика английского</label></div>

                                        <div><input type="checkbox" id="j-6" data-name="j-6">
                                            <label for="j-6">Практика испанского</label></div>

                                        <div><input type="checkbox" id="j-7" data-name="j-7">
                                            <label for="j-7">Уроки выживания</label></div>
                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">
                                        <div class="text default">Спорт&nbsp;<span class="light-grey"">(0)</span></div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-sport' class="checkbox-block">
                                        <div><input type="checkbox" id="k-1" data-name="k-1">
                                            <label for="k-1" class="grey">Альпинизм</label></div>

                                        <div><input type="checkbox" id="k-2" data-name="k-2">
                                            <label for="k-2">Бег</label></div>

                                        <div><input type="checkbox" id="k-3" data-name="k-3">
                                            <label for="k-3">Вейкбординг / Вейксерфинг</label></div>

                                        <div><input type="checkbox" id="k-4" data-name="k-4">
                                            <label for="k-4">Велосипед</label></div>

                                        <div><input type="checkbox" id="k-5" data-name="k-5">
                                            <label for="k-5">Виндсерфинг</label></div>

                                        <div><input type="checkbox" id="k-6" data-name="k-6">
                                            <label for="k-6">Гольф</label></div>

                                        <div><input type="checkbox" id="k-7" data-name="k-7">
                                            <label for="k-7">Кайтбординг / Кайтсерфинг</label></div>

                                        <div><input type="checkbox" id="k-8" data-name="k-8">
                                            <label for="k-8">Лыжи и сноуборд</label></div>

                                        <div><input type="checkbox" id="k-9" data-name="k-9">
                                            <label for="k-9">Плавание</label></div>

                                        <div><input type="checkbox" id="k-10" data-name="k-10">
                                            <label for="k-10">Серфинг</label></div>

                                        <div><input type="checkbox" id="k-11" data-name="k-11">
                                            <label for="k-11">Скалолазание</label></div>

                                        <div><input type="checkbox" id="k-12" data-name="k-12">
                                            <label for="k-12">Яхтинг</label></div>
                                    </div>

                                </div>

                                <div class="cover-box">

                                    <div class="group fade">

                                        <div class="text default">Увлечения&nbsp;и&nbsp;хобби&nbsp;<span
                                                    class="light-grey"">(0)</span>
                                        </div>
                                        <div class="down-arr toggle"></div>
                                        <div class="up-arr toggle hide-element"></div>
                                    </div>

                                    <div id='activities-hobby' class="checkbox-block">
                                        <div><input type="checkbox" id="l-1" data-name="l-1">
                                            <label for="l-1" class="grey">Археология</label></div>

                                        <div><input type="checkbox" id="l-2" data-name="l-2">
                                            <label for="l-2">Астрономия</label></div>

                                        <div><input type="checkbox" id="l-3" data-name="l-3">
                                            <label for="l-3">Дайвинг</label></div>

                                        <div><input type="checkbox" id="l-4" data-name="l-4">
                                            <label for="l-4">Искусство</label></div>

                                        <div><input type="checkbox" id="l-5" data-name="l-5">
                                            <label for="l-5">(?)История</label></div>

                                        <div><input type="checkbox" id="l-6" data-name="l-6">
                                            <label for="l-6">Каньонинг</label></div>

                                        <div><input type="checkbox" id="l-7" data-name="l-7">
                                            <label for="l-7">Квесты и головоломки</label></div>

                                        <div><input type="checkbox" id="l-8" data-name="l-8">
                                            <label for="l-8">Настольные игры</label></div>

                                        <div><input type="checkbox" id="l-9" data-name="l-9">
                                            <label for="l-9">Ночная жизнь</label></div>

                                        <div><input type="checkbox" id="l-10" data-name="l-10">
                                            <label for="l-10">Охота</label></div>

                                        <div><input type="checkbox" id="l-11" data-name="l-11">
                                            <label for="l-11">Рисование</label></div>

                                        <div><input type="checkbox" id="l-12" data-name="l-12">
                                            <label for="l-12">Рыбалка</label></div>

                                        <div><input type="checkbox" id="l-13" data-name="l-13">
                                            <label for="l-13">Сап-бординг</label></div>

                                        <div><input type="checkbox" id="l-14" data-name="l-14">
                                            <label for="l-14">Снорклинг</label></div>

                                        <div><input type="checkbox" id="l-15" data-name="l-15">
                                            <label for="l-15">Спелеология</label></div>

                                        <div><input type="checkbox" id="l-16" data-name="l-16">
                                            <label for="l-16">Танцы</label></div>

                                        <div><input type="checkbox" id="l-17" data-name="l-17">
                                            <label for="l-17">Трекинг</label></div>

                                        <div><input type="checkbox" id="l-18" data-name="l-18">
                                            <label for="l-18">Хайкинг</label></div>

                                        <div><input type="checkbox" id="l-19" data-name="l-19">
                                            <label for="l-19">Шоппинг</label></div>

                                        <div><input type="checkbox" id="l-20" data-name="l-20">
                                            <label for="l-20">Эзотерика</label></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Виза для граждан РФ</div>

                        <div class="program-form__text">
                            <textarea rows="1" placeholder="да\нет , срок изготвления"></textarea>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Безопасность</div>

                        <div class="program-form__text">
                        <textarea rows="3"
                                  placeholder="уровень безопасности региона по данным Ростуризма"></textarea>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Здоровье</div>

                        <div class="program-form__text">
                        <textarea rows="1"
                                  placeholder="медицинские рекомендации \ обязательные прививки \ обяз. набор медикаментов и проч."></textarea>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Важная информация</div>

                        <div class="program-form__text">
                        <textarea rows="1"
                                  placeholder="логистика участников до места старта программы (???) \правила и ограничения тура \ особенности посещаемого региона: законы, правила, традиции \ условия въезда в страну: ограничения ввоза \ тип розеток и т.п."></textarea>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Что взять с собой</div>

                        <div class="program-form__text">
                        <textarea rows="3"
                                  placeholder="дополнительная информация: что взять из одежды и личных вещей"></textarea>
                        </div>

                    </div>

                    <div class="program-form__field">

                        <div class="program-form__title">Дополнительно</div>

                        <div class="program-form__text">
                        <textarea rows="3"
                                  placeholder="поле для организатора: свободное воле"></textarea>
                        </div>

                    </div>

                </form>

            </div>


            <!-- ДНО СТРАНИЦЫ ФОРМЫ: КНОПКИ СОХРАНЕНИЯ -->
            <div class="new-program__bottom">

                <!--<div class="btn-grey"> <span>Назад</span> </div>-->

                <button id='complete-submit' class="btn-orange hide-element">
                    <span>Завершить</span>
                </button>

                <button id="next-page" class="btn-blue">
                    <span>Далее</span>
                </button>

                <button id='save-exit' class="btn-grey">
                    <span>Сохранить</span>
                </button>

                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Прервать заполнение, сохранить изменения и выйти</p>
                    </div>
                </div>

            </div>

        </form>

    </div>

</section>
<!-- закрывающий тег к <div class="center"> (начало в nav.php) -->
</div>