"use strict";

(function ($) {
    $(document).ready(
        function () {

// !!! СТРАНИЦА ORGANIZER (profile) !!! -----------------------------------

            function checkDefaultAvatar () {
                // получить путь к img
                let img = $('.organizer__avatar img').attr('src');
                // если подстрока содержит имя дефолтного аватара 'avatar.png', добавляет класс "add_avatar" (плюсик справа)
                if (img.indexOf('avatar.png') > -1) {
                    $('.organizer__avatar').addClass('add_avatar');
                }
            }

            // проверить аватар пользователя, если аватар не установлен, добавит плюс к дефолтному img
            checkDefaultAvatar();

            // показать\скрыть форму для загрузки аватара;
            $('.organizer__avatar').on('click',function (event) {
                if (event.target.tagName === 'IMG'|| event.target === event.currentTarget){
                    $(this).children('.fade').removeClass('hide-element');
                }
                if (event.target.classList.contains('close-pop-up')){
                    $(this).children('.fade').addClass('hide-element');
                }
             });


            // ПРОФИЛЬ\Реквизиты: поведение чекбоксов при совпадении юр и факт адреса (скрыть\показать)
            $('#fact-address').click(function () {
                $('#compare').fadeToggle('400', 'swing');
            });

        });
})

(jQuery);
