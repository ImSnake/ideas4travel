"use strict";

const commonActions = {

    //открытие-закрытие по клику выпадающего меню с чекбоксами для "Тип тура", "Питание", "Трансфер", "Места", "Активности"
    toggleCheckboxBlock(elem) {
        elem.children('.toggle').toggleClass('hide-element');
        elem.siblings('.checkbox-block').fadeToggle("500", "linear");
    },

    // получить и запомнить id контейнера-родителя чекбокса
    getCurrentId(el){
        return '#' + $(el).closest('.checkbox-block').attr('id');
    },


    // получить и запомнить DOM-элемент для вставки в него выбранных значений чекбоксов
    getTextBox(id){
        return $(id).siblings('.fade').children('.text');
    },

    // получить и запомнить текстовое значение по дефолту для div.text
    getDefault(box){
        let value = box.text();
        //console.log(value);
        return value;
    },

    getCheckedArr(elem, arr){
        let checked = $(elem).children('div').find('input:checked');
        $.each(checked, function (index, value) {
            let val = value.getAttribute('data-name');
            arr.push(val);
        });
        return arr;
    },

    getCheckedNames(arr, list, defaultVal){
        $.each(arr, function (index, value) {
            list += value + ", ";
        });
        if (list === '') {
            return list = defaultVal;
        } else {
            return list.slice(0, -2);
        }
    },

    addCheckedStyle(box, list, defaultVal, disabledVal){
        let disabled = '';
        if (disabledVal !== null) {
            disabled = disabledVal;
        }
        if (list !== defaultVal && list !== disabled){
            box.removeClass('default');
        } else {
            box.addClass('default');
        }
    },

    //
    uncheckCheckboxes(elem){
        let checked = $(elem).children('div').find('input:checked');
        $.each(checked, function () {
            $(this).prop('checked', false);
        });
    },

    // определеяет поведение при выборе по условия, блокирующего остальные (disabled)
    disableCheck (elem, id){
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

    disableCheckboxes(elem) {
        let notChecked = $(elem).children('div').find('input:not(:checked)');
        $.each(notChecked, function () {
            $(this).prop('disabled', true);
        });
    },

    enableCheckboxes(elem) {
        let disabled = $(elem).children('div').find('input:disabled');
        $.each(disabled, function () {
            $(this).prop('disabled', false);
        });
    }

};

const navNewProgram = {

};

const daysObject = {

};

const tourTypeObject = {
    //"Тип-тура"
    tourTypeBox: null,  // // элемент для добавления выбранных значений для "Тип-тура"
    tourTypeChecked: [],   // массив выбранных значений для "Тип-тура"
    tourTypeList: null,     // строка выбранных значений "Тип-тура" для отображения на странице
    defaultTourType: null,  // запоминает значение строки "Тип-тура" по дефолту


    //"Тип трансфера"
    transferBox: null, // элемент для добавления выбранных значений для "Тип трансфера"
    transferTypeChecked: [],  // массив выбранных значений для "Тип-трансфера"
    transferTypeList: null,   // строка выбранных значений "Тип-трансфера" для отображения на странице
    defaultTransfer: null,  // // запоминает значение строки по дефолту
    //transferDisable: 'no-transfer',  // при значении :checked прочие чекбоксы в "Тип трансфера" - disabled


    //"Тип питания"
    mealBox: null, // DOM-элемент для добавления выбранных значений
    mealChecked: [],  // массив выбранных значений
    mealList: null,   // строка со списком выбранных значений для отображения на странице
    defaultMeal: null,  // // запоминает значение тега до начала манипуляций с элементов
    mealDisable: ['no-meal', 'meal-na'], // стоп-значения, блокирующие дальнейший выбор чекбосов


    // логика работы чекбоксов для "Тип Тура"
    getTourType(elem){
        let id = commonActions.getCurrentId(elem);
        this.tourTypeChecked = [];
        this.tourTypeList = '';

        if (this.tourTypeBox === null) {
            this.tourTypeBox = commonActions.getTextBox(id);
        }

        if (this.defaultTourType === null){
            this.defaultTourType = commonActions.getDefault(this.tourTypeBox);
        }
        this.tourTypeChecked = commonActions.getCheckedArr(id, this.tourTypeChecked);
        this.tourTypeList = commonActions.getCheckedNames(this.tourTypeChecked, this.tourTypeList, this.defaultTourType);

        if (Object.keys(this.tourTypeChecked).length === 3) {
            commonActions.disableCheckboxes(id);
        } else {
            commonActions.enableCheckboxes(id);
        }

        commonActions.addCheckedStyle(this.tourTypeBox, this.tourTypeList, this.defaultTourType, null);

        this.tourTypeBox.text(this.tourTypeList);
    },

    // логика работы чекбоксов для "Тип трансфера"
    getTransferType(elem){
        let id = commonActions.getCurrentId(elem);
        this.transferTypeChecked = [];
        this.transferTypeList = '';

        if (this.transferBox === null) {
            this.transferBox = commonActions.getTextBox(id);
        }

        if (this.defaultTransfer === null){
            this.defaultTransfer = commonActions.getDefault(this.transferBox);
        }

        //if (elem.attr('id').indexOf(this.transferDisable) > -1){
        //    commonActions.disableCheck(elem, id);
        //}

        this.transferTypeChecked = commonActions.getCheckedArr(id, this.transferTypeChecked);
        this.transferTypeList = commonActions.getCheckedNames(this.transferTypeChecked, this.transferTypeList, this.defaultTransfer);

        commonActions.addCheckedStyle(this.transferBox, this.transferTypeList, this.defaultTransfer, this.transferDisable);

        this.transferBox.text(this.transferTypeList);
    },


    getMealType(elem){
        let id = commonActions.getCurrentId(elem);
        this.mealChecked = [];
        this.mealList = '';

        if (this.mealBox === null) {
            this.mealBox = commonActions.getTextBox(id);
        }

        if (this.defaultMeal === null){
            this.defaultMeal = commonActions.getDefault(this.mealBox);
        }

        $.each(this.mealDisable, function (index, value) {
            if (elem.attr('id').indexOf(value) > -1){
                commonActions.disableCheck(elem, id);
            }
        });

        if (this.mealDisable.indexOf(elem.attr('id')) > -1){
            console.log(elem);
            this.disableCheck(elem, id);
        }

        this.mealChecked = commonActions.getCheckedArr(id, this.mealChecked);
        this.mealList = commonActions.getCheckedNames(this.mealChecked, this.mealList, this.defaultMeal);

        commonActions.addCheckedStyle(this.mealBox, this.mealList, this.defaultMeal, this.mealDisable);

        this.mealBox.text(this.mealList);

    }
};

const geoObject = {
    countryStart: null, // страна из "Старт"
    cityStart: null,     // город из "Старт"
    countryFinish: null,   // страна из "Финиш"
    countryList: null,    // строка со списком выбранных стран (через запятую)
    countryExtra: [],     // массив стран из "Мульти-тур"
    countryExtraList: '',    // html-элемент для добавления выбранных стран в #country-added


    // ОПИСАНИЕ/СТАРТ - поведение полей формы "Страна" при изменении значения select
    startCountryChanged(elem) {
        this.countryStart = elem.val();
        this.countryFinish = null;
        this.countryExtra = [];
        $('#country-added').empty();
        this.countryChecked();
        this.countryCount();
        this.multiChecked();
    },

    // ОПИСАНИЕ/СТАРТ - поведение полей формы "Город" при изменении значения select
    startCityChanged(elem) {
        this.cityStart = elem.val();
        this.cityChecked();
    },

    // ОПИСАНИЕ/ФИНИШ - поведение полей формы "Страна" при клике по select
    finishCountryChanged(elem) {
        this.countryFinish = elem.val();
        this.countryExtraList = '';
        this.countryExtra = [];
        $('#country-added').empty();
        this.countryCount();
        this.cityChecked();
        this.multiChecked();
    },

    // ОПИСАНИЕ/ФИНИШ - поведение полей формы при клике по checkbox
    finishClicked(event, elem) {
        if (this.checkGeo(event) === false) {

            this.clearCloneBox(elem);

            if (elem.prop("checked") === false) {
                this.countryFinish = null;
                this.countryCount();
                this.multiChecked();

            } else {
                $('#start-country option').clone().appendTo($('#finish-country'));
                $('#start-city option').clone().appendTo($('#finish-city'));
                this.countryChecked();
                this.cityChecked();
            }
            this.openFade(elem);
        }
    },

    // ОПИСАНИЕ/МУЛЬТИ-ТУР - поведение полей формы при клике по checkbox
    multiTourClicked(event, elem) {
        if (this.checkGeo(event) === false) {

            this.clearCloneBox(elem);

            if (elem.prop("checked") === false) {
                this.countryExtra = [];
                $('#country-added').empty();
                $('#country-count').empty().css('display', 'none');

            } else {
                $('#start-country option').clone().appendTo($('#multi-country'));
                $('#country-added').removeClass('hide-element');
                $('#country-count').css('display', 'inline-block');
                this.countryCount();
                this.multiChecked();
            }
            this.openFade(elem);
        }
    },

    //проверка поля "Старт" на предмет заполнения. Если не заполнено, чекбокс не откроет "Финиш" и "Мульти-тур"
    checkGeo(event) {
        if (this.countryStart === null || this.cityStart === null) {
            $(this).attr('checked', false);
//TODO alert заменить на всплывающий div
            alert('Укажите место старта программы: страну и город');
            event.preventDefault();
            event.stopPropagation();
            return true;
        } else {
            return false;
        }
    },

    // очищает контейнеры "Финиш" и "Мульти-тур" для клонирования в них тегов select из "Старт"
    clearCloneBox(elem) {
        //elem.parent().siblings('.fade').find('.clone').empty();
        elem.siblings('.fade').find('.clone').empty();
    },

    // при клике плавное открытие\закрытие контейнеров "Финиш" и "Мульти-тур" под чекбоксом
    openFade(elem) {
        //elem.parent().siblings('.fade').fadeToggle("500", "linear");
        elem.siblings('.fade').fadeToggle("500", "linear");
    },

    // устанавливает в "Финиш (Старна)" по умолчанию значение из "Старт (Страна)"
    countryChecked() {
        $.each($('#finish-country option'), function (index, value) {
            if (value.getAttribute('value') ===  geoObject.countryStart) {
                $(this).prop('selected', true);
            }
            if (value === null) {
                $(this).prop('selected', false);
            }
        });
    },

    // не дает выбрать в "Финиш" город, выбранный в "Старт": устанавливает в option атрибут disabled
    cityChecked() {
        if (this.countryStart === this.countryFinish || this.countryFinish === null) {
            $.each($('#finish-city option'), function (index, value) {
                $(this).prop('disabled', false).removeClass('text');
                if (value.getAttribute('value') === "") {
                    $(this).prop('selected', true).addClass('text');
                }
                if (value.getAttribute('value') ===  geoObject.cityStart) {
                    $(this).prop('selected', false).addClass('text');
                    $(this).prop('disabled', true);
                }
            });
        }
    },

    // не дает выбрать в "Мульти-тур" страны, выбранные в "Старт", "Финиш" и "Мульти-тур": устанавливает в option атрибут disabled
    multiChecked() {
        $.each($('#multi-country option'), function (index, value) {
            $(this).prop('disabled', false).removeClass('text');
            if (value.getAttribute('value') ===  geoObject.countryStart ||
                value.getAttribute('value') ===  geoObject.countryFinish) {
                $(this).prop('selected', false);
                $(this).prop('disabled', true).addClass('text');
            }
            if ( geoObject.countryExtra.includes($(this).val()) === true) {
                $(this).prop('selected', false);
                $(this).prop('disabled', true).addClass('text');
            }
            if ($(this).val() === "страна") {
                $(this).prop('selected', true).addClass('text');
            }
        });

        $('#country-count').removeClass('hide-element');
    },

    // вывод в "Мульти-тур" списка стран, выбранных в "Старт" и "Финиш"
    countryCount() {
        if (this.countryFinish === null || this.countryFinish === this.countryStart) {
            this.countryList = this.countryStart;
        } else {
            this.countryList = this.countryStart + ", " + this.countryFinish;
        }
        $('#country-count').text(this.countryList).addClass('grey');
    },

    // если в "Мульти-тур" выбрана страна, то обновит значения select
    checkExtra() {
        $('#multi-country option').each(function () {
            if ($(this).prop('selected') === true && $(this).val() !== "страна") {
                geoObject.addExtraCountry($(this).val());
            }
            geoObject.multiChecked();
        });
    },

    // добавляет из "Мульти-тур" выбранные страны в массив countryExtra и на страницу в #country-added
    addExtraCountry(country) {
        if (this.countryExtra.includes(country) === false && country !== '') {
            this.countryExtra.push(country);
            this.countryExtraList = $('#country-added');
            this.countryExtraList.empty();

            for (let i = 0; i < this.countryExtra.length; i++) {
                let val = '<span>';
                val += this.countryExtra[i] + '<span class="delete-clone"></span></span>';
                this.countryExtraList.append(val);
            }
        }
    },

    // удаляет из "Мульти-тур" выбранную страну по клику (-)
    deleteElem(event) {
        let domElement = $(event.target);
        let txt = domElement.parent().text();
        this.countryExtra.splice($.inArray(txt, this.countryExtra), 1);
        domElement.parent().remove();
        this.multiChecked();
    },
};


(function ($) {
    $(document).ready(
        function () {

//обработчики на общие события -----------------------------------------

            // Навигация (переключение между блоками формы)
            $('.new-program-nav__step').on('click', function () {
                if (!$(this).hasClass('current')){
                    $(this).siblings('.current').removeClass('current');
                    $(this).addClass('current');
                    $('.program-form .program-form__step').addClass('hide-element');
                    let data = '#' + $(this).attr('data-step');
                    $(data).removeClass('hide-element');
                 }
            });


            //Форма: открытие-закрытие по клику выпадающего меню с чекбоксами (Тип тура, Питание, Места, Активности)
            $('.cover-box .fade').click(function () {
                commonActions.toggleCheckboxBlock($(this));
            });



//блок "1.ОПИСАНИЕ": ОБРАБОТЧИКИ СОБЫТИЙ НА ВЫБОР СТРАН И ГОРОДОВ ==================================================================

            //ОПИСАНИЕ/ТИП-ТУРА: поведение элементов при клике по чекбоксам выпадающего меню
            $('#tour-type input').click(function () {
                tourTypeObject.getTourType($(this));
            });

            // ОПИСАНИЕ/СТАРТ - поведение полей формы "Страна" при изменении значения select
            $('#start-country').change(function () {
                geoObject.startCountryChanged($(this));
            });

            // ОПИСАНИЕ/СТАРТ - поведение полей формы "Город" при изменении значения select
            $('#start-city').change(function () {
                geoObject.startCityChanged($(this));
            });

            // ОПИСАНИЕ/ФИНИШ - поведение полей формы при клике по checkbox
            $('#finish').click(function (event) {
                geoObject.finishClicked(event, $(this));
            });

            // ОПИСАНИЕ/ФИНИШ - поведение полей формы "Страна" при клике по select
            $('#finish-country').change(function () {
                geoObject.finishCountryChanged($(this));
            });

            // ОПИСАНИЕ/МУЛЬТИ-ТУР - поведение полей формы при клике по checkbox
            $('#multi-tour').click(function (event) {
                geoObject.multiTourClicked(event, $(this));
            });

            // ОПИСАНИЕ/ФИНИШ - поведение полей формы "Страна" при клике по select
            $('#multi-country').change(function () {
                geoObject.checkExtra();
            });

            // ОПИСАНИЕ/МУЛЬТИ-ТУР - удалить добавленную страну
            $('#country-added').on('click', '.delete-clone', function (event) {
                geoObject.deleteElem(event);
           });


//блок "2.ПЛАН ПО ДНЯМ"======================================================================================================================

            // ОПИСАНИЕ/ День (скрыть\показать) элементы внутри тега div.day-box
            $('.start.day').on('click', function (e) {
                if (e.target.tagName !== "I") {
                    $(this).toggleClass('opened');
                    $(this).siblings('.day-cover').fadeToggle(50, "linear");
                    $(this).parent().toggleClass('opened');
                    $(this).children('div').siblings().find('.toggle').toggleClass('hide-element');
                }
            });

            //ПЛАН ПО ДНЯМ / ПИТАНИЕ : поведение элементов при клике по чекбоксам выпадающего меню
            $('.meal-box input').click(function () {
                tourTypeObject.getMealType($(this));
            });






            //Тип трансфера: поведение элементов при клике по чекбоксам выпадающего меню
            $('.transfer-box input').click(function () {
                tourTypeObject.getTransferType($(this));
            });



//======================================================================================================================


            //Форма/описание/Коротко о главном: поведение элементов при клике (+)
            $('#reasons').click(function () {

                let addTxt = $('<div class="clone"><textarea rows="2" placeholder="причина поехать"></textarea></div>');

                $(addTxt).insertBefore($(this).parent('.group'));

                $(this).siblings('.icon-minus-circled').css('display', 'inline-block');
            });





            //Форма/Дополнительно/Достопримечательности: поведение элементов при клике (+)
            $('#key-points').click(function () {

                $(this).siblings('.original').clone().removeClass('original')
                    .addClass('clone').insertAfter($(this).parent('.group'));

                $('#del-key-points').css('display', 'inline-block');
            });

        });

})

(jQuery);

/*
            $('.start span').on('click', function () {

                if($(this).parent().hasClass('program-form__title')){
                    let title = $(this).parent();
                    let text = $(this).parent().siblings('.program-form__text');
                    title.toggleClass('end closed');
                    text.toggleClass('end');
                    title.children('.toggle').toggleClass('hide-element');
                    title.parent().siblings('.day-cover').fadeToggle("fast", "linear");
                    title.children().toggleClass('blue grey');
                }
            });
 */