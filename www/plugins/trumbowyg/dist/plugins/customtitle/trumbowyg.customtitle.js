(function ($) {
    'use strict';

    // List of available titles.
    let defaultOptions = {
        titleList: [
            {name: 'Стандартный', textColor: '#383838'},
            {name: 'Голубой', textColor: '#0DA9CE'},
        ]
    };

    // Add translations.
    $.extend(true, $.trumbowyg, {
        langs: {
            ru: {
                customTitle: 'Заголовок'
            },
        }
    });

    // Add dropdown.
    $.extend(true, $.trumbowyg, {
        plugins: {
            customTitle: {
                init: function (trumbowyg) {
                    trumbowyg.o.plugins.customTitle = $.extend({},
                        defaultOptions,
                        trumbowyg.o.plugins.customTitle || {}
                    );

                    trumbowyg.addBtnDef('customTitle', {
                        dropdown: buildDropdown(trumbowyg),
                        hasIcon: false,
                        text: trumbowyg.lang.customTitle
                    });
                }
            }
        }
    });

    function buildDropdown(trumbowyg) {
        let dropdown = [];

        $.each(trumbowyg.o.plugins.customTitle.titleList, function (index, color) {
            trumbowyg.addBtnDef('customTitle_' + index, {
                title: '<span style="color: ' + color.textColor + ';">' + color.name + '</span>',
                hasIcon: false,
                fn: function () {
                    setTitle(trumbowyg, color.textColor);
                }
            });
            dropdown.push('customTitle_' + index);
        });

        return dropdown;
    }

    /**
     * Wrap selected text into "div" with own styles.
     * @param {object} trumbowyg
     * @param {string} color - title's color
     */
    function setTitle(trumbowyg, color) {
        trumbowyg.$ed.focus();
        trumbowyg.saveRange();
        let selectedText = trumbowyg.getRangeText();
        trumbowyg.range.deleteContents();

        let html = '<div class="additional_heading" style="text-transform:uppercase!important;font-size:16px!important;font-weight:bold!important;color:'
            + color + '!important;">' + selectedText + '</div>';
        let node = $(html)[0];
        trumbowyg.range.insertNode(node);

        trumbowyg.restoreRange();
    }
})(jQuery);
