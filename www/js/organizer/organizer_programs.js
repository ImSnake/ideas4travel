"use strict";

const programsObject = {

    //programId: null,
    programName: $('#program-name'),
    errorClass: $(".form-comment"),

    createNewBox: $('#create-new-name'),
    boxHeader: $('#create-new-name h2'),
    boxInputHeader: $('#create-new-name .info-field__head'),
    boxButton: $('#create-new-name button'),

    // определить действие: "Создать" или "Дублировать", сформировать наполнение и открыть поп-ап
    checkPopUpAction(elem){

        if (elem.attr('id') === 'create-new'){
            console.log('нажали "Создать"');

            this.boxHeader.html('Создать программу путешествия');
            this.boxInputHeader.html('название программы');
            this.boxButton.attr('id', 'submit_create_program');
        }

        else if (elem.hasClass('submit_duplicate_program')) {
            console.log('нажали "Дублировать"');

            this.boxHeader.html('Создать копию программы<br><span>' + elem.parents('.program-box').find('.program__name').text() + '</span>');
            this.boxHeader.attr('data-program-id', elem.parents('.program-box').attr('data-program-id'));
            this.boxInputHeader.html('название для новой программы');
            this.boxButton.attr('id', 'submit_duplicate_program');
        }

        this.createNewBox.removeClass('hide-element');
        //oftenUsed.scrollToTop($("html, body"));
        oftenUsed.bodyFix($('body'));
    },

    // определить действие при клике по кнопке Далее ("создать" или "дублировать") и запустить соответсвующий скрипт
    checkAjaxAction(elem, e){

        e.preventDefault();

        if (elem.attr('id') === 'submit_create_program'){
            console.log('выполнить действие "Создать программу"');
            ajaxObject.createNewProgram();
        }
        else if (elem.attr('id') === 'submit_duplicate_program'){
            console.log('выполнить действие "Дублировать программу"');
            ajaxObject.createDuplicateProgram(this.boxHeader.attr('data-program-id'));
        }
    },

    // запрос на подтверждение действия "Удалить программу" + скрипт для последующих действий
    confirmDeleteProgramAction(elem){

        let program_name = elem.parents('.program-box').find('.program__name').text();
        let program_id = elem.parents('.program-box').attr('data-program-id');

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Удалить программу<span class="title_m">"' + program_name + '"?</span>',
            content: 'Программа и сохраненная в ней информация будут удалены безвозвратно',
            type: 'blue',
            buttons: {
                ok:{
                    text: "Удалить",
                    btnClass: 'btn-blue',
                    action: function(){
                        ajaxObject.deleteProgram(program_id);
                    }},
                no:{
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){}
                    }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

    // запрос на подтверждение действия "Архивировать программу"
    confirmArchiveProgramAction(elem){

        let program_name = elem.parents('.program-box').find('.program__name').text();
        let program_id = elem.parents('.program-box').attr('data-program-id');

        $.confirm({
            bgOpacity: "0.6",
            boxWidth: '90%',
            useBootstrap: false,
            draggable: false,
            title: 'Архивировать программу <span class="title_m">"' + program_name + '"?</span>',
            content: 'Программа и связанные с ней туры будут перемещены в архив.',
            type: 'blue',
            buttons: {
                ok:{
                    text: "Архивировать",
                    btnClass: 'btn-blue',
                    action: function(){
                        ajaxObject.archiveProgram(program_id);
                    }},
                no:{
                    text: "Отмена",
                    btnClass: 'btn-grey',
                    cancel: function(){}
                }},
            onOpenBefore: function(){ oftenUsed.bodyFix($('body')) }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function(){ oftenUsed.bodyScroll($('body')) },  // при закрытии возвращает body прежние настройки
        });
    },

};

(function ($) {
    $(document).ready(
        function () {

// !!! СТРАНИЦА PROGRAMS !!! --------------------------------------------------------

            // определить действие: "Создать" или "Дублировать", сформировать наполнение и открыть поп-ап
            $('#create-new, .submit_duplicate_program').on('click', function () {
                programsObject.checkPopUpAction($(this));
            });

            // закрыть поп-ап "Создать"
            $('#create-new-name .close-pop-up').on('click', function () {
                $(this).parent().closest('.body-disable').addClass('hide-element'); // убрать затемнение контента
                oftenUsed.bodyScroll($('body')); // позволить прокрутку содержимого для страницы
                $(this).siblings('form').find('input').val(''); // очистить input c названием новой программы
                programsObject.errorClass.text(""); // очистить форму для комментария
            });

            // определить действие: "Создать" или "Дублировать" при клике по кнопке "Далее" в поп-ап "Создать"
            $('#create-new-name').on('click', 'button', function(e){
                programsObject.checkAjaxAction($(this), e);
            });

            // удалить Программу
            $('.link_delete_program').on('click', function(){
                programsObject.confirmDeleteProgramAction($(this));
            });

            // архивировать Программу
            $('.link_archive_program').on('click', function(){
                programsObject.confirmArchiveProgramAction($(this));
            });

            // создать Тур для выбранной программы
            $('.add-new-date').on('click', function () {
                $(this).closest('.program__image').siblings('.program__info').children('.program__name').clone()
                    .addClass('clone').appendTo('#add-new-date .group'); // добавить в блок название Программы
                $('#add-new-date input[type=hidden]').val($(this).closest('.program-box').attr('data-program-id')); // передать id Программы
                $('#add-new-date').removeClass('hide-element'); // показать блок
                oftenUsed.bodyFix($('body'));
            });

        });
})

(jQuery);
