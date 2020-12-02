"use strict";

(function ($) {
    $(document).ready(function () {


        if (window.location.href.includes('#'))
        {
            //если в window.location есть якорь с id статьи, открыть эту статью
            let id = window.location.href.split("#");
            console.log(id[1]);
            $('#'+id[1]).removeClass('hide-element');
        }

        $('.column li').on('click', function () {

            $('section').addClass('hide-element');

            let text = $(this).text();

            $.each($('h2'), function () {
                if($(this).text() === text){
                    $(this).parent().removeClass('hide-element');
                }
            });

        });


        $('.article a').on('click', function () {
            let anchor = $(this).attr('href');
            console.log($(this).attr('href').substring(0, 1));
            if(anchor.substring(0, 1) === '#' && anchor.length > 1 ){
                $('section').addClass('hide-element');
                $(anchor).removeClass('hide-element');
            }
            //$($(this).attr('href')).removeClass('hide-element');
        })

    });
})
(jQuery);