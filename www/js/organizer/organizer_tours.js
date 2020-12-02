"use strict";

const toursObj = {

};


(function ($) {
    $(document).ready(
        function () {

            // Меню тура: действие "Опубликовать тур"
            $('.blue.publish-tour').on('click', function () {
                ajaxTourObject.publishTour($(this).parents('.group').attr('data-tour-id'));
            });

            // Меню тура: действие "Снять с публикации"
            $('.red.finish-tour').on('click', function () {
                $('#finish-tour').removeClass('hide-element'); //открыть блок "Снять тур с публикации"
                $("#finish-tour-id").val($(this).parents('.group').attr('data-tour-id')); //передать id-тура
                oftenUsed.bodyFix($('body'));
            });

            //блок "Снять с публикации", действие "Снять с публикации"
            $('#finish-tour .btn-orange').on('click', function () {
                console.log($("#finish-tour-id").val());
            });

            // закрыть блок "Причина снятия с публикации"
            $('#finish-tour .close-pop-up').on('click', function () {
                $(this).parent().closest('.body-disable').addClass('hide-element');
                //TODO очистить инпуты
                oftenUsed.bodyScroll($('body'));
            });

            // Дублировать тур: открыть блок "Дата начала тура" и добавить в него название Программы
            $('.duplicate-tour').on('click', function () {
                $(this).parents().eq(4).siblings('.tours-table__program').children('.tours-table__program-name')
                    .clone().addClass('clone').css('display', 'block').appendTo($('#add-new-date .group'));
                $('#program-id').val($('#add-new-date .clone').attr('data-program-id'));
                $('#tour-id').val($(this).parents('.group').attr('data-tour-id'));
                $('#add-new-date').removeClass('hide-element');
                oftenUsed.bodyFix($('body'));
            });


            $('.delete-tour').on('click', function(e) {
                let $deleteBox = $(this).parents('.group');
                ajaxTourObject.deleteTour($deleteBox);
            });

            // действие на кнопку "Добавить тур" - открыть блок "Создать тур к программе"
            $('#create-new').on('click', function () {
                $('#create-new-tour').removeClass('hide-element'); //открыть блок "Создать тур из программы"
                oftenUsed.bodyFix($('body'));
            });

            // закрыть блок "Создать тур к программе"
            $('#create-new-tour .close-pop-up').on('click', function () {
                $(this).parent().closest('.body-disable').addClass('hide-element');
                oftenUsed.bodyScroll($('body'));
            });

            // Создать тур: открыть блок "Дата начала тура" и добавить в него название Программы!!
            $('.programs-table .btn-blue').on('click', function () {
                $(this).parent().siblings('.programs-table__info').children('.programs-table__name')
                    .clone().addClass('clone').appendTo($('#add-new-date .group')); // добавить в блок название Программы
                $('#program-id').val($('#add-new-date .clone').attr('data-program-id')); // передать id Программы
                $('#tour-id').val($('#add-new-date .clone').attr('data-tour-id')); // передать id Программы
                $('#add-new-date').removeClass('hide-element');
            });

        });

})

(jQuery);
