'use strict';

const oftenUsed = {

    alertWindowCall() {

    },

    dialogMessageCall(text) {

        $.dialog({
            bgOpacity: '0.3',
            boxWidth: '320px',
            useBootstrap: false,
            draggable: false,
            title: false,
            content: '<div class="dialog-message">' +
                '<img src="../../images/service/important.svg" alt="service-message">'
                + text + '</div>',
            type: 'blue',
            onOpenBefore: function() { oftenUsed.bodyFix($('body')); }, // при открытии фиксирует body, не дает прокручивать содержимое
            onDestroy: function() { oftenUsed.bodyScroll($('body')); },  // при закрытии возвращает body прежние настройки
        });
    },

    // блокировка экрана при всплытии поп-ап
    bodyFix(body) {
        (window.matchMedia('all and (min-width: 630px').matches)
            ? body.css({'overflow': 'hidden', 'padding-right': '0px'})
            : body.css('overflow', 'hidden');
    },

    // снятие блокировки с экрана при закрытии поп-ап
    bodyScroll(body) {
        (window.matchMedia('all and (min-width: 630px').matches)
            ? body.css({'overflow': 'unset', 'padding-right': '0px'})
            : body.css('overflow', 'unset');
    },

    // поведение выпадающих по клику элементов
    // показать\скрыть элементы "help" и по-ап скрытых меню, содержащие класс "hover";
    openClickedElem(event, elem) {
        if (event.target.classList.contains('hover')) {
            $(elem).children('.fade').removeClass('hide-element');
        }
        // запуск функции контроля закрытия элемента
        this.onClickClose(elem);
    },

    // закрытие всплывающих элементов (меню, pop-up) при клике вне открытого окна
    onClickClose(elem) { // вызвать в момент показа окна, где elem - окно
        function outsideClickListener(event) {
            if (!elem.contains(event.target) && oftenUsed.isVisible(elem)   // клик не по элементу и элемент виден
                || event.target.classList.contains('close-pop-up')    // клик по "закрыть" внутри открытого блока
                || event.target.tagName === 'A')                     // клик по ссылке внутри открытого блока
            {
                $(elem).children('.fade').addClass('hide-element'); //скрыть
                document.removeEventListener('click', outsideClickListener); //удалить слушатель события
            }
        }

        document.addEventListener('click', outsideClickListener);
    },

    //проверяет открыт ли элемент в момент клика
    isVisible(elem) { //открыто ли условное окно
        return !!elem && !!(elem.offsetWidth || elem.offsetHeight ||
            elem.getClientRects().length);
    },

    // плавная прокрутка вверх к началу элемента
    scrollToTop(elem) {
        elem.animate({scrollTop: 0}, 'slow');
        //$('html,body').animate({ scrollTop: document.body.scrollHeight }, "slow");
    },

    // плавная прокрутка к вниз до заданного элемента
    scrollToBottom(elem, height) {
        $('html,body').animate({scrollTop: elem.offset().top - height}, 'slow');
    },

    negativeToPositive(num) {
        num = num.replace(/[^0-9]/g, ''); // обрежет минус
        return num;
    },

    /**
     * Методо изменяет значение куки 'currency' на выбранную пользователем
     * валюту для отображения цен.
     * @param id
     */
    setCookieCurrency(id) {
        let date = new Date(Date.now() + 60 * 60 * 24 * 30 * 12);
        document.cookie = 'currency=' + id +
            '; path=/; expires=' + date + '; domain=' +
            window.location.host + '; secure';
        window.location.reload();
    },
};

(function($) {
    $(document).ready(
        function() {
            //поведение выпадающего меню в header для user
            $('.header__user div').on('click', (function() {
                $(this).children('.fade').fadeToggle(50, 'linear');
            })).on('mouseleave', function() {
                $(this).children('.fade').fadeOut(500, 'linear');
            });

            $('.hover').on('click', function(event) {
                oftenUsed.openClickedElem(event, this);
            });

            // Меняем значение куки 'currency'.
            $('#currency').on('change', function(e) {
                oftenUsed.setCookieCurrency($(this).find('option:selected').val());
            });

        });
})
(jQuery);
