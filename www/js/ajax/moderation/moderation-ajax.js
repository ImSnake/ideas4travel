const ajaxModerationObject = {

    // Одобрение тура.
    approveProgram(program_id) {
        $.ajax({
            url: window.location.origin + '/ajax/program-approve',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: program_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    alert('Программа одобрена');
                    window.location.reload();
                    // window.location.href = window.location.origin + '/tours';
                    // $deleteBox.remove();
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // Отклонение тура.
    rejectProgram(program_id, comment) {
        if (comment === '') {
            alert('Укажите причину отклонения');
            return;
        }

        $.ajax({
            url: window.location.origin + '/ajax/program-reject',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: program_id,
                comment: comment,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.reload();
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // Одобрение тура.
    approvePartner(partner_id) {
        $.ajax({
            url: window.location.origin + '/ajax/partner-approve',
            method: 'POST',
            dataType: 'json',
            data: {
                partner_id: partner_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    alert('Профиль партнера одобрен');
                    window.location.reload();
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // Отклонение партнера.
    rejectPartner(partner_id, comment) {
        if (comment === '') {
            alert('Укажите причину отклонения');
            return;
        }

        $.ajax({
            url: window.location.origin + '/ajax/partner-reject',
            method: 'POST',
            dataType: 'json',
            data: {
                partner_id: partner_id,
                comment: comment,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.reload();
                }
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
    $('#program-moderation').on('click', '#button-approve', function(e) {
        let program_id = $(this).
            parents('#program-moderation').
            data('programId');
        ajaxModerationObject.approveProgram(program_id);
    });

    $('#program-moderation').on('click', '#button-reject', function(e) {
        let program_id = $(this).
            parents('#program-moderation').
            data('programId');
        let comment = $(this).
            parents('#program-moderation').
            find('#moderation__comment').
            val();
        console.log(program_id);
        console.log(comment);
        ajaxModerationObject.rejectProgram(program_id, comment);
    });

    // Подтверждение профиля партнера
    $('#partner-moderation').on('click', '#button-approve', function(e) {
        let partner_id = $(this).
            parents('#partner-moderation').
            data('partnerId');
        ajaxModerationObject.approvePartner(partner_id);
    });

    // Отклонение профиля партнера
    $('#partner-moderation').on('click', '#button-reject', function(e) {
        let partner_id = $(this).
            parents('#partner-moderation').
            data('partnerId');
        let comment = $(this).
            parents('#partner-moderation').
            find('#moderation__comment').
            val();
        console.log(partner_id);
        console.log(comment);
        ajaxModerationObject.rejectPartner(partner_id, comment);
    });

});