"use strict";

(function ($) {
    $(document).ready(
        function () {

            // mobile: управление выпадающими блоками в main-filter (mob-view-filter-options, main-filter-options)
            $('.mob-view-filter-head').click(function () {
                $(this).addClass('hide-element');
                $('.quick-filter, .tour-window').addClass('hide-element');
                //$('.main-filter').css('width', '100%');
                //$('.mob-view-filter-options, .main-filter-options').fadeIn(700).css('display', 'flex');
                $('.mob-view-filter-options, .main-filter-options').fadeIn(700).addClass('flex-element');
            });

            $('.mob-filter-close').click(function () {
                $('.mob-view-filter-options').fadeOut(700, function () {
                    $(this).css('display', 'none');
                    $('.main-filter-options').css('display', 'none');
                    $('.quick-filter, .mob-view-filter-head').css('display', 'block');
                    $('.tour-window').css('display', 'flex');
                    $('.main-filter').css('width', 'unset');
                })
            });


            //mobile: управление кнопкой "Выбранные" (mob-applied-filters)
            $('.mob-applied-filters .mob-btn-1').click(function () {
                $('.mob-applied-filters-result, .icon-angle-double-left, .icon-angle-double-right').toggle();
            });



            $('.to-favorite').click(function () {
                $(this).children('i').toggleClass('hide-element');
            });

        });
})(jQuery);


//             //catalog_mobile управление фильтрацией при клике на кнопку ФИЛЬТР
//             $('.mob-filter-head').click(function () {
//                 $(this).css('display', 'none');
//                 $('.quick-filter').css('display', 'none');
//                 $('.mob-filter-settings, .mob-applied-filters, .main-filter-options').fadeIn(700).css('display', 'flex');
//                 $('.mob-view-show-result').css('display', 'block');
//             });
//
//             $('.mob-filter-close').click(function () {
//                 $('.mob-filter-settings').fadeOut(700, function (){
//                     $(this).css('display', 'none');
//                     $('.mob-applied-filters, .main-filter-options').css('display', 'none');
//                     $('.applied-filters').css('display', 'none');
//                     $('.quick-filter').css('display', 'block');
//                     $('.mob-filter-head').css('display', 'flex');
//                 })
//             });
//
//             //catalog_mobile управление кнопкой "Выбранные"
//             $('.mob-applied-filters').click(function () {
//                 $('.applied-filters, .icon-angle-double-right, .icon-angle-double-left').toggle('hide-element');
//             });