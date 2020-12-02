"use strict";

const avatarObj = {

    degrees: 0,
    imgMini: $('.user__avatar img'),
    img: $('.organizer__avatar img:first'),
    imgFull: $('.organizer__avatar img:last'),


    // загрузить аватар
    addAvatar(form){
        form.ajaxForm({
            url: window.location.origin + '/ajax',
            resetForm: true,
            dataType: 'json',
            success: function (data) {
                $.each(data, function (index, value) {
                    // если есть ошибки, то выводим блок с ошибками, если ошибок нет,
                    // то скраваем блок с ошибками и выводим блок кадрирования
                    if (value.error != null) {
                        $('#block_error_upload').html(value.error);
                    } else {
                        $('#block_error_upload').html('');
                        $('.fade').addClass('hide-element');
                        avatarObj.imgMini.attr('src', '/images/avatars/mini/' + value.name);
                        avatarObj.img.attr('src', '/images/avatars/middle/' + value.name);
                        avatarObj.imgFull.attr('src', '/images/avatars/original/' + value.name);
                        avatarObj.degrees = -90;
                        avatarObj.imgTurn();
                    }
                });
            },
        });
    },

    // повернуть и сохранить аватар
    rotateAvatar(elem){

        elem.css('display', 'none'); // временно скрыть кнопку поворота
        let img = elem.siblings('img'); // получить исходное изображение
        let imgSrc = img.attr('src'); // получить src исходного изображения

        $.ajax({
            url: window.location.origin + '/ajax/rotate-avatar',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                img.attr('src', imgSrc + '?' + Math.random());

                avatarObj.imgTurn();

                elem.css('display', 'inline-block');
            },
            error: function(e) {
                console.log(e.responseText);
                $('body').html(e.responseText);
            },
        });
    },

    // задать поворот на 90 градусов вправо
    imgTurn(){

        (avatarObj.degrees >= 270) ? avatarObj.degrees = 0 :  avatarObj.degrees +=90;
        this.rotate(this.img);
        this.rotate(this.imgMini);
    },

    // выполнить поворот аватаров на странице профиля
    rotate(elem){
        elem.css({
            '-webkit-transform':'rotate(' + avatarObj.degrees + 'deg)',
            '-moz-transform':'rotate(' + avatarObj.degrees + 'deg)',
            'transform':'rotate(' + avatarObj.degrees + 'deg)'
        });
    },
};