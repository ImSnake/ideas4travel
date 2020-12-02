"use strict";

(function ($) {
    $(document).ready(
        function () {

// !!! СТРАНИЦА ORGANIZER (profile) !!! -----------------------------------

            // показать\скрыть форму для загрузки аватара;
            $('.organizer__avatar').on('click', function (event) {
                if (event.target.tagName === 'IMG' || event.target === event.currentTarget) {
                    $(this).children('.fade').removeClass('hide-element');
                }
                if (event.target.classList.contains('close-pop-up')) {
                    $(this).children('.fade').addClass('hide-element');
                }
            });

            // загрузить аватар;
            $('#submit_upload_avatar').on('click', function() {
                avatarObj.addAvatar($('#form_upload_avatar'));
            });

            // повернуть аватары на странице на 90 градусов вправо;
            $('.turn-img').on('click', function() {
                avatarObj.rotateAvatar($(this));
            });

        });
})

(jQuery);

