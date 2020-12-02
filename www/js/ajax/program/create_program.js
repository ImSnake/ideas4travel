'use strict';

const ajaxObject = {

//===== P R O G R A M S   P A G E ==================================================//

    // ПРОГРАММЫ / СОЗДАТЬ скрипт для создания новой программы с проверкой на уникальность названия
    createNewProgram() {

        $.ajax({
            url: window.location.origin + '/ajax/program-create',
            method: 'POST',
            dataType: 'json',
            data: {
                name: programsObject.programName.val(),
            },
            beforeSend: function(formData, jqForm, options) {
                if (!programsObject.programName.val()) {
                    programsObject.errorClass.text(
                        'Название программы не может быть пустым');
                    return false;
                }
            },
            success: function(data) {
                if (!data.error) {
                    window.location.href = window.location.origin +
                        '/programs/edit/' +
                        data.id;
                } else {
                    programsObject.errorClass.text(data.error);
                }
            },
        });
    },

    // ПРОГРАММЫ / ДУБЛИРОВАТЬ скрипт для создания новой программы путем копирования
    createDuplicateProgram(program_id) {
        console.log('duplicate');

        $.ajax({
            url: window.location.origin + '/ajax/program-duplicate',
            method: 'POST',
            dataType: 'json',
            data: {
                name: programsObject.programName.val(),
                program_id: program_id,
            },
            beforeSend: function(formData, jqForm, options) {
                if (!programsObject.programName.val()) {
                    programsObject.errorClass.text(
                        'Название программы не может быть пустым');
                    return false;
                }
            },
            success: function(data) {
                if (!data.error) {
                    console.log(data);
                    window.location.href = window.location.origin +
                        '/programs/edit/' +
                        data.id;
                } else {
                    programsObject.errorClass.text(data.error);
                }
            },
        });
    },

    // ПРОГРАММЫ / УДАЛИТЬ: метод для удаления программы со всей сохраненной информацией
    deleteProgram(program_id) {
        $.ajax({
            url: window.location.origin + '/ajax/program-delete',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: program_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.href = window.location.origin +
                        '/programs';
                } else {
                    oftenUsed.dialogMessageCall(data.error);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // ПРОГРАММЫ / АРХИВИРОВАТЬ: метод для архивирования программы.
    archiveProgram(program_id) {
        $.ajax({
            url: window.location.origin + '/ajax/program-archive',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: program_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.href = window.location.origin +
                        '/programs';
                } else {
                    oftenUsed.dialogMessageCall(data.error);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

//===== E D I T   P R O G R A M    P A G E ==================================================//

    // save description
    editProgramDescription(href) {
        console.log('Сохранение информации со страницы: description');

        // если в функцию пришел параметр elem и он соответсвует объекту, то после отработки запроса следует покинуть страницу
        if (typeof href === 'string') {
            var exit = true;
        }

        $('#program-form-edit-description').ajaxSubmit({
            url: window.location.origin + '/ajax/program-edit-description',
            type: 'POST',
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
            },
            success: function(data) {
                console.log(data.post);
                // если переменная exit существует, выполнить скрипт на закрытие страницы
                //if(exit){ navNewProgram.exitEditProgram(elem); }
                if (exit) { window.location.href = href; }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // save plan-by-days
    editProgramPlanByDays(href) {
        console.log('Сохранение информации со страницы: plan-by-days');

        // если в функцию пришел параметр elem и он соответсвует объекту, то после отработки запроса следует покинуть страницу
        if (typeof href === 'string') {
            var exit = true;
        }

        $('#program-form-edit-plan-by-days').ajaxSubmit({
            url: window.location.origin + '/ajax/program-edit-plan-by-days',
            type: 'POST',
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
            },
            success: function(data) {
                console.log(data.post);
                // если переменная exit существует, выполнить скрипт на закрытие страницы
                if (exit) { window.location.href = href; }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // save gallery
    editProgramGallery(href) {
        console.log('Сохранение информации со страницы: gallery');

        // если в функцию пришел параметр elem и он соответсвует объекту, то после отработки запроса следует покинуть страницу
        if (typeof href === 'string') {
            var exit = true;
        }

        $('#program-form-edit-gallery').ajaxSubmit({
            url: window.location.origin + '/ajax/program-edit-gallery',
            type: 'POST',
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
            },
            success: function(data) {
                console.log(data.post);
                // если переменная exit существует, выполнить скрипт на закрытие страницы
                if (exit) { window.location.href = href; }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // save additional
    editProgramAdditional(href) {
        console.log('Сохранение информации со страницы: additional');

        // если в функцию пришел параметр elem и он соответсвует объекту, то после отработки запроса следует покинуть страницу
        if (typeof href === 'string') {
            var exit = true;
        }

        $('#program-form-edit-additional').ajaxSubmit({
            url: window.location.origin + '/ajax/program-edit-additional',
            type: 'POST',
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
            },
            success: function(data) {
                console.log(data.post);
                // если переменная exit существует, выполнить скрипт на закрытие страницы
                if (exit) { window.location.href = href; }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // ПРОГРАММА: НАЗВАНИЕ при смене названия программы проверка нового названия на уникальность
    uniqueNameInDescription(elem) {

        let nameNew = elem;

        $.ajax({
            url: window.location.origin + '/ajax/program-name-unique',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
                name: nameNew.val(),
            },
            beforeSend: function(formData, jqForm, options) {
                if (!nameNew.val()) {
                    oftenUsed.dialogMessageCall(
                        'Название программы не может быть пустым');
                    nameNew.val(nameNew.attr('data-program-name'));
                    return false;
                }
                if (nameNew.val().length > 100) {
                    oftenUsed.dialogMessageCall(
                        'Новое название слишком длинное.<br>Сократи текст до 100 символов.');
                    nameNew.val(nameNew.attr('data-program-name'));
                    return false;
                }
            },
            success: function(data) {
                if (data.error) {
                    oftenUsed.dialogMessageCall(data.error);
                    nameNew.val(nameNew.attr('data-program-name'));
                } else {
                    nameNew.attr('data-program-name', nameNew.val());
                }
            },
        });
    },

    // вызов функции Autocomplete для СТАРТ-ГОРОД
    startCityAutocomplete(data, response, country) {
        //console.log('start city autocomplete function start');

        $.ajax({
            url: window.location.origin + '/ajax/autocomplete-reg-fact',
            method: 'POST',
            dataType: 'json',
            data: {
                name: data.term,
                country: country,
            },
            success: function(res) {
                let result;
                result = [
                    {
                        label: 'Город "' + data.term + '" не найден',
                        value: '',
                    },
                ];

                if (res.length) {
                    result = $.map(res, function(name) {
                        return {
                            label: name[0],
                            value: name[0],
                            city_id: name[1],
                            area_id: name[2],
                        };
                    });
                }

                response(result);
            },
        });
    },

    // вызов функции Autocomplete для ФИНИШ-ГОРОД
    finishCityAutocomplete(data, response, country) {
        //console.log('finish city autocomplete function start');

        $.ajax({
            url: window.location.origin + '/ajax/autocomplete-reg-fact',
            method: 'POST',
            dataType: 'json',
            data: {
                name: data.term,
                country: country,
            },
            success: function(res) {
                let result;
                result = [
                    {
                        label: 'Город "' + data.term + '" не найден',
                        value: '',
                    },
                ];

                if (res.length) {
                    result = $.map(res, function(name) {
                        return {
                            label: name[0],
                            value: name[0],
                            city_id: name[1],
                            area_id: name[2],
                        };
                    });
                }

                response(result);
            },
        });
    },

    // вызов функции Autocomplete для ФИНИШ-ГОРОД
    dayCityAutocomplete(data, response, country) {

        $.ajax({
            url: window.location.origin + '/ajax/autocomplete-reg-fact',
            method: 'POST',
            dataType: 'json',
            data: {
                name: data.term,
                country: country,
            },
            success: function(res) {
                let result;
                result = [
                    {
                        label: 'Город "' + data.term + '" не найден',
                        value: '',
                    },
                ];

                if (res.length) {
                    result = $.map(res, function(name) {
                        return {
                            label: name[0],
                            value: name[0],
                            city_id: name[1],
                            area_id: name[2],
                        };
                    });
                }

                response(result);
            },
        });
    },

    // загрузка заглавного фото Программы
    uploadMainImage(e, form, imgBox, errorBox) {

        form.ajaxForm({
            url: window.location.origin + '/ajax/upload-gallery-photo',
            resetForm: true,
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
                partner_id: navNewProgram.partnerId,
                type: 'main',
            },
            success: function(data) {
                console.log(data);
                $.each(data.response, function(index, value) {
                    console.log(value.error);
                    // если есть ошибки, то выводим блок с ошибками, если ошибок нет,
                    // то скраваем блок с ошибками и выводим блок кадрирования
                    if (value.error !== null) {
                        errorBox.html(value.error);
                    } else {
                        errorBox.html('');
                        imgBox.html('');
                        imgBox.append(
                            '<div class="image-result__delete"><span class="turn-img"></span><span class="delete-clone"></span><img src="../../images/tours/' +
                            data.partner_id + '/' + data.program_id +
                            '/middle/' + value.name +
                            '" alt="img-middle-template"></div>').
                            siblings().
                            addClass('hidden');
                    }
                });
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // загрузка карты Программы
    uploadMapImage(e, form, imgBox, errorBox) {

        form.ajaxForm({
            url: window.location.origin + '/ajax/upload-gallery-photo',
            resetForm: true,
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
                partner_id: navNewProgram.partnerId,
                type: 'map',
            },
            success: function(data) {
                console.log(data);
                $.each(data.response, function(index, value) {
                    console.log(value);
                    // если есть ошибки, то выводим блок с ошибками, если ошибок нет,
                    // то скраваем блок с ошибками и выводим блок кадрирования
                    if (value.error !== null) {
                        errorBox.html(value.error);
                    } else {
                        errorBox.html('');
                        imgBox.html('');
                        imgBox.append(
                            '<div class="image-result__delete"><span class="turn-img"></span><span class="delete-clone"></span><img src="../../images/tours/' +
                            data.partner_id + '/' + data.program_id +
                            '/middle/' + value.name +
                            '" alt="img-middle-template"></div>').
                            siblings().
                            addClass('hidden');
                    }
                });
            },
        });
    },

    // загрузка фото-архива !iconClass нужен для рендера манипуляционных иконок: (Х)(V)
    // если Фото-архив был вызван из План по дням, то иконка (Х), Если из Галереи - (Х)
    uploadPhotoArchive(e, form, imgBox, iconClass, errorBox) {
        console.log('start upload');
        // показать прелоадер, скрыть кнопку загрузки фото
        form.children('.input-btn-style').
            addClass('hidden').
            parent().
            prepend('<div class="preloader"></div>');

        form.ajaxForm({
            url: window.location.origin + '/ajax/upload-gallery-photo',
            resetForm: true,
            dataType: 'json',
            data: {
                program_id: navNewProgram.programId,
                partner_id: navNewProgram.partnerId,
                type: '0',
            },
            success: function(data) {
                console.log(data);

                if (data.error && data.error === 'limit') {
                    errorBox.html('загружено 28 фото');
                    return;
                }
                $.each(data.response, function(index, value) {
                    // если есть ошибки, то выводим блок с ошибками, если ошибок нет,
                    // то скраваем блок с ошибками и выводим блок кадрирования
                    if (value.error !== null) {
                        errorBox.append('<div><u>Файл ' + value.name_source +
                            '</u>:<br>' + value.error + '</div>');
                    } else {
                        errorBox.html('');
                        imgBox.append(
                            '<div class="image-result__delete"><span class="turn-img"></span><span class=' +
                            iconClass
                            + '></span><img src="../../images/tours/' +
                            data.partner_id + '/' + data.program_id
                            + '/mini/' + value.name +
                            '" alt="img-mini-gallery" data-img-name="' +
                            value.name + '"></div>');
                    }
                });
                // скрыть прелоадер, показать кнопку загрузки фото
                console.log(form.children('.input-btn-style').
                    removeClass('hidden').
                    siblings('.preloader').
                    remove());
                galleryObject.updateImgCounter(); // обновить информацию о кол-ве загруженных фото в ФОТО-АРХИВЕ
            },
            uploadProgress: function(data) {
                console.log(data);
            },
        });
    },

    //TODO сделать проверку на принадлежность картинки (главная или карта) до запуска запроса
    deleteGalleryImg(elem) {
        console.log('удаляем картинку');

        let element = elem.parent('.image-result__delete');
        let src = element.find('img').attr('src');
        let nameFile = src.split('/').pop();

        $.ajax({
            url: window.location.origin + '/ajax/program-delete-photo',
            method: 'POST',
            dataType: 'json',
            data: {
                name: nameFile,
            },
            success: function(data) {
                console.log(data);
                $(element).remove();
                // действия после удаления фото в зависимости от его типа: если тип "Заглавное фото" или "Карта" - загрузить дефолтную картинку
                (data.type === 'main') ? galleryObject.mainImgBox.html('').
                        append(
                            '<img src="../../images/tours/default/mini/tour_default.jpg" alt="img-mini-template">').
                        siblings().
                        removeClass('hidden')
                    : (data.type === 'map') ? galleryObject.mapImgBox.html('').
                        append(
                            '<img src="../../images/tours/default/mini/map_default.png">').
                        siblings().
                        removeClass('hidden')
                    : galleryObject.updateImgCounter(); // иначе, обновить информацию о кол-ве загруженных фото в ФОТО-АРХИВЕ
                /*
                if (data.type === 'main') {
                    galleryObject.mainImgBox.html('')
                        .append('<img src="../../images/tours/default/mini/tour_default.jpg" alt="img-mini-template">');
                }
                if (data.type === 'map') {
                    galleryObject.mapImgBox.html('')
                        .append('<img src="../../images/tours/default/mini/map_default.png">');
                }
                if (data.type === ""){
                    galleryObject.updateImgCounter(); // обновить информацию о кол-ве загруженных фото в ФОТО-АРХИВЕ
                }
                */

            },
        });
    },

    rotateImg(imgName, elem) {
        console.log(imgName);
        // скрыть отображение кнопки "Повернуть"
        elem.css('display', 'none');

        $.ajax({
            url: window.location.origin + '/ajax/rotate-img',
            method: 'POST',
            dataType: 'json',
            data: {
                img: imgName,
            },
            success: function(data) {
                console.log(data);
                // elem.nextAll('img').attr('src', '/images' + data.upload_dir + 'mini/' + imgName + '?' + Math.random());
                let img = elem.nextAll('img');
                let imgSrc = img.attr('src');
                img.attr('src', imgSrc + '?' + Math.random());
                elem.css('display', 'inline-block');
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });

        // по завершению операции вернуть отображение кнопки "Повернуть"
        //elem.css('display', 'inline-block');
    },

    goToModeration(program_id) {
        $.ajax({
            url: window.location.origin + '/ajax/program-moderation-repeat',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: program_id,
            },
            success: function(data) {
                console.log(data);
                if (!data.error) {
                    window.location.href = window.location.origin +
                        '/programs';
                } else {
                    oftenUsed.dialogMessageCall(data.error);
                }
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },
};