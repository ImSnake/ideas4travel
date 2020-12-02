"use strict";

(function ($) {
    $(document).ready(
        function () {

            $("#phone").inputmask({"mask": "+7 (999) 999-99-99"}); // "+9[9] (999) 999-99-99"

            $("#add-password, #repeat-password").inputmask({ regex: "[^а-яА-ЯЁё]*" }); // исклоючить кирилицу при создании пароля

        });
})
(jQuery);