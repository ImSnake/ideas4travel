"use strict";

(function ($) {
    $(document).ready(
        function () {

            // при ошибке валидации подсвечивает красной тенью поле ввода с ошибкой
            $.each($('.form-comment'), function () {
                if ($(this).hasClass('red')) {
                    $(this).siblings('input').addClass('input_inner_shadow');
                }
            });

        });

})
(jQuery);