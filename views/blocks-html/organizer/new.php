<!-- <div class="center"> -->

<section class="container">

    <div class="back-n-wrap" data-page="programs">
        <span><a href="organizer-programs.php">назад в программы</a></span>
        <div class="mobile-warning">
            <p class="red">Невозможно создать новую программу: не хватает ширины экрана (минимум - 630px)</p>
            <p>Чтобы продолжить работу, попробуйте перевернуть мобильное устройство в горизонтальное положение или
                войдите в кабинет партрнера с персонального компьютера</p>
        </div>
    </div>

    <div class="program-form">

        <!-- <h2>Новая&nbsp;программа</h2> -->

        <div class="new-program-nav__steps">
            <!-- не изменять! JS привязан к классам .new-program-nav__step и  .current и атрибуту 'data-type'-->
            <span class="new-program-nav__step current" data-step="description">1.&nbsp;Описание</span>
            <span class="new-program-nav__step" data-step="plan-by-days">2.&nbsp;План&nbsp;по&nbsp;дням</span>
            <span class="new-program-nav__step" data-step="gallery">3.&nbsp;Галерея</span>
            <span class="new-program-nav__step" data-step="additional">4.&nbsp;Дополнительно</span>
        </div>


        <form action="#" method="post">

            <!-- id завязан на JS-->
            <div id="description" class="program-form__step">

                <div class="program-form__field">

                    <div class="program-form__title">

                        <span>Название&nbsp;<span class="red">*</span></span>

                    </div>

                    <div class="program-form__text group">
                        <!-- id пока не использован-->
                        <input id="program-name" class="program-form__text" type="text"
                               placeholder="не более 100 символов">

                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">

                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>Выберите от 1-го до 3-x значений, подходящих под тематику этого тура.</p>
                                <p>Не знаете что выбрать или не нашли нужного значения?</p>
                                <p>Прочтите статью по теме в базе знаний:</p>
                                <a href="#" target="_blank" class="link">
                                    <img src="../../images/icons/icon-tour-type-16.svg" alt="icon-tour-type">&nbsp;Типы
                                    туров</a>
                            </div>
                        </div>

                        <span>Тип&nbsp;тура&nbsp;<span class="red">*</span></span>

                    </div>

                    <div class="program-form__text">

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default">выберите до 3-х значений</div>
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

                                <div><input type="checkbox" id="tour-type-14" data-name="Серф-тур">
                                    <label for="tour-type-14"><span>Серф-тур</span></label></div>

                                <div><input type="checkbox" id="tour-type-15" data-name="Сплав">
                                    <label for="tour-type-15"><span>Сплав</span></label></div>

                                <div><input type="checkbox" id="tour-type-16" data-name="Спортивный тур">
                                    <label for="tour-type-16"><span>Спортивный тур</span></label></div>

                                <div><input type="checkbox" id="tour-type-17" data-name="Турпоход">
                                    <label for="tour-type-17"><span>Турпоход</span></label></div>

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
                                <p>Общая продолжительность программы в днях.</p>
                                <p>Минимум: <span class="red">2 дня</span></p>
                                <p>Максимум: <span class="green">30 дней</span></p>
                            </div>
                        </div>

                        <span>Длительность&nbsp;<span class="red">*</span></span>

                    </div>

                    <div class="program-form__text">
                        <!-- id пока не использован-->
                        <input id="duration" type="number" min="2" max="30" placeholder="от 2 до 30 дней" required>

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
                                <p>Не уверены в выборе?</p>
                                <p>Прочтите статью по теме в базе заний:</p>
                                <a href="#" target="_blank" class="link">
                                    <img src="../../images/icons/icon-comfort-16.svg" alt="icon-comfort">&nbsp;Комфорт
                                </a>
                            </div>
                        </div>

                        <span>Уровень&nbsp;комфорта&nbsp;<span class="red">*</span></span>

                    </div>

                    <div class="program-form__text group">
                        <!-- не удалять атрибуты name у радио-кнопок, т.к. на них завязано переключение-->
                        <div class="radio-cover">

                            <div>
                                <input type="radio" id="comfort-1" name="comfort" value="Базовый">
                                <label for="comfort-1">Базовый</label>
                            </div>

                            <div>
                                <input type="radio" id="comfort-2" name="comfort" value="Стандартный">
                                <label for="comfort-2">Стандартный</label>
                            </div>

                            <div>
                                <input type="radio" id="comfort-3" name="comfort" value="Повышенный">
                                <label for="comfort-3">Повышенный</label>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">

                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>Не уверены в выборе?</p>
                                <p>Прочтите статью по теме в базе заний:</p>
                                <a href="#" target="_blank" class="link">
                                    <img src="../../images/icons/icon-dynamics-16.svg" alt="icon-dynamics">&nbsp;Динамика
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
                                <label for="dynamic-1">Без нагрузок</label>
                            </div>

                            <div>
                                <input type="radio" id="dynamic-2" name="dynamic" value="Физические нагрузки">
                                <label for="dynamic-2">Физические нагрузки</label>
                            </div>

                            <div>
                                <input type="radio" id="dynamic-3" name="dynamic" value="Специальная подготовка">
                                <label for="dynamic-3">Специальная подготовка</label>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">

                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>Укажите страну и город начала программы (место сбора участников)</p>
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
                                <p>Если программа заканчивается в другом месте, поставьте галочку и укажите место
                                    окончания.</p>
                            </div>
                        </div>

                        <span>Финиш&nbsp;в&nbsp;другом&nbsp;месте</span>

                    </div>

                    <div class="program-form__text">

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
                                <p>Отметьте, если в рамках тура запланировано посещение нескольких стран и добавьте их в
                                    программу</p>
                            </div>
                        </div>

                        <span>Мульти-тур</span>

                    </div>

                    <div class="program-form__text">

                        <div class="checkbox-cover">

                            <div class="fade hide-element">

                                <div id="country-added" class="country-list">
                                    <!-- если #multi-country:changed, JS добавит в тег данные из geoObject.countryExtra[] -->
                                </div>

                                <div class="select-cover">
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

            </div>

            <!-- id завязан на JS-->
            <div id="plan-by-days" class="program-form__step hide-element"> <!-- step 2 -->

                <!-- day 1 -->

                <div id="d1" class="day-box">

                    <div class="program-form__field start day">

                        <!--<div class="help hover">
                            <i class="icon-help-circled-1"></i>
                            <div class="help-pop-up right fade hide-element">
                                <i class="icofont-close-circled"></i>
                                <p>1-й день содержит подсказки по заполнению формы.</p>
                                <p>Звездочкой (<span class="red">*</span>) отмечены обязательные для заполнения
                                    поля.</p>
                                <p>Остальное - по желанию.</p>
                            </div>
                        </div>-->

                        <div class="group">
                            <span class="day-title">1&nbsp;&nbsp;день&nbsp;&nbsp;</span>
                            <span class="symbol toggle">&#9660;</span>
                            <span class="symbol toggle hide-element">&#9650;</span>
                        </div>

                        <div class="group">
                            <i class="icon-folder-open-empty toggle hide-element"></i>
                            <i class="icon-folder-empty toggle"></i>
                            <i class="icon-docs"></i>
                            <i class="icon-trash-empty"></i>
                        </div>


                    </div>
                    <!-- day 1 -->

                    <div class="day-cover hide-element">

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Укажите основное место пребывания группы в этот день.</p>
                                        <p>Необходимо выбрать населенный пункт из списка.</p>
                                        <p>Если в списке нет нужного значения, выберите "Другое".</p>
                                    </div>
                                </div>

                                <span>&nbsp;Место:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group">
                                    <div class="select-cover">
                                        <select id="d1-country" data-name="d1-country" class="clone" required>
                                            <option value="" selected disabled>страна</option>
                                            <!-- при клике по select дублирует элементы из '#start-city option' -->
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <select id="d1-place" data-name="d1-place" class="clone" required>
                                            <option value="" selected disabled>город</option>
                                            <!-- при клике по select дублирует элементы из '#start-city option' -->
                                        </select>
                                    </div>
                                </div>

                                <div class="repeat-4-all">

                                    <input type="checkbox" id="no-1" data-name="place-lock">
                                    <label for="no-1">
                                        <i class="icon-lock-1 blue"></i>
                                        <i class="icon-lock-open-1 grey hide-element"></i>
                                    </label>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Не уверены в выборе?</p>
                                        <p>Прочтите статью по теме в базе заний:</p>
                                        <a href="#" target="_blank" class="link">
                                            <img src="../../images/icons/icon-accommodation-16.svg"
                                                 alt="icon-accommodation">&nbsp;Проживание</a>
                                    </div>
                                </div>

                                <span>&nbsp;Проживание:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text">
                                    <div class="select-cover">
                                        <select id="d1-accommodation" data-name="d1-accommodation" required>
                                            <option value="" selected disabled>тип размещения</option>
                                            <option value="Нет информации">Нет информации</option>
                                            <option value="Палатка">Палатка</option>
                                            <option value="Кровать в общем номере">Кровать в общем номере</option>
                                            <option value="Кемпинг">Кемпинг</option>
                                            <option value="Апартаменты">Апартаменты</option>
                                            <option value="Отдельный номер без с\у">Отдельный номер без санузла</option>
                                            <option value="Отдельный номер с с\у">Отдельный номер с санузлом</option>
                                            <option value="Отель 3* и выше">Отель 3* и выше</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="repeat-4-all">

                                    <input type="checkbox" id="no-2" data-name="accommodation-lock">
                                    <label for="no-2">
                                        <i class="icon-lock-1 blue hide-element"></i>
                                        <i class="icon-lock-open-1 grey"></i>
                                    </label>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Укажите, входит ли питание в стоимость тура.</p>
                                        <p>Если входит, то отметьте тип питания в этот день.</p>
                                        <p>Не уверены в выборе?<br><br>Прочтите статью по теме в базе заний:</p>
                                        <a href="#" target="_blank" class="link">
                                            <img src="../../images/icons/icon-meal-16.svg" alt="icon-meal">&nbsp;Питание<br></a>
                                    </div>
                                </div>

                                <span>&nbsp;Питание:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text">

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
                                                <label for="d1-meal-1">Завтрак</label></div>

                                            <div><input type="checkbox" id="d1-meal-2" data-name="Обед">
                                                <label for="d1-meal-2">Обед</label></div>

                                            <div><input type="checkbox" id="d1-meal-3" data-name="Ужин">
                                                <label for="d1-meal-3">Ужин</label></div>

                                            <div><input type="checkbox" id="d1-meal-4" data-name="Перекус">
                                                <label for="d1-meal-4">Перекус</label></div>

                                            <div><input type="checkbox" id="d1-no-meal" data-name="Без питания">
                                                <label for="d1-no-meal">Без питания</label></div>

                                            <div><input type="checkbox" id="d1-meal-na" data-name="Нет информации">
                                                <label for="d1-meal-na">Нет информации</label></div>

                                        </div>
                                    </div>

                                </div>

                                <div class="repeat-4-all">

                                    <input type="checkbox" id="no-3" data-name="meal-lock">
                                    <label for="no-3">
                                        <i class="icon-lock-1 blue hide-element"></i>
                                        <i class="icon-lock-open-1 grey"></i>
                                    </label>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Если в этот день запланировано перемещение по маршруту или смена места
                                            проживания, укажите способы перемещения от точки до точки.</p>
                                        <p>Прочтите статью по теме в базе знаний:</p>
                                        <a href="#" target="_blank" class="link">
                                            <img src="../../images/icons/icon-tour-type-16.svg" alt="icon-tour-type">&nbsp;Типы
                                            туров
                                        </a>
                                    </div>
                                </div>

                                <span>&nbsp;Трансфер:&nbsp;</span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">укажите способ перемещения</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d1-transfer-type" class="checkbox-block transfer-box">

                                            <div><input type="checkbox" id="d1-transfer-type-2" data-name="Велосипед">
                                                <label for="d1-transfer-type-2">Велосипед</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-3"
                                                        data-name="Внедорожник">
                                                <label for="d1-transfer-type-3">Внедорожник</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-4"
                                                        data-name="Дом на колесах">
                                                <label for="d1-transfer-type-4">Дом на колесах</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-5"
                                                        data-name="Легковой автомобиль">
                                                <label for="d1-transfer-type-5">Легковой автомобиль</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-6"
                                                        data-name="Лодка (байдарка, плот)">
                                                <label for="d1-transfer-type-6">Лодка (байдарка, плот)</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-7" data-name="Мини-вэн">
                                                <label for="d1-transfer-type-7">Мини-вэн</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-8" data-name="Мотоцикл">
                                                <label for="d1-transfer-type-8">Мотоцикл</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-9"
                                                        data-name="Общественный транспорт">
                                                <label for="d1-transfer-type-9">Общественный транспорт</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-10"
                                                        data-name="Пеший переход">
                                                <label for="d1-transfer-type-10">Пеший переход</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-11" data-name="Поезд">
                                                <label for="d1-transfer-type-11">Поезд</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-12" data-name="Самолет">
                                                <label for="d1-transfer-type-12">Самолет</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-13"
                                                        data-name="Теплоход (круйизный лайнер)">
                                                <label for="d1-transfer-type-13">Теплоход (круйизный лайнер)</label>
                                            </div>

                                            <div><input type="checkbox" id="d1-transfer-type-14"
                                                        data-name="Туристический автобус">
                                                <label for="d1-transfer-type-14">Туристический автобус</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-15" data-name="Яхта">
                                                <label for="d1-transfer-type-15">Яхта</label></div>

                                            <div><input type="checkbox" id="d1-transfer-type-16" data-name="Другое">
                                                <label for="d1-transfer-type-16">Другое</label></div>

                                        </div>

                                    </div>

                                </div>

                                <div class="repeat-4-all">

                                    <input type="checkbox" id="no-3" data-name="meal-lock">
                                    <label for="no-3">
                                        <i class="icon-lock-1 blue hide-element"></i>
                                        <i class="icon-lock-open-1 grey"></i>
                                    </label>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day end">

                                <div class="help hover">
                                    <div class="help-pop-up right fade hide-element">
                                        <span class="close-pop-up"></span>
                                        <p>Добавьте развернутое описание программы на день</p>
                                    </div>
                                </div>

                                <span>Программа дня:&nbsp;</span>

                            </div>

                            <div class="program-form__text day end">

                                <div class="day__text">

                                    <textarea id="d1-plan" rows="1" placeholder="планы на день"></textarea>

                                </div>

                            </div>

                        </div>  <!-- day 1 -->

                    </div>

                </div>

                <!-- day 2 -->

                <div id="d2" class="day-box">

                    <div class="program-form__field start day">

                        <div class="group">
                            <span class="day-title">2&nbsp;&nbsp;день&nbsp;&nbsp;</span>
                            <span class="symbol toggle">&#9660;</span>
                            <span class="symbol toggle hide-element">&#9650;</span>
                        </div>

                        <div class="group">
                            <i class="icon-folder-open-empty toggle hide-element"></i>
                            <i class="icon-folder-empty toggle"></i>
                            <i class="icon-docs"></i>
                            <i class="icon-trash-empty"></i>
                        </div>


                    </div>
                    <!-- day 2 -->

                    <div class="day-cover hide-element">

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Место:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group">
                                    <div class="select-cover">
                                        <select id="d2-country" data-name="d2-country" class="clone" required>
                                            <option value="" selected disabled>страна</option>
                                            <!-- при клике по select дублирует элементы из '#start-city option' -->
                                        </select>
                                    </div>
                                    <div class="select-cover">
                                        <select id="d2-place" data-name="d2-place" class="clone" required>
                                            <option value="" selected disabled>город</option>
                                            <!-- при клике по select дублирует элементы из '#start-city option' -->
                                        </select>
                                    </div>
                                </div>

                                <div class="repeat-4-all">

                                    <i class="icon-lock-1 blue hide-element"></i>
                                    <i class="icon-lock-open-1 grey"></i>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Проживание:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text">
                                    <div class="select-cover">
                                        <select id="d2-accommodation" data-name="d2-accommodation" required>
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

                                <div class="repeat-4-all">

                                    <i class="icon-lock-1 blue hide-element"></i>
                                    <i class="icon-lock-open-1 grey"></i>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Питание:&nbsp;<span class="red">*</span></span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">включенное в стоимость</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d2-meal" class="checkbox-block">
                                            <!-- #no-meal, #meal-na привязан к JS-скрипту -->
                                            <div><input type="checkbox" id="d2-meal-1" data-name="Завтрак">
                                                <label for="d2-meal-1">Завтрак</label></div>

                                            <div><input type="checkbox" id="d2-meal-2" data-name="Обед">
                                                <label for="d2-meal-2">Обед</label></div>

                                            <div><input type="checkbox" id="d2-meal-3" data-name="Ужин">
                                                <label for="d2-meal-3">Ужин</label></div>

                                            <div><input type="checkbox" id="d2-meal-4" data-name="Перекус">
                                                <label for="d2-meal-4">Перекус</label></div>

                                            <div><input type="checkbox" id="d2-no-meal" data-name="Без питания">
                                                <label for="d2-no-meal">Без питания</label></div>

                                            <div><input type="checkbox" id="d2-meal-na" data-name="Нет информации">
                                                <label for="d2-meal-na">Нет информации</label></div>

                                        </div>
                                    </div>

                                </div>

                                <div class="repeat-4-all">

                                    <i class="icon-lock-1 blue hide-element"></i>
                                    <i class="icon-lock-open-1 grey"></i>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day">

                                <span>&nbsp;Трансфер:&nbsp;</span>

                            </div>

                            <div class="program-form__text day group">

                                <div class="day__text group">

                                    <div class="cover-box">

                                        <div class="group fade">
                                            <div class="text default">укажите способ перемещения</div>
                                            <div class="down-arr toggle"></div>
                                            <div class="up-arr toggle hide-element"></div>
                                        </div>

                                        <div id="d2-transfer-type" class="checkbox-block transfer-box">

                                            <div><input type="checkbox" id="d2-transfer-type-2" data-name="Велосипед">
                                                <label for="d2-transfer-type-2">Велосипед</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-3"
                                                        data-name="Внедорожник">
                                                <label for="d2-transfer-type-3">Внедорожник</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-4"
                                                        data-name="Дом на колесах">
                                                <label for="d2-transfer-type-4">Дом на колесах</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-5"
                                                        data-name="Легковой автомобиль">
                                                <label for="d2-transfer-type-5">Легковой автомобиль</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-6"
                                                        data-name="Лодка (байдарка, плот)">
                                                <label for="d2-transfer-type-6">Лодка (байдарка, плот)</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-7"
                                                        data-name="Мини-вэн">
                                                <label for="d2-transfer-type-7">Мини-вэн</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-8"
                                                        data-name="Мотоцикл">
                                                <label for="d2-transfer-type-8">Мотоцикл</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-9"
                                                        data-name="Общественный транспорт">
                                                <label for="d2-transfer-type-9">Общественный транспорт</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-10"
                                                        data-name="Пеший переход">
                                                <label for="d2-transfer-type-10">Пеший переход</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-11" data-name="Поезд">
                                                <label for="d2-transfer-type-11">Поезд</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-12"
                                                        data-name="Самолет">
                                                <label for="d2-transfer-type-12">Самолет</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-13"
                                                        data-name="Теплоход (круйизный лайнер)">
                                                <label for="d2-transfer-type-13">Теплоход (круйизный лайнер)</label>
                                            </div>

                                            <div><input type="checkbox" id="d2-transfer-type-14"
                                                        data-name="Туристический автобус">
                                                <label for="d2-transfer-type-14">Туристический автобус</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-15" data-name="Яхта">
                                                <label for="d2-transfer-type-15">Яхта</label></div>

                                            <div><input type="checkbox" id="d2-transfer-type-16"
                                                        data-name="Другое">
                                                <label for="d2-transfer-type-16">Другое</label></div>

                                        </div>

                                    </div>

                                </div>

                                <div class="repeat4all">

                                    <i class="icon-lock-1 blue hide-element"></i>
                                    <i class="icon-lock-open-1 grey"></i>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                        <div class="program-form__field day">

                            <div class="program-form__title day end">

                                <span>Программа дня:&nbsp;</span>

                            </div>

                            <div class="program-form__text day end">

                                <div class="day__text">

                                    <textarea id="d2-plan" rows="1" placeholder="планы на день"></textarea>

                                </div>

                            </div>

                        </div>  <!-- day 2 -->

                    </div>

                </div>

                <!-- day test -->

                <div class="day-box">

                    <div class="program-form__field start day add">

                        <span class="day-title">
                            добавить
                        </span>

                        <span><i class="icon-doc-new"></i></span>
                        <!--<i class="icon-trash"></i>
                        <i class="icon-popup-1"></i>
                        <i class="icon-popup-4"></i>
                        <i class="icon-squares"></i>
                        <i class="icon-clone"></i> -->
                    </div>


                </div>


            </div>

            <!-- id завязан на JS-->
            <div id="gallery" class="program-form__step hide-element">

                <div class="program-form__field">

                    <div class="program-form__title">

                        <span>Заглавное фото <span class="red">*</span></span>

                    </div>

                    <div class="program-form__text">

                        <input type="image">

                    </div>

                </div>

                <div class="program-form__image-result">
                    <img src="../../images/test/img-middle-template.jpg" alt="img-middle-template">
                    <!-- <img src="../../images/test/img-mini-template.jpg" alt="img-mini-template"> -->
                </div>

                <div class="program-form__field">

                    <div class="program-form__title">
                        <span>Фото <span class="red">*</span></span>
                    </div>

                    <div class="program-form__text"></div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">
                        <span>Видео</span>
                    </div>

                    <div class="program-form__text"></div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">
                        <span>Карта маршрута</span>
                    </div>

                    <div class="program-form__text"></div>

                </div>

            </div>

            <!-- id завязан на JS-->
            <div id="additional" class="program-form__step hide-element">

                <div class="program-form__field">

                    <div class="program-form__title">Что увидим</div>

                    <div class="program-form__text">

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default">укажите способ перемещения</div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id="" class="checkbox-block transfer-box">
                                <!-- тег c id=no-transfer привязан к JS-скрипту.
                                 Если есть изменения, сообщить в front-end.-->
                                <span><input type="checkbox" id="d1-no-transfer" data-name="Без перемещения">
                                <label for="d1-no-transfer" class="dark-grey">Без перемещения</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-2" data-name="Велосипед">
                                <label for="d1-transfer-type-2">Велосипед</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-3" data-name="Внедорожник">
                                <label for="d1-transfer-type-3">Внедорожник</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-4" data-name="Дом на колесах">
                                <label for="d1-transfer-type-4">Дом на колесах</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-5"
                                             data-name="Легковой автомобиль">
                                <label for="d1-transfer-type-5">Легковой автомобиль</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-6"
                                             data-name="Лодка (байдарка, плот)">
                                <label for="d1-transfer-type-6">Лодка (байдарка, плот)</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-7" data-name="Мини-вэн">
                                <label for="d1-transfer-type-7">Мини-вэн</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-8" data-name="Мотоцикл">
                                <label for="d1-transfer-type-8">Мотоцикл</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-9"
                                             data-name="Общественный транспорт">
                                <label for="d1-transfer-type-9">Общественный транспорт</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-10" data-name="Пеший переход">
                                <label for="d1-transfer-type-10">Пеший переход</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-11" data-name="Поезд">
                                <label for="d1-transfer-type-11">Поезд</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-12" data-name="Самолет">
                                <label for="d1-transfer-type-12">Самолет</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-13"
                                             data-name="Теплоход (круйизный лайнер)">
                                <label for="d1-transfer-type-13">Теплоход (круйизный лайнер)</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-14"
                                             data-name="Туристический автобус">
                                <label for="d1-transfer-type-14">Туристический автобус</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-15" data-name="Яхта">
                                <label for="d1-transfer-type-15">Яхта</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-16" data-name="Другое">
                                <label for="d1-transfer-type-16">Другое</label></span>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">Чем займемся</div>

                    <div class="program-form__text">

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default">укажите способ перемещения</div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id="d1-transfer-type" class="checkbox-block transfer-box">
                                <!-- тег c id=no-transfer привязан к JS-скрипту.
                                 Если есть изменения, сообщить в front-end.-->
                                <span><input type="checkbox" id="d1-no-transfer" data-name="Без перемещения">
                                <label for="d1-no-transfer" class="dark-grey">Без перемещения</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-2" data-name="Велосипед">
                                <label for="d1-transfer-type-2">Велосипед</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-3" data-name="Внедорожник">
                                <label for="d1-transfer-type-3">Внедорожник</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-4" data-name="Дом на колесах">
                                <label for="d1-transfer-type-4">Дом на колесах</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-5"
                                             data-name="Легковой автомобиль">
                                <label for="d1-transfer-type-5">Легковой автомобиль</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-6"
                                             data-name="Лодка (байдарка, плот)">
                                <label for="d1-transfer-type-6">Лодка (байдарка, плот)</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-7" data-name="Мини-вэн">
                                <label for="d1-transfer-type-7">Мини-вэн</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-8" data-name="Мотоцикл">
                                <label for="d1-transfer-type-8">Мотоцикл</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-9"
                                             data-name="Общественный транспорт">
                                <label for="d1-transfer-type-9">Общественный транспорт</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-10" data-name="Пеший переход">
                                <label for="d1-transfer-type-10">Пеший переход</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-11" data-name="Поезд">
                                <label for="d1-transfer-type-11">Поезд</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-12" data-name="Самолет">
                                <label for="d1-transfer-type-12">Самолет</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-13"
                                             data-name="Теплоход (круйизный лайнер)">
                                <label for="d1-transfer-type-13">Теплоход (круйизный лайнер)</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-14"
                                             data-name="Туристический автобус">
                                <label for="d1-transfer-type-14">Туристический автобус</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-15" data-name="Яхта">
                                <label for="d1-transfer-type-15">Яхта</label></span>

                                <span><input type="checkbox" id="d1-transfer-type-16" data-name="Другое">
                                <label for="d1-transfer-type-16">Другое</label></span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">Достопримечательности</div>

                    <div class="program-form__text">

                        <div class="group">

                            <input type="text" class="original" placeholder="достопримечательности">

                            <i id="key-points" class="icon-plus-circled-1"></i>

                            <i id="del-key-points" class="icon-minus-circled"></i>

                            <div class="help hover">
                                <div class="help-pop-up top fade hide-element">
                                    <span class="close-pop-up"></span>
                                    <p>Если в этот день планируется посещение известных достопримечательностей,
                                        добавьте
                                        их в список.</p>
                                    <p>Список всех достопримечательностей по вашей программе будет доступен
                                        пользователям сайта в коротком описании.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="program-form__field">

                    <div class="program-form__title">

                        <span>Коротко о главном</span>

                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>Чем уникальна ваша программа?</p>
                                <p>Напишите до 3-х причин, почему путешественнику следует выбрать именно этот
                                    тур.</p>
                                <p>Количество символов ограничено!</p>
                            </div>
                        </div>

                    </div>

                    <div class="program-form__text">

                        <div class="group">

                            <i id="reasons" class="icon-plus-circled-1"></i>

                            <i class="icon-minus-circled delete-clone"></i>
                        </div>

                    </div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">Не входит с стоимость</div>

                    <div class="program-form__text">Трасфер до места \ Виза \ Страховка \ Питание</div>

                </div>

                <div class="program-form__field">

                    <div class="program-form__title">Важно знать</div>

                    <div class="program-form__text"></div>

                </div>

            </div>

            <div class="new-program__bottom">

                <!--<div class="btn-grey"> <span>Назад</span> </div>-->

                <div class="btn-orange hide-element">
                    <span>Завершить</span>
                </div>

                <div class="btn-blue">
                    <span>Далее</span>
                </div>

                <div class="btn-grey">
                    <span>Сохранить</span>
                </div>

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