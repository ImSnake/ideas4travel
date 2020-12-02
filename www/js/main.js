"use strict";

(function ($) {
    $(document).ready(
        function () {

            //выпадающее меню для user
            $('.header__user div').on('click', (function () {
                $(this).children('.fade').fadeToggle(50, 'linear');
            }));

//TODO на мобилках эффект не работает! Искать решение
            $('.menu-list').on('mouseleave', (function () {
                $(this).fadeOut(500, 'linear');
            }));

            // показать\скрыть элементы типа (?) и другие скрытые элементы, содержащие класс "hover";
            $('.hover').on('click', function (event) {
                if (event.target.classList.contains('help')) {
                    $(this).children().removeClass('hide-element');
                }
                if (event.target.classList.contains('close-pop-up') || event.target.tagName === 'A'){
                    $(this).children('.fade').addClass('hide-element');
                }
                if (event.target.classList.contains('fade-menu')) {
                    $(this).children('.fade').fadeToggle(50, 'linear');
                }
            });


        });


})

(jQuery);
