<?php

use app\Models\organizer\Contact;

/* @var $errors */
/* @var $form Contact */

$this->title = "Редактировать контакты для публикаций";

$this->cssFiles = ['organizer/profile.css'];
$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_form.js',
    'jquery/jquery.inputmask.js'
];

?>

<!--открывающий <div class="center"> зашит в nav.php -->

<div class="container">

    <section class="organizer__profile">

        <div class="organizer__information">

            <div class="back-n-wrap" data-page="">
                <a href="/organizer"><span>назад</span><span class="mobile">&nbsp;в&nbsp;Меню</span></a>
                <h2>Редактировать контакты для публикаций</h2>
            </div>

            <!-- ФОРМА ДЛЯ "КОНТАКТЫ" -->
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__links">

                <h2 class="block-title">Контакты</h2>


                <div class="links__group">

                    <div class="organizer__info-field">

                        <label for="website" class="info-field__icon website empty-icon"></label>

                        <input id="website" type="text" class="info-field__content" value="<?= $form->website ?>"
                               name="contact[website]" placeholder="адрес сайта">

                    </div>

                    <div class="organizer__info-field">

                        <label for="facebook" class="info-field__icon facebook empty-icon"></label>

                        <input id="facebook" type="text" class="info-field__content" value="<?= $form->facebook ?>"
                               name="contact[facebook]" placeholder="страница в facebook">

                    </div>

                    <div class="organizer__info-field">

                        <label for="instagram" class="info-field__icon instagram empty-icon"></label>

                        <input id="instagram" type="text" class="info-field__content" value="<?= $form->instagram ?>"
                               name="contact[instagram]" placeholder="страница в instagram">

                    </div>

                    <div class="organizer__info-field">

                        <label for="vkontacte" class="info-field__icon vkontacte empty-icon"></label>

                        <input id="vkontacte" type="text" class="info-field__content" value="<?= $form->vkontacte ?>"
                               name="contact[vkontacte]" placeholder="страница в vkontakte">

                    </div>

                    <div class="organizer__info-field">

                        <label for="youtube" class="info-field__icon youtube empty-icon"></label>

                        <input id="youtube" type="text" class="info-field__content" value="<?= $form->youtube ?>"
                               name="contact[youtube]" placeholder="страница в youtube">

                    </div>

                    <div class="organizer__info-field">

                        <label for="telegram" class="info-field__icon telegram empty-icon"></label>

                        <input id="telegram" type="text" class="info-field__content" value="<?= $form->telegram ?>"
                               name="contact[telegram]" placeholder="контакт в telegram">

                    </div>

                    <div class="organizer__info-field">

                        <label for="whatsapp" class="info-field__icon whatsapp empty-icon"></label>

                        <input id="whatsapp" type="text" class="info-field__content" value="<?= $form->whatsapp ?>"
                               name="contact[whatsapp]" placeholder="контакт в whatsapp">

                    </div>

                    <div class="organizer__info-field">

                        <label for="viber" class="info-field__icon viber empty-icon"></label>

                        <input id="viber" type="text" class="info-field__content" value="<?= $form->viber ?>"
                               name="contact[viber]" placeholder="контакт в viber">

                    </div>

                    <div class="organizer__info-field">

                        <label for="skype" class="info-field__icon skype empty-icon"></label>

                        <input id="skype" type="text" class="info-field__content" value="<?= $form->skype ?>"
                               name="contact[skype]" placeholder="контакт в skype">

                    </div>

                    <div class="organizer__info-field">

                        <label for="phone" class="info-field__icon phone empty-icon"></label>

                        <input id="phone" type="tel" class="info-field__content" value="<?= $form->phone ?>"
                               name="contact[phone]" placeholder="телефон для заявок">

                    </div>

                </div>

                <div class="organizer__button">
                    <button type="submit" class="btn-blue" name="contact[submit-contact]">
                        <span>Сохранить</span>
                    </button>
                </div>

            </form>


        </div>

    </section>

</div>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->