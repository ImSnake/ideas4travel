"use strict";

/**
 * @property {Object} oftenUsed ссылка на объект с часто используемыми JS-скриптами (main.js)
 * @property {string} initImage название картинки, вызвавшей событие открытия галереи.
 * @property {HTMLElement} openedImageEl хранит и обновляет информацию об открытой картинке галереи
 * @property {Object} settings Объект с настройками галереи.
 * @property {HTMLElement} settings.imageDefault бокс с главной картинкой программы
 * @property {HTMLElement} settings.galleryCover бокс открытия галереи и блокировки прочего контента
 * @property {HTMLElement} settings.galleryBox бокс со всеми элементами галереи
 * @property {HTMLElement} settings.galleryOpenedImage бокс для полноразмерного изображения
 * @property {HTMLElement} settings.previewSelector бокс для миниатюр галереи.
 * @property {string} settings.openedImageWrapperClass Класс для обертки открытой картинки.
 * @property {string} settings.openedImageClass Класс открытой картинки.
 * @property {string} settings.imageContainer Коньейнер для картинки
 * @property {string} settings.openedImageCloseBtnClass Класс для картинки кнопки закрыть.
 * @property {string} settings.openedImageCloseBtnSrc Путь до картинки кнопки открыть.
 * @property {string} settings.imageNotAvailable Путь до стандартной картинки-заглушки.
 * @property {string} settings.rightArrowSrc Путь до картинки со стрелкой вправо.
 * @property {string} settings.rightArrowSettings Класс картинки со стрелкой вправо.
 * @property {string} settings.leftArrowSrc Путь до картинки со стрелкой влево.
 * @property {string} settings.leftArrowSettings Класс картинки со стрелкой влево.
 */
const gallery = {
    oftenUsed: oftenUsed,
    initImage: null,
    openedImageEl: null,

    settings: {
        imageDefault: $('.tour__main-image img'),
        galleryCover: $('#gallery-cover'),
        galleryBox: $('#gallery'),
        galleryOpenedImage: $('#image-box'),
        previewSelector: $('#gallery__mini-bar'),
        openedImageWrapperClass: 'galleryWrapper',
        openedImageClass: 'galleryWrapper__image',
        imageContainer: "galleryWrapper__container",
        openedImageCloseBtnClass: 'galleryWrapper__close',
        openedImageCloseBtnSrc: '../../images/tours/default/cancel.svg',
        imageNotAvailable: '../../images/tours/default/noImageAvailable.jpg',
        rightArrowSrc: '../../images/tours/default/right-arrow.svg',
        rightArrowSettings: 'galleryWrapper__rightArrow',
        leftArrowSrc: '../../images/tours/default/left-arrow.svg',
        leftArrowSettings: 'galleryWrapper__leftArrow',
    },


    /**
     * Инициализирует стили галереи, открывает выбранное изображение, ставит обработчик события на gallery__mini-bar.
     */
    init() {
        // найти в previewSelector картинку, которая вызвала открытие галереи и запомнить в openedImageEl
        let obj = this.settings.previewSelector.find('img');
        $.each(obj, function (index, value) {
            let string = value.getAttribute('src');
            if (string.indexOf(gallery.initImage) > -1) {
                gallery.openedImageEl = value;
            }
        });

        this.openImage(this.openedImageEl.dataset.full_image_url);

        this.settings.previewSelector.on('click', event => this.containerClickHandler(event));

        this.settings.galleryCover.removeClass('hide-element');
    },
    /**
     * Обработчик события клика для открытия картинки.
     * @param {MouseEvent} event Событие клики мышью.
     * @param {HTMLElement} event.target Событие клики мышью.
     */
    containerClickHandler(event) {
        if (event.target.tagName !== `IMG`) {
            return;
        }
        this.openedImageEl = event.target;
        this.openImage(event.target.dataset.full_image_url);
    },
    /**
     * Открывает большую картинку.
     * @param {string} src Ссылка на картинку, которую надо открыть.
     */
    openImage(src) {
        const openedImageEl = this.getScreenContainer().querySelector(`.${this.settings.openedImageClass}`);
        const img = new Image();
        img.onload = () => openedImageEl.src = src;
        img.onerror = () => openedImageEl.src = this.settings.imageNotAvailable;
        img.src = src;

        this.oftenUsed.scrollToTop(this.settings.galleryBox);
    },
    /**
     * Возвращает контейнер для открытой картинки, либо создает такой контейнер, если его еще нет.
     * @returns {Element}
     */
    getScreenContainer() {
        const galleryWrapperElement = document.querySelector(`.${this.settings.openedImageWrapperClass}`);

        if (galleryWrapperElement) {
            return galleryWrapperElement;
        }
        return this.createScreenContainer();
    },
    /**
     * Создает контейнер для открытой картинки.
     * @returns {HTMLElement}
     */
    createScreenContainer: function () {
        const galleryWrapperElement = document.createElement('div');
        galleryWrapperElement.classList.add(this.settings.openedImageWrapperClass);

        const imageContainer = document.createElement('div');
        imageContainer.classList.add(this.settings.imageContainer);
        galleryWrapperElement.appendChild(imageContainer);

        const closeImageElement = new Image();
        closeImageElement.classList.add(this.settings.openedImageCloseBtnClass);
        closeImageElement.src = this.settings.openedImageCloseBtnSrc;
        closeImageElement.addEventListener(`click`, () => this.close());
        imageContainer.appendChild(closeImageElement);

        const leftNavArrow = new Image();
        leftNavArrow.classList.add(this.settings.leftArrowSettings);
        leftNavArrow.src = this.settings.leftArrowSrc;
        imageContainer.appendChild(leftNavArrow);

        leftNavArrow.addEventListener(`click`, () => {
            this.openedImageEl = this.getPrevImage();
            this.openImage(this.openedImageEl.dataset.full_image_url);
        });

        const rightNavArrow = new Image();
        rightNavArrow.classList.add(this.settings.rightArrowSettings);
        rightNavArrow.src = this.settings.rightArrowSrc;
        imageContainer.appendChild(rightNavArrow);

        rightNavArrow.addEventListener(`click`, () => {
            this.openedImageEl = this.getNextImage();
            this.openImage(this.openedImageEl.dataset.full_image_url);
        });

        const image = new Image();
        image.classList.add(this.settings.openedImageClass);
        imageContainer.appendChild(image);
        //document.getElementById('image-box').appendChild(galleryWrapperElement);
        this.settings.galleryOpenedImage.append(galleryWrapperElement);

        return galleryWrapperElement;
    },
    /**
     * Возвращает предыдущий элемент (картинку) от открытой или последнюю картинку в контейнере,
     * если текущая открытая картинка первая.
     * @returns {Element} Предыдущую картинку от текущей открытой.
     */
    getPrevImage() {
        const prevSibling = this.openedImageEl.previousElementSibling;
        if (prevSibling !== null) {
            return prevSibling
        }
        return prevSibling ? prevSibling : this.openedImageEl.parentNode.lastElementChild;
    },
    /**
     * Возвращает следующий элемент (картинку) от открытой или первую картинку в контейнере,
     * если текущая открытая картинка последняя.
     * @returns {Element} Следующую картинку от текущей открытой.
     */
    getNextImage() {
        const nextSibling = this.openedImageEl.nextElementSibling;
        return nextSibling ? nextSibling : this.openedImageEl.parentNode.firstElementChild;
    },

    /**
     * Закрывает окно и удаляет содержимое контейнеров.
     */
    close() {
        this.settings.galleryCover.addClass('hide-element');
        this.settings.galleryOpenedImage.empty().off();
        this.settings.previewSelector.empty().off();
        //this.oftenUsed.scrollToTop($("html, body"));
        this.oftenUsed.bodyScroll($('body'));
    }
};

