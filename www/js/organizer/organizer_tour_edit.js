"use strict";

const editTourObj = {

    // определение действия при клике по чекбоксу блока "Обязательные затраты"
    costCheckboxAction(elem){

        elem.parents('.extra-costs__field').toggleClass('closed opened');

        (elem.prop('checked') === true)
            ? elem.parent().siblings('.extra-costs__block').removeClass('hide-element')
            : elem.parent().siblings('.extra-costs__block').addClass('hide-element');

        //TODO нужно ли добавлять очистку блока от значений?
    },

    addNewCost(elem) {

        let qty = elem.parent().find('.extra-costs__field.added-by-user').length; // получить кол-во ранее добавленных блоков
        let clone = undefined; // назначить переменную для нового блока

        (elem.attr('id') === 'add-required')  //определить место вызова функции и тип шаблона для клонирования
            ? clone = $("#template-required").clone()
            : clone = $("#template-additional").clone();

        clone.removeAttr('id').removeClass('hide-element').toggleClass('closed opened').insertBefore(elem); // добавить клон блока в DOM

        // задать для полей формы блока порядковый номер атрибутов name
        clone.find('textarea').attr('name', this.getAttrName(clone, 'textarea', qty));
        clone.find('input').attr('name', this.getAttrName(clone, 'input', qty));
        clone.find('select').attr('name', this.getAttrName(clone, 'select', qty));
    },

    deleteCost(elem){

        let qty = 0; // счетчик для динамического обновления неймов

        // обновление имен для атрибута name для оставшихся блоков
        $.each(elem.parent().parent().siblings('.extra-costs__field.added-by-user'), function () {
            $(this).find('textarea').attr('name', editTourObj.getAttrName($(this), 'textarea', qty));
            $(this).find('input').attr('name', editTourObj.getAttrName($(this), 'input', qty));
            $(this).find('select').attr('name', editTourObj.getAttrName($(this), 'select', qty));
            qty += 1;
        });

        elem.parent().parent().remove();   // удаление выбранного блока
    },


    // динамическое обновление имен атрибутов name для полей формы Доп.затраты
    getAttrName(elem, tag, qty){

        let name = elem.find(tag).attr('name');
        let regExp = /^(.*\[.*\]\[)(.?)(\]\[.*\])/;
        let match = name.match(regExp); // сохранить результат проверки
        match[2] = parseInt(qty)+1;  // увеличить значение на +1
        return match[1] + match[2] + match[3]; // подставить значение в атрибут name
    },
};

(function ($) {
    $(document).ready(
        function () {

//TODO ограничить кол-во пользовательских строк
//TODO маска для ввода стоимости id="price"
//TODO маска для ввода скидки id="discount"" (от 1 до 99 + %)

//=========================================================================================

            // заменить цвет бэкграунда страницы с серого на белый
            $('.center').addClass('organizer__edit');

            // скрыть / показать дефолтный блок с обязательными затратами
            $('.extra-costs__field input:checkbox').on('change', function () {
                editTourObj.costCheckboxAction($(this));
            });

            // добавить блок с доп.затратами
            $('#add-required, #add-additional').on('click', function () {
                editTourObj.addNewCost($(this));
            });

            // удалить блок с доп.затратами
            $('#extra-costs').on('click', '.delete-elem', function () {
                editTourObj.deleteCost($(this));
            });

            // проверка на введенные числа: не может быть отрицательным, не может быть меньше 1
            //$('#price, #book-term, #pay-term, .extra-costs__block input[type="number"]').on('change', function () {
            //    let num = oftenUsed.negativeToPositive($(this).val());
            //    if (num <= 0) { $(this).val(1); }
            //    else {$(this).val(num)}
            //});

            //проверка на кол-во свободных мест : не может быть отрицательным, не может быть меньше 1 и больше 50
           /* $('#available').on('change', function () {
                let num = oftenUsed.negativeToPositive($(this).val());
                if (num >= 50) { $(this).val(50); }
                else if (num <= 0) { $(this).val(1); }
                else {$(this).val(num)}
            });*/

/*            //проверка на проценты : не может быть отрицательным, не может быть больше 100
            $('#discount, #pre-pay').on('change', function () {
                let num = oftenUsed.negativeToPositive($(this).val());
                if (num > 100) { $(this).val(100); }
                else {$(this).val(num)}
            });*/


            // TODO переделать так как работает не корректно.
            // сохранить тур и выйти
            $('#save-exit').on('click', function() {
                ajaxTourObject.editTour('save-exit');
            });


            // публикация тура
            $('#tour-submit').on('click', function(e) {
                ajaxTourObject.editTour('publish');
            });

        });
})

(jQuery);