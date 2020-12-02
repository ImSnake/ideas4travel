"use strict";

const tourTypeObject = {

    checkedClassName: 'cover-tag', // имя класса для обертки выбранных чекбоксов

    //"Тип-тура"
    tourTypeBox: null,  // // элемент для добавления выбранных значений для "Тип-тура"
    tourTypeChecked: [],   // массив выбранных значений для "Тип-тура"
    defaultTourType: null,  // запоминает значение строки "Тип-тура" по дефолту
    tourTypeLimit: 4,      //максимально допустимое количество отмеченных чекбоксов

    // "Для кого"
    audienceBox: null,   // DOM-элемент для добавления выбранных значений
    audienceChecked: [],   // массив выбранных значений
    defaultAudience: null,   // запоминает значение строки по дефолту
    audienceDisable: ['everyone'],  // стоп-значения, блокирующие дальнейший выбор чекбосов
    audienceLimit: 4,        //максимально допустимое количество отмеченных чекбоксов

    //"Тип питания"
    mealBox: null, // DOM-элемент для добавления выбранных значений
    mealChecked: [],  // массив выбранных значений
    defaultMeal: null,  // // запоминает значение тега до начала манипуляций с элементов
    mealDisable: ['нет информации', 'все включено', 'не включено'], // стоп-значения, блокирующие дальнейший выбор чекбосов

    //"Тип трансфера"
    transferBox: null, // элемент для добавления выбранных значений для "Тип трансфера"
    transferTypeChecked: [],  // массив выбранных значений для "Тип-трансфера"
    defaultTransfer: null,     // запоминает значение строки по дефолту
    transferDisable: ['нет информации', 'без перемещения'],  // стоп-значения, блокирующие дальнейший выбор чекбосов
    transferTypeLimit: 4,      //максимально допустимое количество отмеченных чекбоксов
    transferDistanceClass: 'distance-box', // класс скрытого чекбокса для поля "Расстояние"
    transferDistanceBox: null,


    // Проверка блоков с чекбоксами (.checkbox-block) а предмет наличия сохраненных значений
    checkboxCheck() {

        $.each($('#tour-type input:checked'), function () {
            tourTypeObject.getTourType($(this));
        });

        $.each($('#target-audience input:checked'), function () {
            tourTypeObject.getAudience($(this));
        });

        $.each($('#plan-by-days .meal-box input:checked'), function () {
            tourTypeObject.getMealType($(this));
        });

        $.each($('#plan-by-days .transfer-box input:checked'), function () {
            tourTypeObject.getTransferType($(this));
        });

        $.each($('#places-tags input:checked, #activities-tags input:checked'), function () {
            tourTypeObject.getPlaceActionTags($(this));
        });
    },

    // логика работы чекбоксов для "Тип Тура"
    getTourType(elem) {

        let id = commonActions.getCurrentId(elem);
        this.tourTypeChecked = [];
        this.tourTypeBox = this.tourTypeBox || commonActions.getTextBox(id);
        this.defaultTourType = this.defaultTourType || commonActions.getDefault(this.tourTypeBox);
        this.tourTypeChecked = commonActions.getCheckedArr(id, this.tourTypeChecked);

        (Object.keys(this.tourTypeChecked).length === this.tourTypeLimit) ? commonActions.disableCheckboxes(id) : commonActions.enableCheckboxes(id);

        this.tourTypeBox.html(commonActions.getCheckedNames(this.tourTypeChecked, this.defaultTourType, this.checkedClassName));
    },

    // логика работы чекбоксов для "Для кого"
    getAudience(elem) {

        let id = commonActions.getCurrentId(elem);
        this.audienceChecked = [];
        this.audienceBox = this.audienceBox || commonActions.getTextBox(id);
        this.defaultAudience = this.defaultAudience || commonActions.getDefault(this.audienceBox);

        $.each(this.audienceDisable, function (index, value) {
            if (~elem.attr('id').indexOf(value)) {
                commonActions.disableCheck(elem, id);
            }
        });

        this.audienceChecked = commonActions.getCheckedArr(id, this.audienceChecked);

        if (Object.keys(this.audienceChecked).length === this.audienceLimit) {
            commonActions.disableCheckboxes(id);
        }
        if (Object.keys(this.audienceChecked).length === this.audienceLimit - 1) {
            commonActions.enableCheckboxes(id);
        }
        this.audienceBox.html(commonActions.getCheckedNames(this.audienceChecked, this.defaultAudience, this.checkedClassName));
    },

    // логика работы чекбоксов для "Питание"
    getMealType(elem) {

        let id = commonActions.getCurrentId(elem);
        this.mealChecked = [];
        this.mealBox = commonActions.getTextBox(id);
        this.defaultMeal = this.defaultMeal || commonActions.getDefault(this.mealBox);

        $.each(this.mealDisable, function (index, value) {
            if (~elem.attr('data-name').indexOf(value)) {
                commonActions.disableCheck(elem, id);
            }
        });

        this.mealChecked = commonActions.getCheckedArr(id, this.mealChecked);

        this.mealBox.html(commonActions.getCheckedNames(this.mealChecked, this.defaultMeal, this.checkedClassName));

        // если выбрано дефолтное значение, назначает на бокс класс DEFAULT (нужен для работы с локерами в plan-by-days)
        commonActions.addCheckedStyle(this.mealBox, this.mealBox.text(), this.defaultMeal);
    },

    // логика работы чекбоксов для "Тип трансфера"
    getTransferType(elem) {

        let id = commonActions.getCurrentId(elem);
        this.transferTypeChecked = [];
        this.transferBox = commonActions.getTextBox(id);
        this.defaultTransfer = this.defaultTransfer || commonActions.getDefault(this.transferBox);

        this.transferDistanceBox = $(id).siblings('.' + this.transferDistanceClass);

        let block = false; // если выбрано блокируещее дальнейший выбор значение = true

        $.each(this.transferDisable, function (index, value) {
            if (~elem.attr('data-name').indexOf(value)) {
                commonActions.disableCheck(elem, id);
                // если блокируещее значение - checkbox:checked, обновит значение переменной block
                if (elem.prop('checked')) {
                    block = true;
                }
            }
        });

        this.transferTypeChecked = commonActions.getCheckedArr(id, this.transferTypeChecked);

        // если есть отмеченные чекбоксы и эти чекбоксы не блокируют выбор, то показать поле для ввода расстояния, иначе - скрыть
        (Object.keys(this.transferTypeChecked).length > 0 && block === false)
            ? this.transferDistanceBox.removeClass('hide-element')
            : this.transferDistanceBox.addClass('hide-element');

        if (Object.keys(this.transferTypeChecked).length === this.transferTypeLimit) {
            commonActions.disableCheckboxes(id);
        }
        if (Object.keys(this.transferTypeChecked).length === this.transferTypeLimit - 1) {
            commonActions.enableCheckboxes(id);
        }

        this.transferBox.html(commonActions.getCheckedNames(this.transferTypeChecked, this.defaultTransfer, this.checkedClassName));

        // если выбрано дефолтное значение, назначает на бокс класс DEFAULT (нужен для работы с локерами в plan-by-days)
        commonActions.addCheckedStyle(this.transferBox, this.transferBox.text(), this.defaultTransfer);
    },

    // вывод количества отмеченных чекбоксов в основном (видимом) боксе элемента
    getPlaceActionTags(elem) {

        let id = commonActions.getCurrentId(elem);
        let qty = commonActions.getCheckedQty($(id));
        let box = commonActions.getTextBox(id).find('span').text('(' + qty + ')');

        if (box.text() !== '(0)') {
            box.removeClass('light-grey');
            box.addClass('blue');
        } else {
            box.removeClass('blue');
            box.addClass('light-grey');
        }
    },
};

