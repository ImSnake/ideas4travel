"use strict";

const organizerFormActions = {

    // ПРОФИЛЬ: для манипуляций с полем ФАКТ-АДРЕС
    checkbox: undefined,
    elem: undefined,

    // ПРОФИЛЬ/ОРГАНИЗАЦИЯ:
    companyType: undefined, //
    partnerType: undefined, // скрытый инпут если "Деятельность" = "Туроператор"
    rtoNumber: undefined, // select "Детельность"

    // Validation rules for contact form inputs. If link - 4th element is "true".
    validationRulesArr: [
        [
            '#website',
            /^(https?:\/{2}?)?(w+\.)?([\w-.]+(?:\.[\w-]+)(?=\.?[[a-zA-Z]+\/|.$)+(?:[\w().,@?^=%&amp;:\/~+#-]*[\w@^=%amp;~+#-])?).*$/,
            'Некорректная ссылка на сайт.',
            true
        ],
        [
            '#facebook',
            /^(https?:\/\/)?(w+\.|m\.|touch\.)?((?:facebook\.com|fb(?:\.me|\.com))\/(?!$)(?:(?:\w)*#!\/)?(?:pages\/)?(?:photo\.php\?fbid=)?(?:[\w\-]*\/)*?(?:\/)?(?:profile\.php\?id=)?[^\/?&\s]*[\w@^=%&amp;~+#-]).*$/,
            'Некорректная ссылка на профиль Facebook.',
            true
        ],
        [
            '#instagram',
            /^((?:https?:\/{2}?))?(w+\.)?((?:instagram.com|instagr.am)\/[A-Za-z0-9-_]+).*$/,
            'Некорректная ссылка на профиль Instagram.',
            true
        ],
        [
            '#vkontacte',
            /^((?:https?:\/{2}?))?(w+\.)?(vk.com\/(?:id\d*|[a-zA-z][a-zA-Z0-9_.]{2,})[\w@^=%&amp;~+#-]).*$/,
            'Некорректная ссылка на профиль Vkontakte.',
            true
        ],
        [
            '#youtube',
            /^((?:https?:\/{2}?))?(w+\.)?(youtube\.com\/(?:channel|user)\/[a-zA-Z0-9_\-]+[\w@^=%&amp;~+#-]).*$/,
            'Некорректная ссылка на Youtube канал.',
            true
        ],
        [
            '#telegram',
            /^(@?[a-zA-Z0-9_]{5,})$/,
            'Некорректное имя пользователя Telegram.',
            false
        ],
        [
            '#whatsapp',
            /^(\+[0-9]{11,12})$/,
            'Некорректный номер Whatsapp.',
            false
        ],
        [
            '#viber',
            /^(\+[0-9]{11,12})$/,
            'Некорректный номер Viber.',
            false
        ],
        [
            '#skype',
            /^((?:live:)?[a-z0-9\.,\-_]{5,31})$/,
            'Некорректное имя пользователя Skype.',
            false
        ],
        [
            '#phone',
            /^(\+7\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2})$/,
            'Некорректный номер телефона.',
            false
        ],
    ],


//======================  Ф О Р М А   " Р Е К В И З И Т Ы " ==============================
    // скрипт для страницы с формой ПЕРСОНАЛЬНАЯ ИНФОРМАЦЯ
    checkPersonalData() {
        // проверка страницы с формой на сналичие блока "ПЕРСОНАЛЬНАЯ ИНФОРМАЦЯ"
        if ($('form').hasClass('organizer__personal-data')) { // если страница открыта, то
            // сохранит в переменные DOM-елементы для манипуляций с блоком ФАКТ-АДРЕС
            this.checkbox = $('#fact-address');
            this.elem = $('#compare');

            // 2. проверит наличие отмеченных чекбоксов и определит действие для страницы
            this.checkboxCheck();

            // 3. Проверка на принадлежность к форме для Юридического лица
            if ($('select[company_type]')) {
                // если принадлежит, то сохранит переменные для полей "Правовая форма", "Деятельность", "Номер лицензии"
                this.companyType = $('#company-type');
                this.partnerType = $('#partner-type');
                this.rtoNumber = $('#rto-number');
                this.rtoNumber.inputmask({"mask": "РТО №9{1,8}"}); // добавить маску на ввод номера лицензии "РТО №123456(7)"

                // проверит текущее значение поля "Правовая форма"
                this.companyTypeCheck(this.companyType.find('option:selected'), "Индивидуальный предприниматель", "Компания");

                // проверит текущее значение поле "Деятельность"
                this.partnerTypeCheck(this.partnerType.find('option:selected'), "Туроператор");

                // повешает слушатель события на измнение поля "Правовая форма"
                this.companyType.on('change', function () {
                    organizerFormActions.companyTypeCheck($(this).find('option:selected'), "Индивидуальный предприниматель", "Компания");
                    organizerFormActions.partnerTypeCheck(organizerFormActions.partnerType.find('option:selected'), "Туроператор");
                });

                // повешает слушатель события на измнение поля "Деятельность"
                this.partnerType.on('change', function () {
                    organizerFormActions.partnerTypeCheck($(this).find('option:selected'), "Туроператор");
                });

            }

            // 4. ПОВЕШАЕТ НА СТРАНИЦУ ОБЩИЕ СЛУШАТЕЛИ СОБЫТИЙ ДЛЯ ФЛ и ЮЛ
            // на изменение сохраненных в объекте переменных
            $(this.checkbox).on('change', function () {
                organizerFormActions.checkboxCheck();
            });

            // на изменение значения полей страна (рег/факт), то обнулит значения для инпутов города.
            $('#reg_country').on('change', function () {
                $('#reg_city_name').val('');
                $('#reg_city').val('');
                $('#reg_area').val('');
            });

            $('#fact_country').on('change', function () {
                $('#fact_city_name').val('');
                $('#fact_city').val('');
                $('#fact_area').val('');
            });

            // добавит метод autocomplete для поля АДРЕС РЕГСИТРАЦИИ
            $('#reg_city_name').autocomplete({
                source: function (data, response) {
                    ajaxOrganizerCity.regCityAutocomplete(data, response, $('#reg_country'));
                },
                select: function (event, ui) {  // Триггер срабатывает после выбора элемента.
                    $('#reg_city').val(ui.item.city_id);
                    $('#reg_area').val(ui.item.area_id);
                },
                autoFocus: true, // Подсвечивает первый элемент.
                delay: 300,  // Задержка после ввода.
            });

            // добавит метод autocomplete для поля ФАКТИЧЕСКИЙ АДРЕС
            $('#fact_city_name').autocomplete({
                source: function (data, response) {
                    ajaxOrganizerCity.factCityAutocomplete(data, response, $('#fact_country'));
                },
                select: function (event, ui) {   // Триггер срабатывает после выбора элемента.
                    $('#fact_city').val(ui.item.city_id);
                    $('#fact_area').val(ui.item.area_id);
                },
                autoFocus: true,  // Подсвечивает первый элемент.
                delay: 300,   // Задержка после ввода.
            });

            $('#reg_city_name, #fact_city_name').on('focusin', function () {
                cityChange.cityFocus($(this)); // очистить все value для полей city
            }).on('change', function () {
                cityChange.cityCheckSelected($(this)); // проверить input:hidden на заполненность
            });
        }
    },

    // только для формы "Реквизиты организации": проверка выбранного значения в input "Правовая форма"
    companyTypeCheck(elem, text, value) {

        console.log(organizerFormActions.partnerType.find('option:contains(' + value + ')'));

        if (elem.text() !== text && elem.val() !== '') {
            organizerFormActions.partnerType.parents('.organizer__info-field').removeClass('hide-element');
        } else if (elem.text() === text) {
            organizerFormActions.partnerType.parents('.organizer__info-field').addClass('hide-element');
            organizerFormActions.partnerType.find('option').prop('selected', false);
            organizerFormActions.partnerType.find('option:contains(' + value + ')').prop('selected', true);
        }
    },

    // только для формы "Реквизиты организации": проверка выбранного значения в input "Деятельность"
    partnerTypeCheck(elem, text) {

        (elem.text() === text)
            ? organizerFormActions.rtoNumber.attr('required', true).parent().removeClass('hide-element')
            : organizerFormActions.rtoNumber.attr('required', false).val('').parent().addClass('hide-element');
    },

    // проверяет параметр checked у чекбокса #fact-address и определяет повдение динамических полей формы
    checkboxCheck() {

        (this.checkbox.prop('checked') === true) ? this.checkedTrue() : this.checkedFalse()
    },

    // действия на скрытие поля ФАКТ-АДРЕС
    checkedTrue() {

        this.elem.addClass('hide-element');
        this.switchRequired(this.elem, false);
    },

    // действия на показ поля ФАКТ-АДРЕС
    checkedFalse() {

        this.elem.removeClass('hide-element'); // показать блок
        this.switchRequired(this.elem, true);  // включить атрибут "required"
        //$.each(this.elem.find('input'), function () {
        //    $(this).val('');  // очистить поля формы
        //});
    },

    // переименовывает required атрибуты тегов формы в зависимости от переданного значения
    switchRequired(elem, prop) {

        elem.find('#fact_country').attr('required', prop);
        elem.find('#fact_city_name').attr('required', prop);
        elem.find('#fact-address').attr('required', prop);
    },

//====================== Ф О Р М А   " К О Н Т А К Т Ы " ==============================
    // скрипт для страницы с формой КОНТАКТЫ
    emptyContactsCheck() {
        // проверка страницы с формой на сналичие блока "КОНТАКТЫ"
        if ($('form').hasClass('organizer__links')) {   // если страница открыта, то выполнит три действия

            // Cancel sending form data on "Enter" key.
            $('form.organizer__links').keydown(function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                }
            });

            //1. раскрасит заполненные данными поля формы
            $.each($('input'), function () {
                if ($(this).val() !== "") {  // проверяет форму контакты на предмет заполненности данными
                    organizerFormActions.contactsTrue($(this)); // если поле заполнено, подсвечивает иконку
                }
            });

            // 2. повешает слушатель события на изменение полей формы
            $('form.organizer__links input').on('focus', function () {
                organizerFormActions.contactsTrue($(this)); // если фокус на поле формы, подсвечивает иконку
            })
                .on('focusout', function () {
                    organizerFormActions.contactsFalse($(this)); // если после смены фокуса поле пустое, вернет иконке серый цвет
                });

            // 3. Вешает слушатели события на действия по валидации введенных данных
            // Add masks and handlers to the contact form inputs.
            $('#whatsapp').inputmask({mask: "+9{11,12}"});
            $('#viber').inputmask({mask: "+9{11,12}"});
            $('#phone').inputmask({mask: "+7(999)999-99-99"});

            for (const validationItem of this.validationRulesArr) {
                const input = $(validationItem[0]);
                input.on('change', function () {
                    organizerFormActions.validation(
                        input,
                        validationItem[1],
                        validationItem[2],
                        validationItem[3]
                    )
                })
            }
        }
    },

    contactsTrue(elem) {
        elem.siblings('label').removeClass('empty-icon');
    },

    contactsFalse(elem) {
        if (elem.val() === "") { // при смене фокуса провеяет поле на предмет заполненности
            elem.siblings('label').addClass('empty-icon');  //если да, меняет цвет на серый
        }
    },

    /**
     * Method make validation of input value.
     * @param {string} inputSelector - input field selector
     * @param {object} regExp - regular expression
     * @param {string} msg - error message
     * @param {boolean} isUrl - url flag
     */
    validation(inputSelector, regExp, msg, isUrl) {
        const inputData = inputSelector.val().trim();
        if (inputData === '') {
            return;
        }

        const match = inputData.match(regExp);
        if (match !== null) {
            let matchStr = (typeof match[1] !== 'undefined') ? match[1] : (isUrl ? 'http://' : '');
            matchStr += (isUrl && typeof match[2] !== 'undefined' && match[2].length === 4) ? match[2] : '';
            matchStr += isUrl ? match[3] : '';

            inputSelector.val(matchStr);
            inputSelector.removeClass('form-red-outline');
        } else {
            oftenUsed.dialogMessageCall(msg);
            inputSelector.val('');
            inputSelector.addClass('form-red-outline');
        }
    },
};


(function ($) {
    $(document).ready(function () {

        // заменить цвет бэкграунда страницы с серого на белый
        $('.center').addClass('organizer__edit');

        // если открыта форма редактирования реквизитов \ персональных данных
        organizerFormActions.emptyContactsCheck();

        // если открыта форма редактирования контактов
        organizerFormActions.checkPersonalData();

    });
})
(jQuery);