"use strict";

const navSettings = {

    // Переключение класса active-link в зависимости от открытой страницы organizer
    // 1) находит в DOM блок с классом 'back-n-wrap'
    // 2) забирает из него значение атрибута data- в переменную
    // 3) сравнивает полученное значение с "id" в навигации
    // 4) добавляет класс active-link идентичному элементу
    checkScreen() {
        let page = "#" + $('.back-n-wrap').attr('data-page') + "-head";
        $(page).addClass('active-link');

        // НАВИГАЦИЯ ДЛЯ organizer.php
        // если страница = organizer.php, запуск скрипта для отображения элементов на странице
        if ($('#profile-head').hasClass('active-link')) {
            //смена значения атрибута "а" в навигации
            $('#profile-head a').removeAttr('href').attr('name', 'organizer-profile');
            //запуск алгоритма отображения страницы для мобайл
            $('#nav-organizer').removeClass('hide-element');
        }
    },

// НАВИГАЦИЯ ДЛЯ МОБИЛОК для organizer.php
// логика поведения элементов для мобильных устройств при клике по меню навигации "Профиль"
// отвечает за открытие\скрытие элемента "Профиль организатора"

    // поведение блока profile.php при изменении ширины экрана
    screenSizeCheck(){
        if (window.matchMedia('all and (max-width: 631px)').matches) {
            $('#partner-profile, #nav-organizer').addClass('hide-element');
            $('#organizer-profile').removeClass('hide-element');
        }
    },

    // поведение блока profile.php при клике по "назад"
    backNWrapAction(){
        if (window.matchMedia('all and (max-width: 631px)').matches) {
            $('#nav-organizer').removeClass('hide-element');
            $('#organizer-profile').addClass('hide-element');
        }
    }
};

const uploadImage = {
    defaultImageTxt: undefined, // запоминает дефолтное значение label

    // поведение элемента input [type="file"] при добавлении файла
    checkUpload(elem, event) {
        let label = elem.next('.js-labelFile');
        let fileName = '';

        this.defaultImageTxt = label.html();
        //console.log(event.target.files.length);

        if (event.target.files.length > 1){
            fileName = event.target.files.length + ' фото';
        } else if (event.target.files.length === 1){
            fileName = event.target.value.split('\\').pop();
        }
        //if (event.target.value) fileName = event.target.value.split('\\').pop();
        fileName
            ? label.addClass('has-file').find('.js-fileName').html(fileName).siblings('.red').empty().parent().parent().siblings('button').removeClass('hide-element')
            : label.removeClass('has-file').html(this.defaultImageTxt).parent().siblings('button').addClass('hide-element');
    },

    getDefaultLabel(elem) {
        elem.addClass('hide-element').siblings('.input-btn-style').children('.js-labelFile').removeClass('has-file').html(this.defaultImageTxt);
    }
};

const cityChange = {

    // очистить все value для полей city
    cityFocus(elem) {
        // добавить единичный слушатель на событие "нажатие клавиши"
        elem.one('keydown', function () {
            $(this).siblings('input').val(''); // при нажатии клавиши очистить предыдущие значения полей city
            $(this).val('');
        });
    },

    // проверить input:hidden на заполненность
    cityCheckSelected(elem) {
        if (elem.siblings('input').val() === '') {
            elem.val(''); // если input:hidden не заполнены, сбрасывает заданное значение
        }
    },
};


(function ($) {
    $(document).ready(
        function () {
//=================================================================================================
            //TODO: Временное решение для тестирования верскти
            // ХЕДЕР: смена иконок в header с USER на PARTNER
            //$('.header__requests, .user__avatar').css('display', 'block');
            //$('.header__favorite, .user__icon').css('display', 'none');
//==============================================================================================================

//======= НАВИГАЦИЯ ДЛЯ МОБИЛОК ================================================================================
            navSettings.checkScreen();

            $('#profile-head').on('click', function () {
                navSettings.screenSizeCheck();
            });

            $('#profile-wrap a').on('click', function () {
                navSettings.backNWrapAction();
            });

//=========ПОВЕДЕНИЕ ФОРМЫ ЗАГРУЗКИ ФАЙЛОВ ======================================================================

            $('.input-file').on('change', function (event) {
                uploadImage.checkUpload($(this), event);
            });

            $('.upload-img').on('click', function () {
                uploadImage.getDefaultLabel($(this));
            });

        });
})
(jQuery);
