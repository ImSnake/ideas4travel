"use strict";

(function ($) {

    $(document).ready(
        function () {

            //TODO: Временное решение для тестирования верскти
            // ХЕДЕР: смена иконок в header с USER на PARTNER
            $('.header__requests, .user__avatar').css('display', 'block');
            $('.header__favorite, .user__icon').css('display', 'none');


            //выпадающее меню при клике по иконке "карандаш" (редкатировать)
            $('.edit-menu').on('click', (function () {
                 $(this).children('.fade').fadeToggle(50, 'linear');
            }));

            //TODO на мобилках эффект mouseleave не работает! Искать решение
            $('.edit__menu').on('mouseleave', (function () {
                $(this).fadeOut(500, 'linear');
            }));

//=================================================================================================

            // НАВИГАЦИЯ:
            // Переключение класса active-link в зависимости от открытой страницы organizer
            // 1) находит в DOM блок с классом 'back-n-wrap'
            // 2) забирает из него значение атрибута data- в переменную
            // 3) сравнивает полученное значение с "id" в навигации
            // 4) добавляет класс active-link идентичному элементу
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

            // НАВИГАЦИЯ ДЛЯ МОБИЛОК для organizer.php
            // логика поведения элементов для мобильных устройств при клике по меню навигации "Профиль"
            // отвечает за открытие\скрытие элемента "Профиль организатора"
            $('#profile-head').click(function () {
                if (window.matchMedia('all and (max-width: 630px)').matches) {
                    $('#partner-profile, #nav-organizer').addClass('hide-element');
                    $('#organizer-profile').removeClass('hide-element');
                }
            });

            // закрытие элемента "Профиль организатора" при клике
            $('#profile-wrap').click(function () {
                if (window.matchMedia('all and (max-width: 629px)').matches) {
                    $('#nav-organizer').removeClass('hide-element');
                    $('#organizer-profile').addClass('hide-element');
                }
            });
        });

})

(jQuery);