const images = {
    gallery: gallery,

    /**
     * получает имя картинки, вызвавшей открытие галереи
     * Отправляет запрос AJAX-запрос для получения атрибутов объекта images
     * Полученный ответ сохраняет в images.items
     */
    renderGallery(event) {
        this.getImages();
        this.getCurrentImage(event.target);
    },

    /**
     * Сохраняет имя картинки с которой был выполнен переход на галерею
     */
    getCurrentImage(elem) {
        let url = elem.getAttribute('src');

        if (url === null) {
            url = this.gallery.settings.imageDefault.attr('src');
        }
        let arr = url.split('/');
        this.gallery.initImage = arr[arr.length - 1];
    },

    /**
     * Отправляет запрос AJAX-запрос для получения всех изображений галереи
     */
    getImages() {
        $.ajax({
            url: window.location.origin + '/ajax/program-gallery',
            method: 'POST',
            dataType: 'json',
            data: {
                program_id: this.gallery.settings.galleryBox.data('program'),
                partner_id: this.gallery.settings.galleryBox.data('partner'),
                //program_id: $('#tour_view').data('program-id'),
                //partner_id: $('#tour_view').data('partner-id'),
            },
            success: function(data) {
                //console.log(data);
                // self.items = data;
                // self.renderImage(self.items);
                images.renderImage(data)
            },
        });
    },

    /**
     * На базе Класса GalleryRender создает элементы и атрибуты изображений галереи
     * @param {array} data ответ сервера: объект с атрибутами для IMG
     */
    renderImage(data) {
        for (let i = 0; i < data.length; i++) {
            const name = data[i].name;
            const alt = data[i].alt;
            const type = data[i].type;

            const render = new GalleryRender;
            render.init(name, alt, type);
        }
        this.gallery.init();
    },
};

