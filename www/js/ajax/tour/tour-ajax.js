const ajaxTourObject = {

    // Создание нового тура.
    createNewTour() {
        $.ajax({
            url: window.location.origin + '/ajax/tour-create',
            method: 'POST',
            dataType: 'json',
            data: {
                start_at: $('#tour-start-at').val(),
                program_id: $('#add-new-date').find('#program-id').val(),
                tour_id: $('#add-new-date').find('#tour-id').val(),
            },
            beforeSend: function(formData, jqForm, options) {
                if (!$('#tour-start-at').val()) {
                    $('#add-new-date').
                        find('.form-comment').
                        text('выбери дату начала тура');
                    return false;
                }
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.href = window.location.origin +
                        '/tours/edit/' +
                        data.id;
                } else {
                    $('#add-new-date').
                        find('.form-comment').
                        html(data.error);
                }
            },
        });
    },

    // Редактирование тура.
    editTour(action = '') {
        let $tour_form_edit = $('#tour-form-edit');
        $tour_form_edit.ajaxSubmit({
            url: window.location.origin + '/ajax/tour-edit',
            type: 'POST',
            dataType: 'json',
            data: {
                tour_id: $tour_form_edit.data('tour-id'),
                action: action,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    if (action === 'save-exit') {
                        // window.location.href = window.location.origin +
                        //     '/tours';
                    } else if (action === 'publish') {
                        ajaxTourObject.publishTour(
                            $tour_form_edit.data('tour-id'));
                    }
                } else {
                    alert(data.error);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    publishTour(tour_id) {
        $.ajax({
            url: window.location.origin + '/ajax/tour-publish',
            method: 'POST',
            dataType: 'json',
            data: {
                tour_id: tour_id,
            },
            success: function(data) {
                console.log(data);
                if (data.error) {
                    alert(data.error);
                    return;
                }

                if (data.tourIsValidate) {
                    alert('Тур опубликован');
                    window.location.href = window.location.origin + '/tours';
                } else {
                    // URL страницы редактирования тура
                    let urlEditTour = window.location.origin +
                        '/tours/edit/' + tour_id;
                    if (urlEditTour === document.location.href) {
                        let errorText = 'ОШИБКИ ЗАПОЛНЕНИЯ ТУРА:' + '\r\n\r\n';
                        let tourGetError = data.tourGetError;

                        for (let i = 0; i < tourGetError.length; i++) {
                            errorText += tourGetError[i] + '\r\n\r\n';
                        }
                        alert(errorText);
                    } else {
                        let errorText = 'ХОТИТЕ ПЕРЕЙТИ НА СТРАНИЦУ РЕДАКТИРОВАНИЯ ТУРА ЧТОБЫ ИСПРАВИТЬ ОШИБКИ ЗАПОЛНЕНИЯ:' +
                            '\r\n\r\n';
                        let tourGetError = data.tourGetError;

                        for (let i = 0; i < tourGetError.length; i++) {
                            errorText += tourGetError[i] + '\r\n\r\n';
                        }

                        // Если пользователь хочет перейти на страницу редактирования тура, то перенаправляем его.
                        if (confirm(errorText)) {
                            window.location.href = urlEditTour;
                        }
                    }
                }
            },
        });
    },

    // Удалине тура.
    deleteTour($deleteBox) {
        $.ajax({
            url: window.location.origin + '/ajax/tour-delete',
            method: 'POST',
            dataType: 'json',
            data: {
                tour_id: $deleteBox.data('tourId'),
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.href = window.location.origin + '/tours';
                    // $deleteBox.remove();
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    unPublishTour() {
        $('#unpublish-tour').ajaxSubmit({
            url: window.location.origin + '/ajax/tour-unpublish',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data.post);
                window.location.reload();
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

};

// Создание нового тура.
$(document).ready(function() {

    //единый скрипт блока для cтраниц ПРОГРАММЫ и ТУРЫ :
    // при клике по кнопке "Далее" создает новый тур и делает редирект на страницу редактирования
    $('#add-new-date').on('click', 'button', function(e) {
        e.preventDefault();
        ajaxTourObject.createNewTour();
    });

    //единый скрипт блока для cтраниц ПРОГРАММЫ и ТУРЫ :
    // закрыть окно создания "Тура" и очистить контейнер с формой
    $('#add-new-date .close-pop-up').on('click', function() {
        $(this).parent().closest('.body-disable').addClass('hide-element'); //скрыть блок
        $(this).parent().find('.form-comment').text('');  //очистить комментарий с сервера
        $('#add-new-date input').val(''); //очистить значения инпутов (дата, id тура)
        $('#add-new-date .clone').remove(); //удалить название Программы
        oftenUsed.bodyScroll($('body'));
    });

    $('#unpublish-tour').on('click', 'button', function(e) {
        e.preventDefault();
        ajaxTourObject.unPublishTour();
    });

});
