"use strict";

(function ($) {
    $(document).ready(
        function () {

            $('#day-1').removeClass('hide-element'); // показать программу первого дня

            $('#tour-program .day__circle:first').addClass('day__current'); //подсветить иконку выбранного дня

            // клик по иконке дня
            $('#tour-program .day__circle').on('click', function () {

                //подсветить иконку выбранного дня
                $(this).addClass('day__current').siblings().removeClass('day__current');

                // получить id выбранного дня, открыть его программу, скрыть прочие
                let dayId = 'day-' + $(this).text();
                $('#' + dayId).removeClass('hide-element').siblings().addClass('hide-element');

                // показать кнопку "Равзернуть программу" и скрыть прочие
                $('#program-show').removeClass('hide-element').siblings('button').addClass('hide-element');
            });

            // клик по кнопке "Равзернуть программу"
            $('#program-show').on('click', function () {
                $(this).addClass('hide-element').siblings().removeClass('hide-element')
                    .parent().siblings('.days__list').children().removeClass('day__current')
                    .parent().siblings('.days__block').children().removeClass('hide-element');
            });

            $('#program-close').on('click', function () {
                $(this).addClass('hide-element').siblings().removeClass('hide-element')
                    .parent().siblings('.days__block').children().addClass('hide-element')
                    .parent().siblings('.days__list').children('.day__circle:first').addClass('day__current')
                    .siblings().removeClass('day__current');

                $('#day-1').removeClass('hide-element');

                oftenUsed.scrollToBottom($('#tour-program '), 70)
                //TODO при свертывании возвращать контент к программе

            });

            $('#tour-schedule button.tour__details').on('click', function () {
                $(this).addClass('hide-element').siblings('button').removeClass('hide-element')
                    .parents('.schedule__row').addClass('opened').next('.schedule__details').removeClass('hide-element');
            });

            $('#tour-schedule button.tour__close').on('click', function () {
                $(this).addClass('hide-element').siblings('button').removeClass('hide-element')
                    .parents('.schedule__row').removeClass('opened').next('.schedule__details').addClass('hide-element');
                //$(this).parent().addClass('hide-element').prev('.schedule__row').find('button.tour__details').removeClass('hide-element');

                //(this);
            });


            // поведение заголовков меню программы при изменении ширины экрана
            $(window).on('resize', function () {
                // при ширине экрана 630px+ скрывает меню для мобильных устройств
                if (window.matchMedia('all and (min-width: 630px)').matches) {
                    $('section').css('display', 'block');
                }
                /* else {  // иначе обнуляет и показывает навигацию для мобилок
                    let elem = $('.mobile-section-heading');
                    elem.removeClass('inverse').children('.group').children('.toggle').addClass('pointer-down').removeClass('pointer-up');
                    elem.next('section').css('display', 'none');
                }*/
            });

            // ДЛЯ МОБИЛОК: раскрытие-скрытие разделов по клику
            $('.mobile-section-heading').on('click', function () {
                //$(this).find('.toggle').toggleClass('pointer-down pointer-up');
                if (window.matchMedia('all and (max-width: 630px)').matches) {
                    $(this).next('section').fadeToggle();
                    $(this).find('.toggle').toggleClass('pointer-down pointer-up');
                    $(this).toggleClass('inverse');
                }
            });

            // ДЛЯ ТАБЛЕТ и ДЕСКТОП: плавная навигация по разделам
            $('#nav-tour a').on('click', function (event) {
                event.preventDefault();
                let id = $(this).attr('href');
                oftenUsed.scrollToBottom($(id), 130);
            });

            // открыть галерею при клике по img-галереи или по иконке с камерой
            //$('.tour__top-gallery img, .switch-to-gallery .icon-camera').on('click', function (event) {
            $('#tour-gallery img, #show-gallery, #map__img').on('click', function (event) {
                console.log(event);
                images.renderGallery(event);
                oftenUsed.scrollToTop($("html, body"));
                oftenUsed.bodyFix($('body'));
            });

            // показать (отрисовть) видео-бокс
            $('#play-video').on('click', function () {

                let videoList = $(this).children('#gallery-video').attr('data-video-id').split(',');

                if(videoList[0] !== ''){
                    let firstVideo = videoList.shift();

                    let playlist = videoList.join(',');

                    let frame = '<div id="video-box"><iframe width="310" height="190" src="https://www.youtube.com/embed/'
                        + firstVideo + '?controls=1&autoplay=1&rel=0&version=3&loop=1&playlist=' + playlist
                        +'" frameborder="0" allowfullscreen class="video"></iframe>' + // создать фрейм и добавить в него ID видео
                        '<span class="delete-clone"></span></div>'; // добавить иконку "закрыть"

                    $(this).parent().parent().prepend(frame);

                    $('.tour__main-image img').css('opacity', '0');
                    $('#video-box .delete-clone').delay( 500 ).fadeIn('slow');

                }
            });

            // закрыть (удалить) видео-бокс
            $('#tour-gallery').on('click', '#video-box .delete-clone', function () {
                $(this).parent().remove();
                $('.tour__main-image img').css('opacity', '1');
            });

            // аккордеон для статистики программы по дням
            $('.stats__heading').on('click', (function () {
                $(this).children('.toggle').toggleClass('pointer-down pointer-up').parent().parent().toggleClass('opened');
                $(this).siblings('.stats__content').toggleClass('hide-element');
            }));

/*            // скрыть/показать содержимое бокса ДЕНЬ
            $('.program__day-box').on('click', function () {
                $(this).children('.day-box__heading').find('.toggle').toggleClass('pointer-down pointer-up');
                $(this).children('.day-box__min-content').toggleClass('narrow-txt').find('.day-box__title, .day-box__stats, i').toggleClass('hide-element');
                $(this).children('.day-box__max-content').toggleClass('hide-element');
                $(this).children('.day-box__toggle').find('.toggle').toggleClass('hide-element');
            });*/


            $('#tour-schedule .btn-blue').on('click', function () {
                oftenUsed.scrollToBottom($('#tour-contacts'), 100);

            });

            $('#show-contacts').on('click', function (e) {
                tourGetContacts.getOrganizerContacts(e); // ajax-запрос контактов с организатора
                $(this).addClass('hide-element').prev('div').fadeIn().removeClass('hide-element');
                $('#show-all-tours').css('text-align', 'left');
            });


            //$('.extra-costs__title span').on('click', function () {
            //    $(this).siblings('.toggle').toggleClass('down-arr up-arr')
            //        .parent().siblings('.extra-costs__list').fadeToggle()
            //        .parent().find('#extra-costs__sum-btn').toggleClass('opened');
            //});

        });


})

(jQuery);