const geoObject = {

    //обновляемые локальные переменные объекта geoObject
    countryStart: {}, // ID и название страны из поля "Старт"
    countryFinish: {}, // ID и название страны из поля "Финиш"
    countryExtra: {},  // ID и названия стран из "Мульти-тур"

    dayCountryIdArr: [],

    // DOM-элементы со страницы html
    domEl: {
        coverBoxClassName: 'checkbox-cover', // имя класса-обертки ФИНИШ и  МУЛЬТ-ТУР
        countryAddedClassName: 'cover-btn', // класс для добавленной в МУЛЬТ-ТУР страны
        countryDeleteClassName: 'delete-clone', // класс для иконки Удалить страну в МУЛЬТ-ТУР
        dayPlaceClassName: 'day-place', // класс для select: выбор страны в форме 2.ПЛАН ПО ДНЯМ
        dayCountryClassName: 'day-country', // класс для select: выбор страны в форме 2.ПЛАН ПО ДНЯМ
        //dayCityClassName: 'day-city', // класс для select: выбор страны в форме 2.ПЛАН ПО ДНЯМ

        descriptionID: $('#description'), // id формы "1.ОПИСАНИЕ"
        startCountry: $('#start-country'), // селект для СТАРТ-ГОРОД
        startCity: $('#start-city'), // селект для СТАРТ-ГОРОД
        finishBox: $('#finish'),  // cover-бокс для ФИНИШ
        finishCountry: $('#finish-country'),  // селект ФИНИШ-СТРАНА
        finishCity: $('#finish-city'),  // селект ФИНИШ-ГОРОД
        multiBox: $('#multi-tour'),  // cover-бокс для МУЛЬТИ-ТУР
        multiCountry: $('#multi-country'),  // select для МУЛЬТИ-ТУР
        countryList: $('#country-count'), // элемент для отображения стран "Старт\Финиш" в блоке "Мульти-тур"
        countryExtraBox: $('#country-added'),  // элемент для добавления\удаления стран, выбранных в мульти-тур
        countryIdList: $('#country-list'),  // скрытый инпут; передает на сервер id всех выбранных в #description стран

        planByDays: $('#plan-by-days'), // id формы "2.ПЛАН ПО ДНЯМ"
        dayCountyTemplate: $('#d00-country'),
    },

    // проверить инпуты GEO на заполненность: если форма ранее редактировалась, запоминает сохраненные значения в переменные объекта
    geoCheck() {

        (this.domEl.startCountry.find('option:selected').val() === '')
            ? this.domEl.startCity.parent().addClass('hidden') // если страна СТАРТ не выбрана, то скрыть поле для ввода города
            : this.geoToObject(this.domEl.startCountry, this.countryStart); // добавить информацию о страна-старт в переменную countryStart

        if (this.domEl.finishBox.attr('checked')) {
            this.openFade(this.domEl.finishBox);  // если чекбокс ФИНИШ отмечен, показать блок ФИНИШ
        }

        if (!this.domEl.finishCountry.find('option:selected').val() === '' ||
            !this.domEl.finishCountry.find('option:selected').length < 1) {
            this.geoToObject(this.domEl.finishCountry, this.countryFinish); // если финиш selected, добавить значение в переменную
        }

        this.checkStartFinish(); // проверка на заполненность переменных СТАРТ и ФИНИШ

        if (this.domEl.multiBox.attr('checked')) {  // если чекбокс МУЛЬТИ-ТУР отмечен
            this.domEl.countryList.removeClass('hidden'); // показать список стран СТАРТ и ФИНИШ
            $.each($(this.domEl.countryExtraBox).find('span'), function (index, value) {
                if (!$(value).hasClass(geoObject.domEl.countryDeleteClassName)) {
                    value.classList.add(geoObject.domEl.countryAddedClassName); //задать странам классы для отображения в МУЛЬТИ-ТУР
                    let id = value.getAttribute('data-country');  // получить ID переданной страны
                    geoObject.countryExtra[id] = $(value).text(); // сохранить значение в переменную countryExtra
                }
            });

            this.openFade(this.domEl.multiBox);  // показать содержимое бокса МУЛЬТ-ТУР
            this.multiChecked(this.domEl.multiCountry);  // заблокировать для МУЛЬТИ-ТУР options cо всеми выбранными странами
            this.multiChecked(this.domEl.finishCountry);  // заблокировать для ФИНИШ options cо странами из МУЛЬТИ-ТУР
        }

        this.getAllCountryId(); // получить список c ID выбранных стран
        this.getDaysCountryIdArr(); // получить список c ID стран из #plan-by-days
    },

    // обновить информацию в переменных СТАРТ и ФИНИШ и сформировать список стран для бокса МУЛЬТИ-ТУР
    checkStartFinish() {

        if (!$.isEmptyObject(this.countryStart)) { // если старт не пустой объект, то обновляет список
            let start = this.countryStart[Object.keys(this.countryStart)[0]]; // получить название страны СТАРТ
            let finish = this.countryFinish[Object.keys(this.countryFinish)[0]]; // получить название страны ФИНИШ

            if (start === finish || $.isEmptyObject(this.countryFinish)) { // если ФИНИШ равен старт или если ФИНИШ пустой объект
                this.countryFinish = this.countryStart;
                this.domEl.countryList.text(start);
            } else {
                this.domEl.countryList.text(start + ", " + finish);
            }
        } else { // если старт пустой объект, то обнуляет все переданные значения
            this.countryStart = {};
            this.countryFinish = {};
        }
    },

    // устанавливает в option переданного селекта атрибуты disabled для уже выбранных стран
    multiChecked(select) {

        let arr = Object.keys(geoObject.countryExtra);  // для финиш

        if (select.is(this.domEl.multiCountry)) { // если передали мульти-тур, то добавить в массив стран на проверку СТАРТ и ФИНИШ
            let start = Object.keys(geoObject.countryStart)[0],
                finish = Object.keys(geoObject.countryFinish)[0];

            (start === finish || finish === null) ? arr.push(start) : arr.push(start, finish); // если СТАРТ-ФИНИШ, исключает повторное значение
            select.find('option[value=""]').prop({'selected': true, 'disabled': true});
        }

        $.each(select.find('option'), function (index, value) {
            $(this).prop('disabled', false);
            let val = $(value).val();

            if (arr.includes(val) === true) {
                $(this).prop('selected', false);
                $(this).prop('disabled', true);
            }
        });
    },

    // ОПИСАНИЕ/СТАРТ - поведение полей формы "Страна" при изменении значения select
    startCountryChanged(elem) {

        // действия для бокса СТАРТ
        commonActions.clearAutocompleteVal($('#start-city').parent()); //  oбнулить значения для ввода города
        this.domEl.startCity.parent().removeClass('hidden');
        this.geoToObject(elem, this.countryStart = {}); // сохранить новое значение в СТАРТ

        // действия для бокса ФИНИШ
        commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД
        this.closeFade(this.domEl.finishBox.prop('checked', false)); // снять галку и скрыть ФИНИШ-БОКС
        this.clearCloneBox(this.domEl.finishBox);  // удалить все options из МУЛЬТИ-ТУР select
        this.countryFinish = {}; // обнулить переменную для ФИНИШ-СТРАНА
        this.checkStartFinish(); // обновить список стран СТАРТ и ФИНИШ

        // действия для бокса МУЛЬТИ-ТУР
        this.domEl.countryList.addClass('hidden'); // скрыть список стран "Старт\Финиш"
        this.closeFade(this.domEl.multiBox.prop('checked', false)); // снять галку и скрыть бокс МУЛЬТИ-ТУР
        this.clearCloneBox(this.domEl.multiBox);  // удалить все options из МУЛЬТИ-ТУР select
        this.domEl.countryExtraBox.empty(); // очистить бокс для добавления выбранных стран
        this.countryExtra = {}; // обнулить переменную для МУЛЬТИ-СТРАН

        // финальные действия
        this.getAllCountryId();  // обновить список с ID выбранных стран
        this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
    },

    // ОПИСАНИЕ/ФИНИШ - поведение полей формы при клике по checkbox
    finishClicked(event) {

        if (!this.checkGeo(event)) { // если пройдена проверка на заполненность поля СТАРТ

            this.clearCloneBox(this.domEl.finishBox); // очистить select для ФИНИШ-СТРАНА
            commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД

            // если действие на открытие блока ФИНИШ
            if (this.domEl.finishBox.prop("checked")) {
                $(this.domEl.startCountry).find('option').clone().appendTo(this.domEl.finishCountry); // копирует все option из select СТАРТ-СТРАНА
                this.finishChecked();                   // ставит СТАРТ-СТАРНУ в ФИНИШ и очищает форму ФИНИШ-ГОРОД
                this.openFade(this.domEl.finishBox); // открывает бокс ФИНИШ

                if (this.domEl.multiBox.prop('checked')) { // если открыт МУЛЬТИ-ТУР и в нем есть выбранные страны
                    this.multiChecked(this.domEl.finishCountry); // добавляет в ФИНИШ option disabled для выбранных в МУЛЬТИ-ТУР стран
                }

            } else {   // если действие на скрытие блока ФИНИШ
                this.closeFade(this.domEl.finishBox); // скрывает бокс ФИНИШ
                this.countryFinish = {}; // очистить переменную ФИНИШ
                this.checkStartFinish(); // обновить список стран СТАРТ и ФИНИШ
                if (this.domEl.multiBox.prop('checked')) { // если открыт МУЛЬТИ-ТУР
                    this.multiChecked(this.domEl.multiCountry); // обновляет в МУЛЬТИ-ТУР option disabled
                }
            }
            this.getAllCountryId();
            this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
        }
    },

    finishCountryChanged(newVal) {

        commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД
        this.geoToObject(newVal, this.countryFinish = {}); // сохранить в ФИНИШ новое значение
        this.checkStartFinish();    // обновить список стран "Старт\Финиш" в блоке "Мульти-тур"
        //commonActions.clearAutocompleteVal(this.domEl.finishCity.parent()); // очистить value для инпутов ФИНИШ-ГОРОД

        if (this.domEl.multiBox.prop('checked')) { // если открыт МУЛЬТИ-ТУР
            this.multiChecked(this.domEl.multiCountry);  // заблокировать для МУЛЬТИ-ТУР options cо всеми выбранными странами
            this.multiChecked(this.domEl.finishCountry);  // заблокировать для ФИНИШ options cо странами из МУЛЬТИ-ТУР
        }

        this.getAllCountryId();
        this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
    },

    // ОПИСАНИЕ/МУЛЬТИ-ТУР - поведение полей формы при клике по checkbox
    multiTourClicked(event) {

        if (!this.checkGeo(event)) {             // если пройдена проверка на заполненность поля СТАРТ

            this.clearCloneBox(this.domEl.multiBox);   // очистить select для  МУЛЬТИ-ТУР

            if (!this.domEl.multiBox.prop("checked")) {   // если действие на закрытие блока МУЛЬТИ-ТУР
                this.closeFade(this.domEl.multiBox);
                this.countryExtra = {};
                this.domEl.countryList.addClass('hidden');
                this.domEl.countryExtraBox.empty();
                this.multiChecked(this.domEl.finishCountry); // обновить список доступных для выбора стран в ФИНИШ
            } else {    // если действие на открытие (показ) блока МУЛЬТИ-ТУР
                // проверить включен ли локер для НОЧЕВКА. Если включен, вывести предупреждение и отменить показ блока
                if ($('#day-1 .'+this.domEl.dayPlaceClassName).siblings('.repeat-4-all').hasClass(daysObject.domEl.lockedClass)){
                    oftenUsed.dialogMessageCall('Чтобы добавить в программу еще страну, отключи в разделе<br>"2. План по дням" ' +
                        '<br>автозаполнение для поля НОЧЕВКА');
                    this.domEl.multiBox.prop("checked", false);
                    return;
                }
                // если локер для поля "Ночевка" не включен, создать селект, открыть блок, заблокировть выбор уже выбранных стран
                $(this.domEl.startCountry).find('option').clone().appendTo(this.domEl.multiCountry);
                this.domEl.countryList.removeClass('hidden');
                this.openFade(this.domEl.multiBox);
                this.multiChecked(this.domEl.multiCountry); // обновляет в МУЛЬТИ-ТУР option disabled
            }
            this.getAllCountryId();
            this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
        }
    },

    // добавляет из "Мульти-тур" выбранные страны в массив countryExtra и на страницу в #country-added
    addExtraCountry(newVal) {

        let country = newVal.find('option:selected');

        if (Object.getOwnPropertyNames(this.countryExtra).includes(country.val()) === false && country.text() !== 'страна') {
            this.geoToObject(newVal, this.countryExtra);
            this.multiChecked(this.domEl.multiCountry);  // заблокировать для МУЛЬТИ-ТУР options cо всеми выбранными странами
            this.multiChecked(this.domEl.finishCountry);  // заблокировать для ФИНИШ options cо странами из МУЛЬТИ-ТУР

            let extraList = commonActions.getCheckedNames(Object.values(this.countryExtra), '', this.domEl.countryAddedClassName);
            this.renderCountryExtra(this.domEl.countryExtraBox.empty(), extraList, this.domEl.countryDeleteClassName);

            this.getAllCountryId();
            this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
        }
    },

    renderCountryExtra(box, arr, className) {

        box.html(arr);
        $.each($(box).find('span'), function () {
            let elem = document.createElement('span');
            elem.classList.add(className);
            this.append(elem);
        });
    },

    // удаляет из "Мульти-тур" выбранную страну по клику (-)
    deleteElem(elem, key) {
        delete this.countryExtra[key]; // удалить страну из массива стран
        elem.parent().remove(); // удалить html-элемент со страницы
        this.multiChecked(this.domEl.multiCountry);  // заблокировать для МУЛЬТИ-ТУР options cо всеми выбранными странами
        this.multiChecked(this.domEl.finishCountry);  // заблокировать для ФИНИШ options cо странами из МУЛЬТИ-ТУР

        this.getAllCountryId();
        this.compareCountryValArr(); // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ
    },

    //проверка поля "Старт" на предмет заполнения. Если не заполнено, чекбокс не откроет "Финиш" и "Мульти-тур"
    checkGeo(event) {

        let id = event.target.getAttribute('id');
        let result = false;

        if (id === this.domEl.finishBox.attr('id')) { // если клик по чекбоксу "Финиш в ином месте"
            if (this.domEl.startCity.val() === "") {
                $(this).attr('checked', false);
                oftenUsed.dialogMessageCall('Сначала заполни "МЕСТО СТАРТА" программы: <br>' +
                    'выбери страну и город, где происходит сбор участников');
                event.preventDefault();
                event.stopPropagation();
                result = true;
            }
        }

        if (id === this.domEl.multiBox.attr('id')) {  // если клик по чекбоксу "Мульти-тур"
            if (this.domEl.startCountry.val() === "" || this.domEl.startCountry.val() === null) {
                $(this).attr('checked', false);
                oftenUsed.dialogMessageCall('Сначала заполни "МЕСТО СТАРТА" программы: <br>' +
                    'выбери страну, где происходит сбор участников');
                event.preventDefault();
                event.stopPropagation();
                result = true;
            }
        }
        return result;
    },

    // устанавливает в Финиш страну из Старт
    finishChecked() {

        let country = Object.keys(geoObject.countryStart)[0];

        $.each(this.domEl.finishCountry.find('option'), function (index, value) {
            if (value.getAttribute('value') === country) {
                $(this).prop('selected', true);
            }
        });
    },

    startCityCheck(){
        console.log('start city selection check');
        if (this.countryStart === this.countryFinish) {
            if (this.domEl.startCity.val() === "") {
                this.domEl.finishBox.prop("checked", false); // снять выбор с бокса "ФИНИШ В ИНОМ МЕСТЕ"
                this.closeFade(this.domEl.finishBox); // скрыть бокс "ФИНИШ В ИНОМ МЕСТЕ"
                commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД
            }
            if (this.domEl.startCity.val() !== "" && this.domEl.startCity.val() === this.domEl.finishCity.val()) {
                commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД
            }
        }
    },

    // при изменении значения в ФИНИШ-ГОРОД запускает проверку на равенство городов ФИНИШ и СТАРТ
    finishCityCheck(){
        console.log('finish city compare: start&finish');
        // если у городов одинаковые ID, то выводит предупреждение и обнуляет переданные в ФИНИШ-ГОРОД значения
        if ($('#start-city-id').val() === $('#finish-city-id').val()) {
            commonActions.clearAutocompleteVal($('#finish-city').parent()); // очистить value для инпутов ФИНИШ-ГОРОД
            oftenUsed.dialogMessageCall("Места старта и финиша совпадают!<br>Измени место финиша либо отключи опцию 'ФИНИШ В ИНОМ МЕСТЕ'.");
        }
    },

    //передать в value скрытого инпута #country-list все ID стран, выбранных пользователем
    getAllCountryId() {
        // построить список ID для передачи информации для back-end
        if (!$.isEmptyObject(this.countryStart)) {
            let idList = Object.keys(this.countryStart)[0];

            ($.isEmptyObject(this.countryFinish)) ? idList += ',' + idList : idList += ',' + Object.keys(this.countryFinish)[0];

            if (!$.isEmptyObject(this.countryExtra)) {
                for (let key in this.countryExtra) {
                    idList += ',' + key;
                }
            }
            this.domEl.countryIdList.val(idList);
        }
        console.log(this.domEl.countryIdList.val());
    },

    // для переменной объекта создать по шаблону свойство и значение из переданного элемента
    geoToObject(elem, obj) {
        let id = elem.val();
        obj[id] = elem.find(":selected").text();
    },

    // создает и возвращает элемент option с заданным значением
    renderOption(index, value, prop) {
        return "<option " + prop + " value='" + index + "'>" + value + "</option>";
    },

    // очищает контейнеры "Финиш" и "Мульти-тур" для клонирования в них тегов select из "Старт"
    clearCloneBox(elem) {
        elem.siblings('.fade').find('.clone').empty();
    },

    // при клике плавное открытие контейнеров "Финиш" и "Мульти-тур" под чекбоксом
    openFade(elem) {
        elem.siblings('.fade').fadeIn("500", "linear").removeClass('hide-element');
    },

    // при клике плавное закрытие контейнеров "Финиш" и "Мульти-тур" под чекбоксом
    closeFade(elem) {
        elem.siblings('.fade').fadeOut("500", "linear").addClass('hide-element');
    },

    // получить и сохранить в массив ID всех стран из #plan-by-days
    getDaysCountryIdArr(){

        $.each(this.domEl.dayCountyTemplate.find('option'), function () {
            if ($(this).val() !== ""){
                geoObject.dayCountryIdArr.push($(this).val());
            }
        });

        console.log('страны в План по дням :' + this.dayCountryIdArr);
        // заблокировать манипуляции с локером для поля "НОЧЕВКА", если в ОПИСАНИИ выбрано более одной страны
        if (this.dayCountryIdArr.length > 1) {
            console.log("отключить выбор локера для поля НОЧЕВКА");
            $('#day-1 .'+this.domEl.dayPlaceClassName).siblings('.repeat-4-all').css('opacity', '0.6').find('input').prop('disabled', true);
        } else {
            console.log("снять блок с локера для поля НОЧЕВКА");
            $('#day-1 .'+this.domEl.dayPlaceClassName).siblings('.repeat-4-all').css('opacity', '1').find('input').prop('disabled', false);
        }

    },

    // сравнить ID стран из ОПИСАНИЕ и ПЛАН-ПО-ДНЯМ. Если false - запустит скрипт по обновлению информации на странице ПЛАН-ПО-ДНЯМ
    compareCountryValArr(){

        let list = {};
        // получить объект с ID и названиями всех выбранных стран исключая дубликаты
        (this.countryStart !== this.countryFinish)  // объединить в один объект страны СТАРТ-ФИНИШ-ЭКСТРА
            ? $.extend(list, this.countryStart, this.countryFinish, this.countryExtra)
            : $.extend(list, this.countryStart, this.countryExtra);

        // сравнить ID со страниц ОПИСАНИЕ (list) и ПЛАН ПО ДНЯМ (this.dayCountryIdArr)
        if (!($(this.dayCountryIdArr).not(Object.keys(list)).length === 0 && $(Object.keys(list)).not(this.dayCountryIdArr).length === 0)) {
            console.log('есть изменения стран');
            this.renewDayCountry(list);// обновить в #plan-By-Days для .day-country списки стран для выбора
            this.dayCountryIdArr = []; // обнулить переменную с ID стран
            this.getDaysCountryIdArr(); // получить из #plan-By-Days новые ID стран
        }
    },

    // // обновить в #plan-By-Days для .day-country списки стран для выбора
    renewDayCountry(obj){
        // 1. проверка на необходимость удалить страну
        let difference = this.dayCountryIdArr.filter(x => !(Object.keys(obj)).includes(x));

        // если есть страны на удаление
        if (difference.length > 0) {
            console.log("удалить лишнее");
            console.log(difference);

            // найти в #plan-By-Days все option для .day-country и удалить все со значением из массива difference
            $.each(this.domEl.planByDays.find('.' + geoObject.domEl.dayCountryClassName + ' option'), function () {

                for (let i = 0; i < difference.length; i++) { // перебрать массив с ID элементов на удаление
                    if ($(this).val() === difference[i]) {// если значение option совпадает с ID элемента на удаление
                        console.log("есть совпадения в План по дням");

                        if ($(this).prop('selected')) { // проверить option на наличие атрибута selected
                            console.log("страна :selected в План по дням");
                            $(this).siblings('option:disabled').prop('selected', true).text('страна из списка'); // перенастроить selected на дефолтный option
                            daysObject.daySelectChildSettings($(this).parent()); // скрыть и обнулить значения для города
                        }
                        $(this).remove(); // удалить option
                    }
                }
            });
        }

        // 2. проверка на необходимость добавить страну
        let extra = Object.keys(obj).filter(x => !(this.dayCountryIdArr).includes(x));

        // если есть страны на добавление
        if (extra.length > 0) {
            console.log("добавить новое");
            console.log(extra);

            // добавить в #plan-By-Days во все .day-country select новые option из массива extra
            $.each(this.domEl.planByDays.find('.' + geoObject.domEl.dayCountryClassName), function () {

                for (let i = 0; i < extra.length; i++) {
                    $(this).append(geoObject.renderOption(extra[i], obj[extra[i]], ''));
                }
            });
        }
    },

    // проверка наличия любых сохраненных значений в поле НОЧЕВКА в разделе ПЛАН ПО ДНЯМ
    checkDayCountrySavings(){

        let selected = false;
        $.each(this.domEl.planByDays.find('.' + geoObject.domEl.dayCountryClassName + ' option:selected'), function () {
            if ($(this).val() !== ''){
                selected = true;
            }
        });
        return selected;
    },

    // проверка переданной страны в сохраненных значениях в НОЧЕВКА / ПЛАН ПО ДНЯМ
    checkDayCountrySelected (elem){

        // проверить переданный массив на наличие значений
        if (elem.length < 1){  // если длина меньше 1, значит передано пустрое значение
            console.log('Нет сохраненных значений: продолжить дефолтный скрипт');
            return false;
        }

        // проверка для СТРАНА-ФИНИШ: если СТАРТ-СТРАНА = ФИНИШ-СТРАНА, внести изменения без запроса на подтверждение
        if (elem[0] === Object.keys(this.countryStart)[0]) {
            console.log('ФИНИШ = СТАРТ: значения в "ПЛАН ПО ДНЯМ" не будут затерты: продолжить дефолтный скрипт');
            return false;
        }

        let selected = false;
        for (let i = 0; elem.length > i; i++) {
            $.each(this.domEl.planByDays.find('.' + this.domEl.dayCountryClassName + ' option:selected'), function () {
                if ($(this).val() === elem[i]) {
                    console.log('Есть связанные сохранения! Будет запущен запрос на подтверждение действия');
                    selected = true;
                }
            });
        }
        return selected;
    },

    // СТАРТ-СТРАНА: запрос на подтверждение действия при изменении выбранного значения
    confirmStartCountryChange(elem, oldVal){
        console.log('Запрос подтверждения на изменение страны-старт: в разделе План по дням" есть сохраненные значения');

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Изменить выбор страны для "МЕСТО СТАРТА"?',
            content: 'При изменении будут сброшены все ранее выбранные страны и города в разделах "Описание" и "План по дням"!',//'В разделе "План по дням" - "Ночевки" есть связанные с этим полем записи',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Изменить",
                    btnClass: 'btn-blue',
                    action: function(){
                        //commonActions.clearAutocompleteVal($('#start-city').parent()) //  oбнулить предыдущие значения ввода города
                        geoObject.startCountryChanged(elem); // запустить скрипты на обновление выбора страны
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    action: function(){
                        // вернуть предыдущее значение страны (то, что было до изменения поля формы)
                        oldVal.prop('selected', true);
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // ФИНИШ-СТРАНА запрос на подтверждение действия при изменении выбранного значения
    confirmFinishCountryChange(elem, oldVal){
        console.log('Запрос подтверждения на изменение выбора страны-финиш: ФИНИШ != СТАРТ и выбран в ПЛАН ПО ДНЯМ');

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Изменить выбор страны для "ФИНИШ В ИНОМ МЕСТЕ"?',
            content: 'В разделе "План по дням" есть связанные со страной сохранения. При изменении они будут сброшены.',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Изменить",
                    btnClass: 'btn-blue',
                    action: function(){
                        //commonActions.clearAutocompleteVal($('#finish-city').parent());
                        geoObject.finishCountryChanged(elem);
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    action: function(){
                        // вернуть предыдущее значение страны (то, что было до изменения поля формы)
                        oldVal.prop('selected', true);
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });

    },

    // МУЛЬТИ-СТРАНА запрос на подтверждение действия при изменении выбранного значения
    confirmMultyCountryChange(elem, key, txt){
        console.log('Запрос подтверждения на удаление мульти-страны, выбранной в "План по дням"');

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Удалить страну ' + txt + '?',
            content: 'В разделе "План по дням" есть связанные со страной сохранения. Они будут удалены.',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Удалить",
                    btnClass: 'btn-blue',
                    action: function(){
                        // продолжить удаление страны из Мульти-тур
                        geoObject.deleteElem(elem, key)
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){
                        return;
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    confirmCloseBox(elem, event){
        console.log('Запрос подтверждения на действие "Отмена выбора чекбокса"');
        event.preventDefault(); // остановить всплытие события

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Отключить опцию и удалить выбранные значения?',
            content: 'В разделе "План по дням" есть связанные с полем сохранения. При отключении они будут удалены.',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Отключить",
                    btnClass: 'btn-blue',
                    action: function(){
                        // определить следующее действие по ID переданного чекбокса
                        geoObject.defineBoxAction(elem.prop('checked', false), event);
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){
                        // прервать закрытие блока
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // определить для какого блока с чекбоксом (ФИНИШ или МУЛЬТИ-ТУР) нужно применить действие на закрытие
    defineBoxAction(elem, event){
        // если в Id чекбокса есть строка "finish", запустить скрипт для ФИНИШ, иначе запустить скрипт для МУЛЬТИ-ТУР
        (~elem.attr('id').indexOf('finish')) ? geoObject.finishClicked(event) : geoObject.multiTourClicked(event);
    },

};

const daysObject = {

    // обновляемые локальные переменные объекта daysObject
    daysAmount: 2,  // хранит инф-ю о количестве дней в программе; если значение не задано, то  по умолчанию = 2 дня
    daysCount: 2,  // счетчик количества созданных дней в "2.ПРОГРАММА ПО ДНЯМ" (#plan-by-days); по умолчанию = 2 дня

    // DOM-элементы со страницы html
    domEl: {
        dayClassName: 'day-box', // имя класса для бокса "ДЕНЬ"
        lastNightSettings: 'night-place', // имя класса для полей формы "МЕСТО" и "РАЗМЕЩЕНИЕ"
        dayTextClassName: 'day__text', // имя класса для полей формы с текстом для бокса "ДЕНЬ"
        accommodationClassName: 'day-accommodation', // имя класса для полей формы с селектами для бокса "РАЗМЕЩЕНИЕ"
        accommodationTypeClassName: 'accommodation-type', // имя класса для полей формы с селектами для бокса "РАЗМЕЩЕНИЕ"
        lockerClassName: 'repeat-4-all', //
        lockedClass: 'locked', //
        unlockedClass: 'unlocked', //

        planByDays: $("#plan-by-days form"), // id формы "2.ПЛАН ПО ДНЯМ"
        dayTemplate: $('#day-0'), // скрытый DOM-элемент с шаблоном "ДЕНЬ 00" для добавления в нового дня в #plan-by-days
        duration: $('#duration'), // продолжительность программы в днях из "1.ОПИСАНИЕ" (#description)
    },

    // переменные для работы с локерами
    lockersArr: [],  // dom-элемент с примененными (:checked) локерами
    geoName: 'НОЧЕВКА',
    geoTrigger: 'day-place',
    geoLock: null,  // !!! -не используется глобально -!!! dom-элемент: хранит информацию о значении для локера МЕСТО
    accommodationName: 'РАЗМЕЩЕНИЕ',
    accommodationTrigger: 'day-accommodation',
    accommodationLock: null,  // !!! -не используется глобально -!!! dom-элемент: хранит информацию о значении для локера ПРОЖИВАНИЕ
    mealName: 'ПИТАНИЕ',
    mealTrigger: 'day-meal',
    mealLock: null,  // !!! -не используется глобально -!!! dom-элемент: хранит информацию о значении для локера ПИТАНИЕ
    transferName: 'ТРАНСФЕР',
    transferTrigger: 'day-transfer',
    transferLock: null, // !!! -не используется глобально -!!! dom-элемент: хранит информацию о значении для локера ТРАНСФЕР


    // при загрузке проверяет ранние сохранения в ПЛАН ПО ДНЯМ: страны и локеры и
    daysCheck(){

        // если в "НОЧЕВКА" нет сохраненных стран, скрыть поле для ввода города
        $.each(this.domEl.planByDays.find('.'+geoObject.domEl.dayCountryClassName+' option:selected:disabled'), function () {
            $(this).parents('.select-cover').siblings().addClass('hidden');
        });

        //если в "РАЗМЕЩЕНИЕ" нет сохраненненного типа жилья, то скрыть поле "вместимость номера"
        $.each(this.domEl.planByDays.find('.'+daysObject.domEl.accommodationTypeClassName+' option:selected:disabled'), function () {
            $(this).parents('.select-cover').siblings().addClass('hidden');
        });

        this.updateLockersArr();  // получитить все отмеченные чекбоксы локеров (.repeat-4-all)

        if (this.lockersArr.length > 0) { // если есть локеры с отмеченными чекбоксами, внести изменения
            $.each(this.lockersArr, function () {
                let trigger = ($(this).attr('id')).slice(4); // получить триггер локера
                let allFields = daysObject.domEl.planByDays.find('.' + trigger);  // найти в "План по дням" все элементы с полученным классом
                daysObject.switchAction($(this), trigger, allFields);  // выбор блокирующего действия в зависимости от переданного триггера
            });
        }
    },

    // при загрузке страницы проверяет и сохраняет данные в переменные daysAmount и daysCount +
    // проверяет настройки полей "НОЧЕВКА" и "РАЗМЕЩЕНИЕ" для последнего дня
    getCurrentData() {
        this.getDaysAmount(); // получить данные для переменной this.daysAmount
        this.getDaysCount(); // получить данные для переменной this.daysCount
        this.lastDaySettings(); // настроить отображение элементов для последнего блока "ДЕНЬ" (скрыть МЕСТО и РАЗМЕЩЕНИЕ)
    },

    // при изменении поля ДЛИТЕЛЬНОСТЬ (1.ОПИСАНИЕ), сохраняет в переменную выбранное количество дней
    getDaysAmount() {

        let val = this.domEl.duration.val(); //получить текущее значение из #duration

        (val === undefined || val < 2) ? this.daysAmount = 2 : this.daysAmount = parseInt(val); // записать в переменную
    },

    //  получает из "2.ПЛАН ПО ДНЯМ" количество созданных блоков "ДЕНЬ" и сохраняет их в переменную this.daysCount
    getDaysCount(){
        this.daysCount = parseInt(this.domEl.planByDays.find('.' + this.domEl.dayClassName).length);
    },

    // скрипт для скрытия полей формы "НОЧЕВКА" и "РАЗМЕЩЕНИЕ" для последнего дня формы plan-by-days
    lastDaySettings() {
        // сделать видимыми поля формы "НОЧЕВКА" и "РАЗМЕЩЕНЕ" для всех созданных дней
        $.each(this.domEl.planByDays.find('.' + this.domEl.lastNightSettings), function () {
            $(this).removeClass('hidden-field');
        });
        // если продолжительность программы совпадает с количеством созднных дней в plan-by-days
        // то, скрывает поля формы "НОЧЕВКА" и "РАЗМЕЩЕНИЕ" для последнего дня
        if (this.daysAmount === this.daysCount) {
            $.each($('form .' + this.domEl.dayClassName).last().find('.' + this.domEl.lastNightSettings), function () {
                $(this).addClass('hidden-field');
            });
        }
    },

    //  при изменении поля НОЧЕВКА-СТРАНА и РАЗМЕЩЕНИЕ-ТИП ЖИЛЬЯ определит поведение соседнего блока (ГОРОД \ ВМЕСТИМОСТЬ НОМЕРА)
    daySelectChildSettings(elem) {

        let childBox = elem.parent().siblings('.select-cover');

        (elem.find('option:selected').val() === '')
            ? childBox.addClass('hidden')  //если поле "страна" пустое, скрыть поле для ввода города
            : childBox.removeClass('hidden')  //иначе показать поле для ввода города

        commonActions.clearAutocompleteVal(childBox); // очистить инпуты для выбора города
    },

    // ловит события нажатий по динамически созданным элементам страницы "2.План по дням",
    // определяет тип события по ключевым признакам и запускает скрипт для выполнения действия
    dayClickedActions(elem, e) {

        console.log(this);

        // свернуть-развернуть содержимое бокса ДЕНЬ
        if (elem.hasClass('day-title')) {
            this.dayToggleBox(elem);
            return;
        }
        // дублировать ДЕНЬ со всей внесенной информацией
        if (elem.hasClass('day-clone')) {
            this.confirmCloneAction(elem.parents().closest('.' + this.domEl.dayClassName));
            return;
        }
        // удалить ДЕНЬ
        if (elem.hasClass('day-delete')) {
            this.confirmDeleteDayAction(elem.parents().closest('.' + this.domEl.dayClassName));
            return;
        }
        // добавить строку в списки ЛОКАЦИЯ\АКТИВНОСТЬ
        if (elem.hasClass('add-elem')) {
            this.dayAddInput(elem);
            return;
        }
        // удалить строку из списков ЛОКАЦИЯ\АКТИВНОСТЬ
        if (elem.hasClass('delete-elem')) {
            this.confirmInputRemove(elem);
            return;
        }
        // добавляет для select атрибут selected в dom-дерево (необходимо для копирования дней)
        //if (elem.hasClass('text')) {
        //    if (elem.find(':selected').attr('value') === '') {
       //         elem.find(':selected').attr('selected', false);
       //     }
       //     elem.find(':selected').attr('selected', true);
       //     return;
       // }
       //if (elem.hasClass('turn-img')){
       //    console.log("нажали на кнопку ПОВЕРНУТЬ КАРТИНКУ");
       //    return;
       //}

        // открыть в "План по дням" поп-ап с фото-архивом из "Галереи"
        if (elem.hasClass('choose-img')) {
            galleryObject.openImgBox(elem);
            return;
        }
        // удалить img для переданного дня и очистить скрытый инпут
        if (elem.hasClass('delete-clone')) {
            galleryObject.uncheckDayImg(elem);
            return;
        }
        // алгоритм поведения чекбоксов для поля "Питание"
        if (elem.attr('id').indexOf('meal') > -1) {
            tourTypeObject.getMealType(elem);
            return;
        }
        // алгоритм поведения чекбоксов для поля "Трансфер"
        if (elem.attr('id').indexOf('transfer') > -1) {
            tourTypeObject.getTransferType(elem);
            return;
        }
    },

    // ловит события изменения полей формы для страницы "2.План по дням", определяет и запускает событие для переданного элемента
    dayFormOnchangeActions(elem) {

        // для select "Размещение": действие необходимо для переноса option:selected при клонировании (не прерывает текущий скрипт)
        if (elem.hasClass('text')) {
            let option = (elem.find(':selected'));
            if (option.attr('value') === '') {
                option.attr('selected', false);
            }
            option.attr('selected', true);
        }

        // для родительских select "Ночевка - Страна" и "Размещение - Тип жилья"
        if (elem.hasClass(geoObject.domEl.dayCountryClassName) || elem.hasClass(this.domEl.accommodationTypeClassName)) {
            this.daySelectChildSettings(elem);
            return;
        }

        // для поля ввода города
        if (elem.hasClass('ui-autocomplete-input')){
            cityChange.cityCheckSelected(elem);
            return;
        }

        // для input "Трансфер:Расстояние"
        if(elem.is('input[type=number]')){
            elem.val(oftenUsed.negativeToPositive(elem.val())); // проверка переданного числа на отрицательное
        }
    },

    // ловит события фокусировки на полях формы для страницы "2.План по дням", определяет и запускает событие для переданного элемента
    dayFormFocusinActions(elem, tag){
        // для поля ввода города
        if (elem.hasClass('ui-autocomplete-input')){
            cityChange.cityFocus(elem);
            return;
        }
        // для поля ввода информации о программе
        if (elem.is('textarea')) {
            commonActions.textareaFullSize(elem, tag);
        }
    },

    // проверка при добавлении нового дня в раздел "2.План по дням". Если кол-во дней в "1.Описание" меньше - вернет false
    checkDaysAmount() {

        this.getDaysAmount();

        if (this.daysAmount <= this.daysCount) {
            oftenUsed.dialogMessageCall('Добавлено максимальное количество дней, указанных в&nbsp;описании!<br><br>' +
                'Измени длительность программы в&nbsp;разделе "1.&nbsp;ОПИСАНИЕ"<br><br>' +
                'Или удали лишние дни в&nbsp;разделе "2.&nbsp;ПЛАН&nbsp;ПО&nbsp;ДНЯМ"');
            return false;
        }
    },

    // определяет поведение элементов при клике по локеру (в первом дне)
    // 1. Проверяет поля на заполненность (если не заполнены, прерывает event
    // 2. Проверяет :checked значение чекбокса и в зависимости от значения запускает соотвествующие скрипты
    // 3. Сохраняет в переменную информацию о включенных локерах
    lockerAction(event, elem) {
        // получить название локера
        let trigger = (elem.attr('id')).slice(4);

        // если действие на установку локера, то сначала проверяет заполненность поля, переданного на блокировку
        if (elem.prop('checked')) {
            if (this.checkLockerValue(event, elem, trigger) === false) {
                return;
            }
        };

        // после успешной проверки на пустые значения:
        let fieldClass = '.' + trigger; // преобразовать триггер в имя класса
        let allFields = this.domEl.planByDays.find(fieldClass);  // найти в "План по дням" все элементы с полученным классом
        let lockerName = this.getLockerName(trigger); // получить имя триггера

        // если действие на снятие локера (not:checked), запуск скрипта восстановления значений полей по умолчанию
        if (elem.prop('checked') === false) {
            this.confirmUnlockAction(elem, fieldClass, allFields, lockerName);
            return;
        } else {  // если действие на установку локера (:checked), запуск скрипта на блокировку выбранных полей
            this.confirmLockAction(elem, trigger, allFields, lockerName);
            return;
        }
    },

    // проверяет заполненность поля, переданного на блокировку
    checkLockerValue(event, elem, trigger){
        // проверка на заполненность полей НОЧЕВКА и РАЗМЕЩЕНИЕ
        if (trigger === this.geoTrigger || trigger === this.accommodationTrigger) {
            if (elem.parent().siblings('.'+this.domEl.dayTextClassName).find('option:selected:disabled').val() === '') {
                this.alertCall(event);
                return false;
            }
        }
        // проверка на заполненность полей формы ПИТАНИЕ и ТРАНСФЕР
        if (trigger === this.mealTrigger || trigger === this.transferTrigger) {
            if (elem.parent().siblings('.'+this.domEl.dayTextClassName).find('.text').hasClass('default') === true) {
                this.alertCall(event);
                return false;
            }
        }
        return true;
    },

    // если значение в локере не задано, выводит сообщение (alert) и прерывает событие
    alertCall(event) {
        oftenUsed.dialogMessageCall('Поле не заполнено');
        event.preventDefault();
        event.stopPropagation();
    },

    // получить название запущенного локера по триггеру
    getLockerName(trigger){

        let name;
        if (trigger.indexOf(this.geoTrigger) > -1){
            name = this.geoName;
        } else if (trigger.indexOf(this.accommodationTrigger) > -1) {
            name = this.accommodationName;
        } else if ((trigger.indexOf(this.mealTrigger) > -1)) {
            name = this.mealName;
        } else if ((trigger.indexOf(this.transferTrigger) > -1)) {
            name = this.transferName;
        }

        return name;
    },

    // запрос на полтверждения на добавление локера
    confirmLockAction(elem, trigger, allFields, lockerName){
        console.log("подтверждение на добавление локера");

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Включить <b>Автозаполнение</b> для поля <b>' + lockerName +'</b>?',  //'Включить опцию "Автозаполнение и блокировка" для поля для?"   '<br>Выбранные ранее значения будут сброшены.' + '<br>.'
            content: 'Выбранное значение будет добавлено ко всем дням программы.' +
                '<br>Ранее сохраненные изменения будут удалены.',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Включить",
                    btnClass: 'btn-blue',
                    action: function(){
                        daysObject.switchAction(elem, trigger, allFields);
                        daysObject.updateLockersArr();
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    action: function(){
                        elem.prop('checked', false);
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // запрос на подтверждения на снятие локера
    confirmUnlockAction(elem, fieldClass, allFields, lockerName){
        console.log("подтверждение на снятие локера");

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Отключить <b>Автозаполнение</b> для <b>' + lockerName +'</b>?',
            content: '',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Отключить",
                    btnClass: 'btn-blue',
                    action: function(){
                        daysObject.unlockAction(fieldClass, allFields);
                        daysObject.updateLockersArr();
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    action: function(){
                        elem.prop('checked', true);
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // определяет действие для выбранного локера
    switchAction(elem, trigger, domArr) {
        //console.log("добавление локера: 4-й скрипт");

        switch (trigger) {
            case this.geoTrigger:
                this.geoLockAction(elem, domArr);
                break;
            case this.accommodationTrigger:
                this.accommodationLockAction(elem, domArr);
                break;
            case this.mealTrigger:
                this.mealLockAction(elem, domArr);
                break;
            case this.transferTrigger:
                this.transferLockAction(elem, domArr);
                break;
        }
    },

    // блокировка поля НОЧЕВКА
    geoLockAction(locker, domArr) {
        // получает и сохраняет в текстовом формате значение: "Страна" или "Страна, Город"
        let locketText = locker.parent().siblings('.'+this.domEl.dayTextClassName).find('option:selected').text();
        let cityVal = locker.parent().siblings('.'+this.domEl.dayTextClassName).find('input[type=text]').val();
        if(cityVal !== ""){
            locketText += ', ' + cityVal;
        }
        // проверка для добавленного дня: новый элемент не видит селекта, если поле было залочено
        if (locketText !== '') {
            this.geoLock = '<div class="group text text-lock">' + locketText + '</div>';
        }
        // передает выбранное значение каждому элементу с аналогичным классом
        $.each(domArr, function () {
            daysObject.changeLockerElem($(this), daysObject.geoLock);
        });
    },

    // блокировка поля РАЗМЕЩЕНИЕ
    accommodationLockAction(locker, domArr) {
        // получает и сохраняет в текстовом формате значение: "Тип размещения", тип номера: "Вместимость номера"
        let elem = locker.parent().siblings('.'+this.domEl.dayTextClassName).find('.'+daysObject.domEl.accommodationTypeClassName);
        let locketText = '<span class="default">тип жилья:&nbsp;</span>' + elem.find('option:selected').text();
        locketText += '<span class="default">&nbsp;/&nbsp;</span><span class="default">вместимость номера:&nbsp;</span>'+elem.parent().siblings().find('option:selected').text()


        // проверка для добавленного дня: новый элемент не видит селекта, если поле было залочено
        if (locketText !== '') {
            this.accommodationLock = '<div class="group text text-lock">' + locketText + '</div>';
        }
        // передает выбранное значение каждому элементу с аналогичным классом
        $.each(domArr, function () {
            daysObject.changeLockerElem($(this), daysObject.accommodationLock);
        });
    },

    // блокировка поля ПИТАНИЕ
    mealLockAction(locker, domArr) {
        // получает и сохраняет выбранное значение в текстовом формате
        let locketText = locker.parent().siblings('.'+this.domEl.dayTextClassName).find('.text').html();
        this.mealLock = '<div class="group text text-lock">' + locketText + '</div>';
        // передает выбранное значение каждому элементу с аналогичным классом
        $.each(domArr, function () {
            daysObject.changeLockerElem($(this), daysObject.mealLock);
        });
    },

    // блокировка поля ТРАНСФЕР
    transferLockAction(locker, domArr) {
        // получает и сохраняет выбранное значение в текстовом формате
        let locketText = locker.parent().siblings('.'+this.domEl.dayTextClassName).find('.text').html();
        this.transferLock = '<div class="group text text-lock">' + locketText + '</div>';
        // передает выбранное значение каждому элементу с аналогичным классом
        $.each(domArr, function () {
            daysObject.changeLockerElem($(this), daysObject.transferLock);
            $(this).children().find('.'+tourTypeObject.transferDistanceClass+' input').val(''); // очистить значения input для .distance-box
        });
    },

    // 1. находит элементы, которым необходимо восстановить значения по умолчанию
    // 2. добавляет в элменты значения по умолчанию из шаблона "День 0" (domEl.dayTemplate)
    // 3. запускает скрипт обновления значений айдишников для восстановленных полей
    unlockAction(className, domArr) {
        //console.log("снятие локера: 4-й скрипт");

        let box = $('#day-1').find(className).clone();
        box.find('.text-lock').remove(); // удалить .text-lock с дефолтным текстом
        box.children().removeAttr('style'); // показать блок, скрытый ранее через js css(display:block)
        //let box = this.domEl.dayTemplate.find(className).clone();
        let qty = 1;

        $.each(domArr, function () {
            // копирует в элемент значения из шаблона dayTemplate
            daysObject.changeLockerElem($(this), box.html());
            // меняет значения атрибутов (id, name, for) в скопированном элементе: задает порядковый номер дня из счетчика
            daysObject.changeAttr($(this).find('select'), qty);
            daysObject.changeAttr($(this).find('input[type=text]'), qty);
            daysObject.changeAttr($(this).find('input[type=hidden]'), qty);
            daysObject.changeAttr($(this).find('.checkbox-block'), qty);
            daysObject.changeAttr($(this).find('input:checkbox'), qty);
            daysObject.changeAttr($(this).find('input[type=number]'), qty);
            daysObject.changeAttr($(this).find('label'), qty);
            qty += 1
        });
    },

    // получает элемент, параметр для вставки, значение : обновляет содержимое элмента и переключает иконку локера
    changeLockerElem(elem, box) {
        // переключить иконку "залочен" и выполнить проверку на наличие в элементе чекбокса
        (elem.siblings('.' + this.domEl.lockerClassName).toggleClass(this.domEl.lockedClass).children().is('input'))
            ? this.firstDayLockerAction(elem, box) // если repeat-4-all содержит input,значит на изменение передан первый день и нужно уточнить действие
            : $(elem).empty().append(box); // если передан любой другой день - очистить контейнер и вставить в него переданный элемент
    },

    // обновить и сохранить информацию об отмеченных локерах
    updateLockersArr() {
        this.lockersArr = $('#day-1 .' + this.domEl.lockerClassName + ' input:checked'); //проверить отмеченные чекбоксы в 1-м дне
    },

    // действия для первого дня, содержащего чекбоксы с локерами
    firstDayLockerAction(elem, box){
        // переключить иконку "разлочен" для первого дня
        // если локер включен ? скрыть потомков elem (чтобы передать значения инпутов) и добавить box : иначе очистить elem и вставить box
        (elem.siblings('.' + this.domEl.lockerClassName).toggleClass(this.domEl.unlockedClass).children('input').prop('checked'))
            ? $(elem).children().css('display', 'none').parent().append(box)
            : $(elem).empty().append(box);
    },

    // добавить строку (input) в список для ЛОКАЦИИ\АКТИВНОСТИ
    dayAddInput(elem) {
        // счетчик: кол-во существующих строк + 1(новая, которую хотим добавить)
        let count = elem.parents().eq(2).find('input').length + 1;
        // если счетчик + 1 превышает лимит, то выведет алерт и завершит скрипт
        if (count >= 6) {
            oftenUsed.dialogMessageCall('Добавлено максимальное количество строк');
            //alert('Превышено допустимое количество строк в списке!');
        } else {
            // клонирует эталон, меняет класс "+" (добавить) на "-" (удалить), очищает у клона значение "value"
            let clone = elem.parent().clone().addClass('dashed-line');
            clone.children('span').addClass('delete-elem').removeClass('add-elem').siblings('input').val('');
            // обновляет в input имена атрибутов id и name
            this.newCountAttr(clone.children('input'), count);
            // добавляет элемент в html
            elem.parent().closest('.program-form__text').append(clone);
        }
    },

    // удалить строку (input) из списка ЛОКАЦИИ\АКТИВНОСТИ
    dayDeleteInput(elem) {

        let count = 1; // счетчик существующих строк (для цикла переименования)

        $.each(elem.parent().siblings().find('input'), function () { //для каждой строки в списке
            // если id элемента не равно id 'элемента, который хотим удалить, то переименовать в input имена атрибутов id и name
            if ($(this).attr('id') !== elem.closest('input').attr('id')) {
                daysObject.newCountAttr($(this), count);
                count += 1;
            }
        });
        elem.parent().remove();
    },

    // в переданном input в именах атрибутов id и name меняет окончание значения на переданное число (count)
    newCountAttr(elem, count) {

        elem.attr('id', function (i, val) {
            return val.slice(0, -1) + count;
        });
        elem.attr('name', function (i, val) {
            return val.slice(0, -3) + "[" + count + "]";
        });
    },

    // орпеделяет какую кнопку нажали: "Создать новый день" или "Копировать день" и запускает скрипт на создание
    addNewDay(elem) {
        // если количество дней в "Описании" ниже, чем кол-во созданных в "План по дням" дней, прервет функцию
        if (this.checkDaysAmount() === false) {
            return
        }

        let newDay = null; // переменная нового дня
        this.daysCount += 1;  // прибавляет к счетчику новый день

        // если функция пришла с пустой property, значит нажали кнопку "Добавить день", иначе - нажали кнопку "Копировать день"
        if (elem === undefined) {
            // клонировать новый день из сохраненного шаблона
            newDay = this.renewDayInfo(this.domEl.dayTemplate.clone().removeClass('hide-element'), this.daysCount);

            //$(newDay).find('.'+geoObject.domEl.dayCountryClassName+' option:disabled').prop('selected', true); // дефолтный option для старны
            $(newDay).find('.'+daysObject.domEl.accommodationClassName+' option:disabled').prop('selected', true); // дефолтный option для тип размещения
            this.daySelectChildSettings($(newDay).find('.'+geoObject.domEl.dayCountryClassName)); // скрыть поле выбора города
            this.daySelectChildSettings($(newDay).find('.'+this.domEl.accommodationTypeClassName)); // скрыть поле выбора "Вместимость жилья"

            // проверка наличия локеров. если локеры есть - добавляет данные в соответствующие поля элемента
            if (this.lockersArr.length > 0) {
                $.each(this.lockersArr, function () {
                    let trigger = ($(this).attr('id')).slice(4); // получить триггер локера
                    //let allFields = daysObject.domEl.planByDays.find('.' + trigger);  // найти в "План по дням" все элементы с полученным классом
                    daysObject.switchAction($(this), trigger, $(newDay).find('.' + trigger));  // выбор блокирующего действия в зависимости от переданного триггера
                });
            }

        } else {   //если функция передала в параметр DOM-элемент, значит нажали кнопку "Копировать"
            // копировать переданный день, обновить id и атрибуты форм
            newDay = this.renewDayInfo(elem.clone(), this.daysCount);

            // очистить поле формы "ФОТО ДНЯ"
            newDay.find('.'+galleryObject.dayImgBoxClassName).empty().siblings('input').val('')  // удалить img и очистить input val
                .siblings('.'+this.domEl.dayTextClassName).children().css('display', 'block'); // показать кнопку выбора img

            // если скопированный день содержит заполненное поле Страна, запсутить принудительное обновление содержимого поля для нового дня
            if (elem.find('.'+geoObject.domEl.dayPlaceClassName+' option:selected').val() !== ''){
                let val = elem.find('.'+geoObject.domEl.dayPlaceClassName+' option:selected').val();  // получить выбранное значение из оригинала
                newDay.find('.'+geoObject.domEl.dayPlaceClassName+' option[value="'+ val+ '"]').prop('selected', true);  // принудительно назначить для копии выбранную страну
                // иначе при динамическом добавлении элементов в день оригинал в копию будут переданы загруженные, а не выбранные значения!)
            }
        }

        newDay.insertBefore('#add-day'); // добавить новый день в #plan-by-days
        this.lastDaySettings();
        oftenUsed.scrollToBottom(newDay, 450); // плавная прокрутка содержимого #plan-by-days до созданного элемента
    },

    // удаление дня (elem - переданный .day-box)
    deleteDay(elem) {

        this.daysCount -= 1;
        // настройки анимации для удаления элемента
        elem.animate({
            height: 'toggle',
            opacity: 0
        }, 600, function () { // действия после анимации
            // удалить выбранный элемент
            elem.remove();
            // обновить значения атрибутов (id, name, for) для оставшихся дней
            let qty = 1;
            $.each($('#' + daysObject.domEl.planByDays.attr('id') + ' .' + daysObject.domEl.dayClassName), function () {
                daysObject.renewDayInfo($(this), qty);
                qty += 1;
            });
        });

        this.lastDaySettings();
    },

    // обновить значения атрибутов (id, name, for) для переданного дня (.day-box)
    renewDayInfo(dayBox, count) {
        // добавляет номер дня и присваивает id новому элементу по значению счетчика дней
        dayBox.find('.day-title span').text(count + ' день');
        dayBox.attr({'id': 'day-' + count, 'data-day': count});
        // меняет значения атрибутов (id, name, for) в скопированном элементе: задает порядковый номер дня из счетчика
        this.changeAttr(dayBox.find('select'), count);
        this.changeAttr(dayBox.find('input'), count);
        this.changeAttr(dayBox.find('label'), count);
        this.changeAttr(dayBox.find('textarea'), count);
        this.changeAttr(dayBox.find('.checkbox-block'), count);
        //this.changeAttr(dayBox.find('.checked-img'), count);
        this.changeAttr(dayBox.find('.'+galleryObject.dayImgBoxClassName), count);
        return dayBox;
    },

    // проверяет в массиве элементов наличие атрибутов id, name, for и запускает скрипт замены значения
    changeAttr(domArr, count) {

        $.each(domArr, function () {
            if (this.hasAttribute('id') === true) {
                daysObject.dayAttrRename($(this), 'id', count);
            }
            if (this.hasAttribute('name') === true) {
                daysObject.dayAttrRenameName($(this), 'name', count);
            }
            if (this.hasAttribute('for') === true) {
                daysObject.dayAttrRename($(this), 'for', count);
            }
        });
    },

    // заменяет значение переданного атрибута по шаблону "d" + "порядковый номер дня" + "значение атрибута(-3 знака)")
    dayAttrRename(elem, attr, count) {

        let newName = "d0" + count;

        if (count >= 10) {
            newName = "d" + count;
        }
        elem.attr(attr, function (i, val) {
            return newName + val.slice(3);
        });
    },

    // заменяет значение переданного name-атрибута по шаблону "d[" + "порядковый номер дня" + "]значение атрибута(-3 знака)")
    dayAttrRenameName(elem, attr, count) {

        let newName = "d[0" + count;

        if (count >= 10) {
            newName = "d[" + count;
        }

        elem.attr(attr, function (i, val) {
            return newName + val.slice(4);
        });
    },

    // свернуть-развернуть содержимое блока ДЕНЬ в plan-by-days при клике по шапке элемента
    dayToggleBox(elem) {

        elem.toggleClass('closed opened').parent().toggleClass('opened').siblings('.day-cover').fadeToggle(50, "linear");
        elem.closest('.' + this.domEl.dayClassName).toggleClass('closed opened');
    },

    // запрос на подтверждение действия "Копировать День"
    confirmCloneAction(elem){

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Создать копию выбранного дня?',
            content: 'Скопированный день будет добавлен в конец программы',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Копировать",
                    btnClass: 'btn-blue',
                    action: function(){
                        daysObject.addNewDay(elem);
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){}
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // запрос на подтверждение действия "Удалить День"
    confirmDeleteDayAction(elem){

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Удалить выбранный день из программы?',
            content: 'После удаления нумерация всех последующих дней изменится на&nbsp;+1',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Удалить",
                    btnClass: 'btn-blue',
                    action: function(){
                        daysObject.deleteDay(elem);
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){ }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // запрос на подтверждение удаления строки из списков ЛОКАЦИЯ \ АКТИВНОСТЬ
    confirmInputRemove(elem){

        // если input пустой, удалить блок без запроса на подтверждение
        if (elem.siblings('input').val() === "") {
            daysObject.dayDeleteInput(elem);
            return;
        }

        let inputName; // если input не пустой, то определить название строки и вывести запрос на подтверждение
        (elem.siblings('input').attr('id').indexOf('point') > -1) ? inputName = 'Локацию' : inputName = 'Активность';

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Удалить ' + inputName + '?',
            content: 'В строке есть несохраненный текст',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Удалить",
                    btnClass: 'btn-blue',
                    action: function(){
                        daysObject.dayDeleteInput(elem);
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){ }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },
};

const galleryObject = {

    planByDaysId: 'plan-by-days',

    mainImgBox: $('#program_photos'),
    mapImgBox: $('#program_photos_map'),
    imgArchiveBox: $('#program_photos_archive'),
    imgCoverClassName: 'program-form__image-result',
    imgBoxClassName: 'image-result__delete',

    imgArchiveLimit: 28,
    imgUploaded: 0,
    hiddenImgBox: $('#choose-img'),  // скрытый pop-up для вызова ФОТО-АРХИВА из ГАЛЕРЕИ
    imgBox: $('#img-archive-box'),  // id блока ФОТО-АРХИВ в ГАЛЕРЕЕ (для миграции элементов из ГАЛЕРЕИ в ПЛАН ПО ДНЯМ)
    imgBlock: $('#img-archive-block'), // id блока ВЫБРАТЬ ФОТО в ПЛАН ПО ДНЯМ (для миграции элементов ПЛАН ПО ДНЯМ в ГАЛЕРЕЮ)
    checkedImgArr: [],

    dayImgBoxClassName: 'checked-img', // бокс для добавления выбранного из ФОТО-АРХИВА фото в ДЕНЬ
    turnClassName: 'turn-img', // бокс для добавления выбранного из ФОТО-АРХИВА фото в ДЕНЬ
    checkClassName: 'check-img',  // имя класса с иконкой "V" (выбрать фото)
    deleteClassName: 'delete-clone', // имя класса с иконкой "Х" (удалить фото)
    imgName: 'data-img-name', // data-атрибут с именем картинки
    blurImgClass: 'blur-img', // класс для затуманивания изображения
    checkedImgBox: undefined, // после вызова блока "ВЫБРАТЬ ИЗ ГАЛЕРЕИ" хранит место в HTML для вставки выбранного из ФОТО-АРХИВА фото

    videoLimit: 3,
    videoBlock: $('#program-form-edit-gallery'),
    addVideoBtn: $('#add-video'),
    videoBoxTemplate: $('#video-box-template'),
    videoBoxClass: 'video-box',
    playerBoxClass: 'ytPlay',
    videoIdArr: [],

//информация о количестве сохраненных фото: <div class="program-form__image-result" id="program_photos_archive" data-img-qty="">
//информация об именах картинок в План-по-дням: <div id="choose-img" " data-checked-img="">


    // при загрузке проверяет сохраненные значения и определяет действия
    galleryCheck(){

        // для 'ЗАГЛАВНОЕ ФОТО' и 'КАРТА МАРШРУТА' - скрыть кнопку "Добавить фото", если фото уже загружена
        if(this.mainImgBox.find('.'+this.imgBoxClassName).children().hasClass(this.deleteClassName)){
            this.mainImgBox.siblings().addClass('hidden');
        }
        if(this.mapImgBox.find('.'+this.imgBoxClassName).children().hasClass(this.deleteClassName)){
            this.mapImgBox.siblings().addClass('hidden');
        }

        // получить информацию о кол-ве загруженных фото
        this.updateImgCounter();

        // получить все картинки, сохраненные в ПЛАН ПО ДНЯМ
        $.each($('#'+this.planByDaysId+' .'+this.dayImgBoxClassName+' img'), function () {
            // добавить имя картинки в массив с именами сохраненных картинок из ПЛАН ПО ДНЯМ
            galleryObject.checkedImgArr.push($(this).attr(galleryObject.imgName));
            // скрыть кнопку "Выбрать из Галереи"
            $(this).parent().siblings('.'+daysObject.domEl.dayTextClassName).children().css('display', 'none');
        });

        // проверить наличие ссылок на видео-ролики в ГАЛЕРЕЯ. Если есть - отрисовать контенер с видео, если нет - скрыть кнопку "Добавить видео"
        $.each(this.videoBlock.find('input[type="hidden"]'), function () {
            let id = $(this).val();
            (id!=="")
                ? galleryObject.addVideoFrame($(this).siblings('input[type="url"]'),id)
                : galleryObject.addVideoBtn.addClass('hide-element');
        });
    },

    // обновить информацию о загруженных фото в Галерее
    updateImgCounter(){
        this.imgUploaded = parseInt(this.imgArchiveBox.find('img').length);
        $('#img-archive-counter span.blue').text(this.imgUploaded);
        $('#img-archive-counter span.grey').text(this.imgArchiveLimit);
    },

    uploadImgArchive(elem, event) {
        let imgIconClass = this.defineImgIconClass(elem, event); // определить класс для рендера иконки

        ajaxObject.uploadPhotoArchive(event, $('#form_upload_archive_photo'), this.imgArchiveBox, imgIconClass,
            $('#block_error_upload_archive_photo'));
    },

    // определить родительский блок, вызваший загрузку фото (План по Дням или Галерея)
    // в зависимости от значения родителя передать класс иконки к загружаемому изображению
    defineImgIconClass(elem){
        // если открыт контейнер в блоке ПЛАН ПО ДНЯМ, то передать класс (V), иначе (Х)
        if (!this.hiddenImgBox.hasClass('hide-element')) {
            return this.checkClassName;
        } else {
            return this.deleteClassName;
        }
    },

    // действия при клике по "ВЫБРАТЬ ИЗ ГАЛЕРЕИ" в ПЛАН ПО ДНЯМ
    openImgBox(elem) {

        this.checkedImgBox = elem.parent().siblings('.' + this.dayImgBoxClassName); // найти и запомнить место в HTML для вставки выбранного фото
        this.imgBlock.children().appendTo(this.imgBox); // перенести в DOM-дереве элементы из ГАЛЕРЕЯ/ФОТО-АРХИВ в ПЛАН ПО ДНЯМ/ВЫБРАТЬ ФОТО
        this.toggleImgActions(this.checkClassName, this.deleteClassName, null); // заменить иконки действия для Фото: с "Х" на "V"

        if (this.checkedImgArr.length > 0) { // если в ПЛАН ПО ДНЯМ есть сохраненные img
            this.findCheckedImg(); // найти выбранные фото и исключить повторный выбор
        }

        this.hiddenImgBox.removeClass('hide-element').find('.block-title') // открыть бокс "ВЫБАРТЬ ФОТО" и добавить в заголовок информацию о дне,откуда был вызван бокс
            .text("ДЕНЬ №" + elem.closest('.' + daysObject.domEl.dayClassName).attr('data-day')); // добавить номер дня в заголовок всплывающего окна
        oftenUsed.bodyFix($('body')); // запретить прокрутку содержимого за пределами открытого окна
    },

    // скрыть иконку "V" (выбрать) для фото, выбранных в ПЛАН ПО ДНЯМ ранее
    findCheckedImg(){

        $.each(this.hiddenImgBox.find('img'), function () {
            for (let i = 0; galleryObject.checkedImgArr.length > i; i++) {
                if ($(this).attr(galleryObject.imgName) === galleryObject.checkedImgArr[i]) {
                    $(this).addClass(galleryObject.blurImgClass)
                        .siblings('span').addClass('hidden');
                }
            }
        });
    },

    // после открытия блока "ВЫБРАТЬ ФОТО" определяет действия с ФОТО-АРИХВОМ при клике по элементам внутри
    switchAction(elem) {
        // если клик по "закрыть окно", запуск функции ЗАКРЫТИЯ
        if (elem.hasClass('close-pop-up')) {
            this.closeImgBox();
        }
        // если клик по иконке "V", копирует выбранное фото в ПЛАН ПО ДНЯМ и добавляет иконку "Х"
        if (elem.hasClass(this.checkClassName)) {
            this.checkedImgBox.empty(); // очистить контейнер для картинки
            this.checkedImgBox.append("<span class=" + this.deleteClassName + "></span>"); // добавить в контейнер иконку Х (удалить)
            elem.siblings('img').clone().appendTo(this.checkedImgBox); // клонировать в контейнер выбранное изображение

            // показать кнопку "Выбрать из Галереи"
            console.log(this.checkedImgBox.siblings('.'+daysObject.domEl.dayTextClassName).children().css('display', 'none'));

            let name = this.checkedImgBox.children('img').attr(this.imgName); // получить имя картинки
            this.checkedImgBox.siblings('input').val(name); // добавить в сркытый инпут (в "value") имя картинки
            this.checkedImgArr.push(name); // добавить имя картинки в массив сохраненных имен для ПЛАН ПО ДНЯМ
            this.closeImgBox();
        }
    },

    // скрывает бокс ВЫБРАТЬ ФОТО и возвращает в исходное состояние измененные при вызове элементы внутри бокса
    closeImgBox() {
        oftenUsed.bodyScroll($('body')); // отменить запрет на прокрутку содержимого за пределами открытого окна
        // скрыть поп-ап с выбором картинки в ПЛАН ПО ДНЯМ
        this.hiddenImgBox.addClass('hide-element');
        // для Фото: заменить иконки действия с "V" на "Х", удаить класс прозрачности картинки, добавить класс "Поврот"
        this.toggleImgActions(this.deleteClassName, this.checkClassName, this.blurImgClass, this.turnClassName);
        // вернуть бокс с фото-архивом в Галерею
        this.imgBox.children().appendTo(this.imgBlock);
    },

    // ФОТО-АРХИВ: скрипт для смены иконок "V" - "Х" к img и обнуления прозрачности
    toggleImgActions(add, remove, opacity, turn) {

        $.each(this.imgBox.find('img').parent(), function () {
            $(this).children('.' + remove).remove();
            $("<span></span>").prependTo(this).addClass(turn);
            $("<span></span>").prependTo(this).addClass(add);
            if (opacity !== null) {
                $(this).children('img').removeClass(opacity);
            }
        });
    },

    // проверка на принадлежность картинки на удаление к блоку "План по дням". Если есть связь, запросит подтверждение на удаление
    checkImgBeforeDelete(elem){
        // + проверить откуда был вызов (главное \ карта \ галерея);
        // если Галерея, то проверить фото на закрепление к дням
        // если да - вывети запрос на удалене
        console.log('проверяем родителя картинки');
        let id = elem.parents('.program-form__image-result').attr('id'); // получить id бокса-родителя (главная, карта, архив)
        let name = elem.siblings('img').attr(this.imgName);  // получить имя картинки

        // если картинка относится к фото-архиву и привязана в План по дням ко Дню
        if (~id.indexOf('archive') && $.inArray(name, this.checkedImgArr) > -1){
            console.log('фото связано с План по дням');
            console.log(this.checkedImgArr);
            this.confirmImageDelete(elem, name); // запрос на подтверждение удаления картинки
        } else {
            console.log('фото не связано с План по дням');
            ajaxObject.deleteGalleryImg(elem);  // ajax запрос на удаление
        }

    },

    // запрос на подтверждение действия "удалить изображение" в Галерее
    confirmImageDelete(elem){

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Фото привязано к программе дня',
            content: 'Удалить фото из разделов "Галерея" и "План по дням"?',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Удалить",
                    btnClass: 'btn-blue',
                    action: function(){
                        galleryObject.uncheckDayImg(elem); // удалить из План по дням
                        ajaxObject.deleteGalleryImg(elem); //  удалить из Галереи
                    }},
                no: {
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){ }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // удлаить фото из Дня в ПЛАН ПО ДНЯМ и обновить массив привязанных к Дням картинок
    uncheckDayImg(elem){
        console.log('удаляем фото из План по дням');

        let name = elem.siblings('img').attr(this.imgName);  // получить имя файла
        let attr = 'img[' + this.imgName + '="' + name + '"]'; // создать запрос на поиск по атрибуту имени

        // найти в ПЛАН ПО ДНЯМ элемент с атрибутом картинки на удаление
        $('#' + this.planByDaysId + ' .' + this.dayImgBoxClassName)
            .find(attr).parent().empty().siblings('input[type=hidden]').attr('value', '') // удалить img, почистить input
            .siblings('.'+daysObject.domEl.dayTextClassName).children().css('display', 'block'); // показать кнопку "Выбрать из Галереи"

        // удалить имя картинки из массива сохраненных имен
        this.checkedImgArr.splice($.inArray(name, this.checkedImgArr), 1);

        console.log( this.checkedImgArr);
    },

    // проверка изменений в поле "ссылка на видео с youtube"
    checkVideoLink(){
        //(elem.val() === '')
        //    ? this.clearVideoBox(elem.parent()) // если значение нулевое, очистить контейнер с видео
        //    : this.checkYoutubeLink(elem); // если иное, то запустить проверку ссылки
    },

    // проверка переданной ссылки
    checkYoutubeLink(link){
        //проверить ссылку на принадлежность к youtube-видео c помощью regEx'
        let regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        /* These are the types of URLs-check are supported
           http://www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index
           http://www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/QdK8U-VIH_o
           http://www.youtube.com/v/0zM3nApSvMg?fs=1&amp;hl=en_US&amp;rel=0
           http://www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s
           http://www.youtube.com/embed/0zM3nApSvMg?rel=0
           http://www.youtube.com/watch?v=0zM3nApSvMg
           http://youtu.be/0zM3nApSvMg
        */
        let match = link.val().match(regExp); // сохранить результат проверки

        if (match && match[7].length === 11) { // если ссылка от youtube и содержит video-id, то
            // проверить на дубли
            let string = this.checkVideoDuplicate(match[7]);
            // если дубликат - очистить, иначе - добавить
            (string !== null) ? this.addVideoFrame(link, string) : this.clearVideoBox(link.parent());

            this.addVideoBtn.removeClass('hide-element'); // показать кнопку "добавить еще видео"
        } else {
            oftenUsed.dialogMessageCall('Некорректная ссылка на видео с youtube.com');
            //alert('Некорректная ссылка на видео с youtube'); // иначе вывести сообщение об ошибке
            this.clearVideoBox(link.parent()); // очистить бокс для видео
        }
    },

    // сверяет полученный video-id с сохраненными ранее значениями
    checkVideoDuplicate(string){
        $.each(this.videoBlock.find('input[type="hidden"]'), function () {
            if (string === $(this).val()) {
                oftenUsed.dialogMessageCall('Видео уже добавлено в "Галерею"');
                string = null; // если дубликат, то вернет null
            }
        });
        return string;
    },

    // рендер контейнера с iframe youtube-видео
    addVideoFrame(elem, videoId){

        //elem.siblings('input[type="url"]').addClass('hide-element'); // скрыть форму для ввода ссылки
        elem.addClass('hide-element'); // скрыть форму для ввода ссылки
        elem.siblings('input[type="hidden"]').val(videoId); // передать имя видео в скрытый инпут

        let frame = '<div><iframe width="300" height="180" src="https://www.youtube.com/embed/'
            + videoId + '?controls=0&fs=0" frameborder="0"></iframe></div>'; // создать фрейм и добавить в него ID видео
        elem.siblings('.'+this.playerBoxClass).empty().append(frame); // очистить контейнер для видео и добавить в него фрейм
        elem.siblings('.'+this.playerBoxClass).prepend('<span class="delete-clone"></span>'); // очистить контейнер для видео и добавить в него фрейм

        this.addVideoBtn.removeClass('hide-element'); // показать кнопку "добавить еще видео"
    },

    // удалить видео из галереи и очистить все значения инпутов
    clearVideoBox(elem){

        elem.remove();

        let qty = 1;

        if($('.'+this.videoBoxClass).length > 0){
            $.each(this.videoBlock.find('.'+this.videoBoxClass), function(){
                $(this).children('input[type="url"]').attr('name', 'gallery[video]['+qty+'][url]');
                $(this).children('input[type="hidden"]').attr('name', 'gallery[video]['+qty+'][video]');
                qty += 1;
            });
        } else {
            let videoBox = this.videoBoxTemplate.clone(); // создать из шаблона новый .video-box
            videoBox.removeAttr('id').addClass(this.videoBoxClass).removeClass('hide-element');
            this.videoBlock.append(videoBox);
            this.addVideoBtn.addClass('hide-element'); // скрыть кнопку "добавить еще видео"
        }

        //elem.children('.'+this.playerBoxClass).empty(); // очистить контейнер для видео
        //elem.children('input').attr('value', '').val('').removeClass('hide-element'); // очистить инпуты для значений ссылка и ID видео
        //this.addVideoBtn.addClass('hide-element'); // скрыть кнопку "добавить еще видео"
    },

    // добавить еще одно поле формы для сохранения дополнительного видео
    addVideoBox(){

        if ($('.'+this.videoBoxClass).length < this.videoLimit){

            let newVideo = this.videoBlock.children('.'+this.videoBoxClass).last().clone();

            $.each(newVideo.children('input'), function () {
                let attrName = $(this).attr('name');
                $(this).val('').attr('name', galleryObject.getAttrName(attrName)).removeClass('hide-element');
            });

            newVideo.children('.'+this.playerBoxClass).empty();

            this.videoBlock.append(newVideo);

            this.addVideoBtn.addClass('hide-element'); // скрыть кнопку "добавить еще видео"
        } else {
            oftenUsed.dialogMessageCall('Добавлено максимальное количество видео');
        }
    },

    // присвоить новые имена input-ам для добавленного .video-box (+1)
    getAttrName(name){
        let regExp = /^(.*\[.*\]\[)(.?)(\]\[.*\])/;
        let match = name.match(regExp); // сохранить результат проверки
        match[2] = parseInt(match[2])+1;  // увеличить значение на +1
        return match[1] + match[2] + match[3];
    },

};

const navNewProgram = {
    oftenUsed, // подключить методы из main.js

    programId: $('#new_program_form').data('program-id'), // запомнить id открытой программы
    partnerId: $('#new_program_form').data('partner-id'), // запомнить id партнера
    navMenu: $('.new-program-nav__steps'),
    programBlock: $('.program-form .program-form__step'),
    btnNextPage: $('#next-page'),
    btnPrevPage: $('#previous-page'),
    btnCheckProgram: $('#complete-submit'),

    previousPage: undefined, // имя (id) предыдущей страницы формы (с которой был выполнен переход)
    currentPage: undefined,  // имя (id) текущей открытой страницы формы

    // запрос на подтверждение действия на выход без изменений
    confirmExitPage(elem){

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Сохранить изменения в текущем разделе программы?',
            content: '',
            type: 'blue',
            buttons: {
                ok: {
                    text: "Сохранить",
                    btnClass: 'btn-blue',
                    action: function(){
                        navNewProgram.saveAndExit(elem);
                    }},
                no: {
                    text: "Не сохранять",
                    btnClass: 'btn-grey',
                    action: function(){
                        window.location = window.location.origin + elem.attr('href');
                    }
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // действие при клике по навигационным полям формы (вверху справа)
    navAction(elem) {

        if (!elem.hasClass('current')) {
            this.getPreviousPage();
            this.ajaxSubmitCurrent();
            this.showCurrentPage(elem);
            this.buttonCheck();
        }
    },

    // действия при клике на кнопки "НАЗАД" и "ДАЛЕЕ" (внизу формы)
    toNextPage(num) {

        this.getPreviousPage();
        this.ajaxSubmitCurrent();

        let qty = null;
        let count = null;

        $.each(this.navMenu.find('span'), function () {
            count += 1;
            if ($(this).hasClass('current')) {
                qty = count + num;
                $(this).removeClass('current');
            }
        });

        this.showCurrentPage(this.navMenu.find(':nth-child(' + qty + ')').addClass('current'));
        this.buttonCheck();
        this.oftenUsed.scrollToTop($("html, body")); // при переключении между страницами плавно прокручивает страницу к началу
    },

    // действия при клике по кнопке "СОХРАНИТЬ И ВЫЙТИ"
    saveAndExit(elem) {

        this.getPreviousPage();
        this.ajaxSubmitCurrent(window.location.origin + elem.attr('href'));
    },

    // действия при клике по кнопке "ПРЕДПРОСМОТР"
    toPreview(program) {

        this.getPreviousPage();
        this.ajaxSubmitCurrent(window.location.origin + '/programs/preview/' + program);
    },

    //TODO OPTIMIZE временный метод для технической кнопки "Сохранить"
    // действия при клике по кнопке "СОХРАНИТЬ"
    saveNoExit(){

        this.getPreviousPage();
        this.ajaxSubmitCurrent();
    },

    // показать текущую выбранную страницу и скрыть все прочие
    showCurrentPage(elem) {

        elem.siblings('.current').removeClass('current');
        elem.addClass('current');
        this.programBlock.addClass('hide-element');

        let data = '#' + elem.attr('data-step');
        $(data).removeClass('hide-element');
        this.currentPage = data.slice(1);
    },

    // проверяет номер страницы формы; если это первая или последняя страница, то меняет порядок отображения кнопок
    buttonCheck() {

        if (this.currentPage === 'description') {
            this.btnPrevPage.addClass('hide-element');
            this.btnNextPage.removeClass('hide-element');
        }
        else if (this.currentPage === 'additional') {
            this.btnPrevPage.removeClass('hide-element');
            this.btnNextPage.addClass('hide-element');
            eventListeners.renderTextEditor();
        } else {
            this.btnPrevPage.removeClass('hide-element');
            this.btnNextPage.removeClass('hide-element');
        }
    },

    // получить и сохранить id блока, с которого совершен переход на другую страницу программы ("current")
    getPreviousPage() {

        $.each(this.navMenu.find('span'), function (index, value) {
            if ($(this).hasClass('current')) {
                navNewProgram.previousPage = value.getAttribute('data-step');
            }
        });
    },

    // сохранить изменения в блоке формы при переходе на следующий блок
    ajaxSubmitCurrent(href) {
        console.log(this.previousPage);

        if (this.previousPage === 'description') {
            ajaxObject.editProgramDescription(href);
        }
        if (this.previousPage === 'plan-by-days') {
            ajaxObject.editProgramPlanByDays(href);
        }
        if (this.previousPage === 'gallery') {
            ajaxObject.editProgramGallery(href);
        }
        if (this.previousPage === 'additional') {
            ajaxObject.editProgramAdditional(href);
        }
    },
};

const commonActions = {

    textareaFullSize(obj, elem){

        if (elem.scrollHeight > 0) {
            let offset = elem.offsetHeight - elem.clientHeight;
            this.resizeTextarea(elem, offset);
        }

        obj.one('focusout', function () {
            $(this).css('height', '100%').css('height', '77px');
        });
    },

    resizeTextarea(el, offset){
        $(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    },

    //открытие-закрытие по клику выпадающего меню с чекбоксами для "Тип тура", "Питание", "Трансфер", "Места", "Активности", "Для кого"
    toggleCheckboxBlock(elem) {
        elem.children('.toggle').toggleClass('hide-element');
        elem.siblings('.checkbox-block').fadeToggle("500", "linear");
    },

    // получить и запомнить id контейнера-родителя с набором чекбоксов
    getCurrentId(el) {
        return '#' + $(el).closest('.checkbox-block').attr('id');
    },

    // получить и запомнить DOM-элемент для вставки в него выбранных значений чекбоксов для "Тип тура", "Питание", "Трансфер", "Места", "Активности", "Для кого"
    getTextBox(id) {
        return $(id).siblings('.fade').children('.text');
    },

    // получить и запомнить текстовое значение по дефолту для div.text
    getDefault(box) {
        let value = box.text();
        return value;
    },

    // получить количество отмеченных чекбоксов у элемента
    getCheckedQty(elem) {

        let checked = $(elem).children('div').find('input:checked');
        let qty = 0;

        $.each(checked, function () {
            qty += 1;
        });

        return qty;
    },

    // получить массив всех отмеченных чекбосов у элемента
    getCheckedArr(elem, arr) {

        let checked = $(elem).children('div').find('input:checked');

        $.each(checked, function (index, value) {
            let val = value.getAttribute('data-name');
            arr.push(val);
        });

        return arr;
    },

    // получает из массива строку с перечислением выбранных значений для "Тип тура", "Для кого", "Питание", "Трансфер",
    getCheckedNames(arr, defaultVal, className) {

        let list = '';

        $.each(arr, function (index, value) {
            list += "<span class='" + className + "'>" + value + "</span>";
        });

        if (list === '') {
            return list = defaultVal;
        } else {
            return list
        }
    },

    // сверяет выбранные значения с дефолтными и задает стили в случае совпадения
    addCheckedStyle(box, list, defaultVal) {

        if (list !== defaultVal) {
            box.removeClass('default');
        } else {
            box.addClass('default');
        }
    },

    // перевести все чекбоксы в состояние not:checked (снять галочки)
    uncheckCheckboxes(elem) {

        let checked = $(elem).children('div').find('input:checked');

        $.each(checked, function () {
            $(this).prop('checked', false);
        });
    },

    // определеяет поведение чекбоксов элемента при выборе условия, блокирующего остальные (disabled)
    disableCheck(elem, id) {

        if (elem.prop('checked') === true) {
            this.uncheckCheckboxes(id);
            this.disableCheckboxes(id);
            elem.prop('disabled', false);
            elem.prop('checked', true);
        }
        if (elem.prop('checked') === false) {
            this.enableCheckboxes(id);
        }
    },

    // блокирует все неотмеченные чекбоксы (disabled) элемента
    disableCheckboxes(elem) {

        let notChecked = $(elem).children('div').find('input:not(:checked)');

        $.each(notChecked, function () {
            $(this).prop('disabled', true);
        });
    },

    // снимает блокировку (disabled) со всех чекбосов элемента
    enableCheckboxes(elem) {

        let disabled = $(elem).children('div').find('input:disabled');

        $.each(disabled, function () {
            $(this).prop('disabled', false);
        });
    },

    // обнулить значения для поля "Выбрать город"
    clearAutocompleteVal(elem){

        $.each($(elem).find('input'), function () {
           $(this).attr('value', '').val('');
        });
    }
};

const eventListeners = {

    addEventListeners(){
        //-- О Б Р А Б О Т Ч И К И   С О Б Ы Т И Й -------------------------------------------------------------------------------

//========== О Б Щ И Е   С О Б Ы Т И Я ==================================================================================
        // при переходе "назад" сверяет размер экрана и назначает событие
        $('.back-n-wrap a').on('click', function (e) {
            // если размер экрана более 630px, значит форма программы открыта и переход возможен только после подтверждения действия
            if (window.matchMedia('all and (min-width: 630px)').matches) {
                e.preventDefault();
                navNewProgram.confirmExitPage($(this));
            }
        });

        // Слушатель для кнопки "На модерацию"
        $('#moderation-mode button').on('click', function () {
            navNewProgram.saveNoExit(); // сохранить изменения на текущей странице
            ajaxObject.goToModeration($('#new_program_form').attr('data-program-id'));
        });

        // Навигация (переключение между блоками формы)
        $('.new-program-nav__step').on('click', function () {
            navNewProgram.navAction($(this));
        });

        // Навигация клик по кнопке "ВПЕРЕД"
        $('#next-page').on('click', function () {
            navNewProgram.toNextPage(+1);
        });

        // Навигация клик по кнопке "НАЗАД"
        $('#previous-page').on('click', function () {
            navNewProgram.toNextPage(-1);
        });

        // Навигация клик по кнопке "СОХРАНИТЬ И ВЫЙТИ"
        $('#save-exit').on('click', 'a', function (e) {
            e.preventDefault();
            navNewProgram.saveAndExit($(this));
        });

        // Навигация клик по кнопке "ПРЕДПРОСМОТР"
        $('#to-preview').on('click', function () {
            navNewProgram.toPreview($('#new_program_form').attr('data-program-id'));
        });

        //TODO Добавить метод
        // Навигация клик по кнопке "ОПУБЛИКОВАТЬ"
        //$('#check-form').on('click', function () {
        //    console.log('no action');
        //});

        //TODO OPTIMIZE Временное решение. Удалить на боевом!
        // Навигация клик по кнопке "СОХРАНИТЬ"
        //$('#save').on('click', function () {
        //    navNewProgram.saveNoExit();
        //});

        //Общее: открытие-закрытие выпадающего меню с чекбоксами (Тип тура, Для кого, Питание, Трансфер, Места, Активности)
        $('.program-form__step').on('click', '.cover-box .fade', (function () {
            commonActions.toggleCheckboxBlock($(this));
        }));

        // атоматическое открытие/скрытие содержимого тега textarea при клике, если контент overflow
        $('textarea[data-autoresize]').on('focusin', function () {
            commonActions.textareaFullSize($(this), this);
        });

//========== Б Л О К   О П И С А Н И Е == ==============================================================================
        //ОПИСАНИЕ/НАЗВАНИЕ: при изменении исходного значения запускает проверку на уникальность нового названия
        $('#program-name').on('change', function () {
            ajaxObject.uniqueNameInDescription($(this));
        });

        //ОПИСАНИЕ/ТИП-ТУРА: поведение элементов при клике по чекбоксам выпадающего меню
        $('#tour-type input').on('click', function () {
            tourTypeObject.getTourType($(this));
        });

        //ОПИСАНИЕ/ДЛИТЕЛЬНОСТЬ: запоминает количество дней в daysObject
        $('#duration').on('change', (function () {
            daysObject.getDaysAmount();
            daysObject.lastDaySettings();
        }));

        //ОПИСАНИЕ/ЦЕЛЕВАЯ АУДИТОРИЯ: поведение элементов при клике по чекбоксам выпадающего меню
        $('#target-audience input').on('click', function () {
            tourTypeObject.getAudience($(this));
        });

        // ОПИСАНИЕ/СТАРТ - поведение полей формы "Страна" при изменении значения select
        $('#start-country').on('change', function () {
            // получить прежнее значение поля (до внесения изменений)
            let oldVal =  $(this).find('option[value="'+ Object.keys(geoObject.countryStart)[0] +'"]');
            // 1. Проверить наличие локера в поле НОЧЕВКА в ПЛАН ПО ДНЯМ. Если есть - вернуть предыдущее значение страны и прервать скрипт
            if ($('#day-1 .'+geoObject.domEl.dayPlaceClassName).siblings('.repeat-4-all').hasClass(daysObject.domEl.lockedClass)){
                oldVal.prop('selected', true);
                oftenUsed.dialogMessageCall('Чтобы изменить выбор страны,' +
                    ' отключи <b>Автозаполнение</b> для поля <b>НОЧЕВКА</b> в разделе <b>2. План по дням</b>');
            } else {
                // 2. Проверить есть ли в ПЛАН ПО ДНЯМ любые сохраненные страны. Если есть - запросить подтверждение действия
                if (geoObject.checkDayCountrySavings() === true) {
                    geoObject.confirmStartCountryChange($(this), oldVal);
                } else {
                    // 3. если в ПЛАН ПО ДНЯМ нет локера и нет выбранных стран - запустить скрипт на изменение связанных значений
                    //commonActions.clearAutocompleteVal($('#start-city').parent()) //  oбнулить предыдущие значения ввода города
                    geoObject.startCountryChanged($(this)); // запустить скрипты на обновление выбора страны
                }
            }
        });

        // ОПИСАНИЕ/ФИНИШ - вызов autocomplete для ввода города
        $('#start-city').autocomplete({
            source: function (data, response) {
                ajaxObject.startCityAutocomplete(data, response, $('#start-country').val());
            },
            select: function(event, ui) { // Триггер срабатывает после выбора элемента.
                $('#start-city-id').val(ui.item.city_id);
                $('#start-area-id').val(ui.item.area_id);
            },
            autoFocus: true, // Подсвечивает первый элемент.
            delay: 300, // Задержка после ввода.
        }).on('focusin', function () {
            cityChange.cityFocus($(this)); // очистить все value для полей city
        }).on('change', function () {
            console.log('start city changed');
            cityChange.cityCheckSelected($(this)); // проверить input:hidden на заполненность
            geoObject.startCityCheck();
        });

        // ОПИСАНИЕ/ФИНИШ - поведение полей формы при клике по checkbox
        $('#finish').on('click', function (event) {
            // определить действие для блока с отмеченным чекбоксом
            (geoObject.checkDayCountrySelected(Object.keys(geoObject.countryFinish), event) === true)
                ? geoObject.confirmCloseBox($(this), event) // если страна СТАРТ не равно СТРАНА финиш + есть сохраненные значения
                : geoObject.finishClicked(event); // если условия не выполнены
        });

        // ОПИСАНИЕ/ФИНИШ - поведение полей формы "Страна" при клике по select
        $('#finish-country').on('change', function () {
            // получить прежнее значение поля (до внесения изменений)
            let oldVal =  $(this).find('option[value="'+ Object.keys(geoObject.countryFinish)[0] +'"]');
            // 1. Проверить наличие локера в поле НОЧЕВКА в ПЛАН ПО ДНЯМ. Если есть - вернуть предыдущее значение страны и прервать скрипт
            if ($('#day-1 .'+geoObject.domEl.dayPlaceClassName).siblings('.repeat-4-all').hasClass(daysObject.domEl.lockedClass)){
                // вернуть предыдущее значение страны
                oldVal.prop('selected', true);
                oftenUsed.dialogMessageCall('Чтобы добавить в программу еще страну, ' +
                    'отключи <b>Автозаполнение</b> для поля <b>НОЧЕВКА</b> в разделе <b>2. План по дням</b>');
            } else {
                // 2. Проверить в ПЛАН ПО ДНЯМ выбранные значения для СТРАНА-ФИНИШ. Если есть - запросить подтверждение действия на изменение страны
                if (geoObject.checkDayCountrySelected(Object.keys(geoObject.countryFinish)) === true) {
                    geoObject.confirmFinishCountryChange($(this), oldVal);
                } else {
                    // 3. если в ПЛАН ПО ДНЯМ нет локера и нет выбора страны ФИНИШ - запустить скрипт на изменение связанных со страной значений
                    //commonActions.clearAutocompleteVal($('#finish-city').parent());
                    geoObject.finishCountryChanged($(this));
                }
            }
        });

        // ОПИСАНИЕ/ФИНИШ - вызов autocomplete для ввода города
        $('#finish-city').autocomplete({
            source: function (data, response) {
                ajaxObject.finishCityAutocomplete(data, response, $('#finish-country').val());
            },
            select: function (event, ui) { // Триггер срабатывает после выбора элемента.
                $('#finish-city-id').val(ui.item.city_id);
                $('#finish-area-id').val(ui.item.area_id);
            },
            autoFocus: true,  // Подсвечивает первый элемент.
            delay: 300,  // Задержка после ввода.
        }).on('focusin', function () {
            cityChange.cityFocus($(this)); // очистить все value для полей city
        }).on('change', function () {
            cityChange.cityCheckSelected($(this)); // проверить input:hidden на заполненность
            geoObject.finishCityCheck(); // если город старт = город финиш, обнуляет инпуты финиша
        });

        // ОПИСАНИЕ/ФИНИШ - если город старт = город финиш, обнуляет инпуты финиша
        //$('#finish-city').on('change', function () {
        //    geoObject.finishCityCheck();
        //});

        //$('#start-city, #finish-city').on('focusin', function () {
        //    cityChange.cityFocus($(this)); // очистить все value для полей city
        //}).on('change', function () {
        //    cityChange.cityNotSelected($(this)); // проверить input:hidden на заполненность
        //});

        // ОПИСАНИЕ/МУЛЬТИ-ТУР - поведение полей формы при клике по checkbox
        $('#multi-tour').on('click', function (event) {
            // определить действие для блока с отмеченным чекбоксом
            (geoObject.checkDayCountrySelected(Object.keys(geoObject.countryExtra)) === true)
                ? geoObject.confirmCloseBox($(this), event)  // если в МУЛЬТИ-ТУР есть страны + сохранены в "План по дням"
                : geoObject.multiTourClicked(event);
        });

        // ОПИСАНИЕ/ФИНИШ - поведение полей формы "Страна" при клике по select
        $('#multi-country').on('change', function () {
            geoObject.addExtraCountry($(this));
        });

        // ОПИСАНИЕ/МУЛЬТИ-ТУР - удалить добавленную страну
        $('#country-added').on('click', '.delete-clone', function (event) {
            let elem = $(event.target);
            for (let [key, value] of Object.entries(geoObject.countryExtra)) { // найти id-страны по названию
                if (elem.parent().text() === value) {
                    (geoObject.checkDayCountrySelected([key]))
                        ? geoObject.confirmMultyCountryChange(elem, key, value) // если страна выбрана в План по дням
                        : geoObject.deleteElem(elem, key);
                }
            }
        });


//========== Б Л О К   П Л А Н   П О   Д Н Я М =========================================================================
        // ПЛАН ПО ДНЯМ - обработчик событий на динамически созданные элементы блока
        // Отрыть\скрыть ДЕНЬ / копировать День / добавить-удалить реквайред для select Размещение /
        // Скрипт для чекбокс-блоков Питание и Трансфер
        $('#plan-by-days')
            .on('click', '.day-title, div.day-clone, div.day-delete, .add-elem, .delete-elem,' +
                ' .transfer-box input:checkbox, .meal-box input, .choose-img, .delete-clone, textarea', function (e) {
                daysObject.dayClickedActions($(this), e); })
            .on('change', 'select.day-country, .ui-autocomplete-input, .day-accommodation .text, .distance-box input', function () {
                daysObject.dayFormOnchangeActions($(this)) })
            .on('focusin', 'textarea, .ui-autocomplete-input', function () {
                daysObject.dayFormFocusinActions($(this), this); })
            .on('focus', '.select-cover input', function (){
                $(this).autocomplete({
                    source: function (data, response) {
                        ajaxObject.dayCityAutocomplete(data, response, $(this.element).parents('.day-place').find('select').val())
                    },
                    select: function (event, ui) {   // Триггер срабатывает после выбора элемента.
                        $(this).nextAll('.day__city-id').val(ui.item.city_id);
                        $(this).nextAll('.day__area-id').val(ui.item.area_id);
                    },
                    autoFocus: true,  // Подсвечивает первый элемент.
                    delay: 300,  // Задержка после ввода.
                });
            });

        // ПЛАН ПО ДНЯМ/ДЕНЬ 1 - блокировка выбранного поля формы для всех дней
        $('.repeat-4-all input').on('click', function (event) {
            daysObject.lockerAction(event, $(this));
        });

        // ПЛАН ПО ДНЯМ/ДОБАВИТЬ ФОТО - вернуть форму Фото-архив в Галерею
        $('#choose-img').on('click', '.check-img, .close-pop-up', function () {
            galleryObject.switchAction($(this));
        });

        // ПЛАН ПО ДНЯМ/ДОБАВИТЬ ДЕНЬ - добавление нового дня на страницу
        $('#add-day').on('click', (function () {
            daysObject.addNewDay();
            daysObject.lastDaySettings();
        }));

//========== Б Л О К   Г А Л Е Р Е Я =====================================================================================

        // загрузка Галереи
        $('#submit_upload_main_photo').on('click', function (e) {
            ajaxObject.uploadMainImage(e, $('#form_upload_main_photo'), $('#program_photos'), $('#block_error_upload_main_photo'));
        });

        // загрузка Карты
        $('#submit_upload_map_photo').on('click', function (e) {
            ajaxObject.uploadMapImage(e, $('#form_upload_map_photo'),  $('#program_photos_map'),  $('#block_error_upload_map_photo'));
        });

        // проверка количества фото в ФОТО-АРХИВЕ перед тем, как добавить новые
        $('#gallery-img-1').on('click', function (event) {
            if(galleryObject.imgUploaded >= galleryObject.imgArchiveLimit){
                event.preventDefault();
                oftenUsed.dialogMessageCall('Загружено максимальное количество фото');
            }
        });

        // загрузка ФОТО-АРХИВА
        $('#submit_upload_archive_photo').on('click', function (e) {
            galleryObject.uploadImgArchive($(this), e);
        });

        // удаление изображения из Галереи
        $('.program-form__image-result').on('click', '.turn-img', function (e) {
            //console.log($(this).addClass('hide-element'));
            //console.log($(this).siblings('img').attr('src'));
            let arr = $(this).siblings('img').attr('src').split('/');
            //console.log(arr.pop());
            ajaxObject.rotateImg(arr.pop(), $(this)); // Передаем имя картинки.
        });

        // удаление изображения из Галереи
        $('.program-form__image-result').on('click', '.delete-clone', function (e) {
            galleryObject.checkImgBeforeDelete($(this));
        });

        // добавление ссылки на видео-ролик в Галерею
        $('#program-form-edit-gallery').on('change', 'input[type="url"]', function () {
            galleryObject.checkYoutubeLink($(this));
        });

        // клик по кнопке "Добавить еще видео" в Галерею
        $('#add-video').on('click', function () {
            galleryObject.addVideoBox();
        });

        $('#program-form-edit-gallery').on('click', '.delete-clone', function () {
            galleryObject.clearVideoBox($(this).parent().parent());
        });

//========== Б Л О К   Д О П О Л Н И Т Е Л Ь Н О =========================================================================

        // ЛОКАЦИИ \ АКТИВНОСТИ: поведение чекбоксов
        $('#places-tags input, #activities-tags input').on('click', function () {
            tourTypeObject.getPlaceActionTags($(this));
        });

        $('#additional').on('click', '.trumbowyg-editor.trumbowyg-reset-css', function (event) {
            let elem = this;
            // проверка на наличие текста в редакторе
            function placeholderCheck(event){
                if (elem.innerText.length <= 1){ // если нет текста, очистить пустые теги (вернется placeholder)
                    elem.innerHTML = "";
                }
                if (!elem.contains(event.target)){ // удалить слушатель события, если клик вне редактора
                    document.removeEventListener('click', placeholderCheck);
                }
            }
            // добавить слушатель события, на внесение текста внутри редактора
            document.addEventListener('click', placeholderCheck);
        });
    },

    renderTextEditor(){
//========== Т Е К С Т О В Ы Й   Р Е Д А К Т О Р  ========================================================================

        // Text editor init START>>>>
        $.trumbowyg.svgPath = '/plugins/trumbowyg/dist/ideas-ui/icons.svg';
        $('.text-editor').trumbowyg({
            resetCss: true,
            lang: 'ru',
            // Styles pasted from clipboard - disable.
            removeformatPasted: true,
            // The text editing zone can extend itself when writing a long text.
            autogrow: true,
            // Do not replace tags.
            semantic: false,
            // Tags to remove.
            tagsToRemove: [
                'script',
                'link',
                'span'
            ],
            btns: [
                [
                    'historyUndo',
                    // 'customTitle',
                    'strong', 'em', 'underline', 'del',
                    'unorderedList', 'orderedList',
                    'superscript', 'subscript',
                    'blockquote',
                    'emoji',
                    'h5',
                    'h6',
                    'p',
                    'removeformat',
                    'viewHTML',
                ],
            ],
        });
        // Text editor init <<<<<STOP
    }
};

(function ($) {

    $(document).ready(
        function () {

//скрипты, отрабатывающие сразу после загрузки страницы ---------------------------------------------------------------------

            // проверка сохраненных значений для tourTypeObject
            tourTypeObject.checkboxCheck();

            // проверка сохраненных значений для geoObject
            geoObject.geoCheck();

            // сохраняет daysAmount и daysCount + настройка полей "НОЧЕВКА" и "РАЗМЕЩЕНИЕ" для последнего дня
            daysObject.getCurrentData();

            // проверка сохраненных значений локеров для daysObject
            daysObject.daysCheck();

            // проверка сохраненных значений для элементов ГАЛЕРЕИ
            galleryObject.galleryCheck();

            eventListeners.addEventListeners();

            //TODO: добваить эвент-листенер на иконку поворота (.turn-img)

        });
})

(jQuery);
