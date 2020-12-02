const ajaxObjectOrganizer = {
    goToModeration(partner_id) {
        $.ajax({
            url: window.location.origin + '/ajax/partner-moderation',
            method: 'POST',
            dataType: 'json',
            data: {
                partner_id: partner_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.reload();
                } else {
                    oftenUsed.dialogMessageCall(data.error);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    }
};

$(document).ready(function() {

    // Слушатель для кнопки "Подтвердить профиль"
    $('#button_partner_moderation').on('click', function () {
        ajaxObjectOrganizer.goToModeration($('#organizer-profile').data('partnerId'));
    });

});