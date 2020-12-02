
const ajaxOrganizerCity  = {

    // вызов функции Autocomplete для АДРЕС РЕГИСТРАЦИИ
    regCityAutocomplete(data, response, country){

        $.ajax({
            url: window.location.origin + '/ajax/autocomplete-reg-fact',
            method: 'POST',
            dataType: 'json',
            data: {
                name: data.term,
                country: country.val()
            },
            success: function (res) {
                let result;
                result = [
                    {
                        label: 'Город "' + data.term + '" не найден',
                        value: ''
                    }];
                if (res.length) {
                    result = $.map(res, function (name) {
                        return {
                            label: name[0],
                            value: name[0],
                            city_id: name[1],
                            area_id: name[2]
                        }
                    })
                }
                response(result);
            }
        });
    },

    // вызов функции Autocomplete для ФАКТИЧЕСКИЙ АДРЕС
    factCityAutocomplete(data, response, country){

        $.ajax({
            url: window.location.origin + '/ajax/autocomplete-reg-fact',
            method: 'POST',
            dataType: 'json',
            data: {
                name: data.term,
                country: country.val()
            },
            success: function (res) {
                let result;
                result = [
                    {
                        label: 'Город "' + data.term + '" не найден',
                        value: ''
                    }];
                if (res.length) {
                    result = $.map(res, function (name) {
                        return {
                            label: name[0],
                            value: name[0],
                            city_id: name[1],
                            area_id: name[2]
                        }
                    })
                }
                response(result)
            }
        });
    },
};