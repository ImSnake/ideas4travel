const tourGetContacts = {

    getOrganizerContacts(e) {

        $.ajax({
            url: window.location.origin + '/ajax/show-contact-in-preview',
            method: 'POST',
            dataType: 'html',
            data: {
                program_id: $('#show-contacts').attr('data-program-id'),
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    $('.contacts__details').append(data);
                } else {
                    $('.contacts__details').text(data.error);
                }
            },
        });
    },

};