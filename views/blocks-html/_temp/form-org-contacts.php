<!--открывающий <div class="center"> зашит в nav.php -->

<div class="container">

    <section class="organizer__profile">

        <div class="organizer__information">

            <div class="back-n-wrap" data-page="">
                <span><a href="/organizer">назад в Меню</a></span>
                <h2>Редактировать контакты для публикаций</h2>
            </div>

            <!-- ФОРМА ДЛЯ "КОНТАКТЫ" -->
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__links">

                <h2 class="block-title">Контакты</h2>


                    <div class="links__group">

                        <div class="organizer__info-field">

                            <label for="website" class="info-field__icon website empty-icon"></label>

                            <input id="website" type="text" class="info-field__content" placeholder="адрес сайта">

                        </div>

                        <div class="organizer__info-field">

                            <label for="facebook" class="info-field__icon facebook empty-icon"></label>

                            <input id="facebook" type="text" class="info-field__content"
                                   placeholder="страница в facebook">

                        </div>

                        <div class="organizer__info-field">

                            <label for="instagram" class="info-field__icon instagram empty-icon"></label>

                            <input id="instagram" type="text" class="info-field__content"
                                   placeholder="страница в instagram">

                        </div>

                        <div class="organizer__info-field">

                            <label for="vkontacte" class="info-field__icon vkontacte empty-icon"></label>

                            <input id="vkontacte" type="text" class="info-field__content"
                                   placeholder="страница в vkontacte">

                        </div>

                        <div class="organizer__info-field">

                            <label for="youtube" class="info-field__icon youtube empty-icon"></label>

                            <input id="youtube" type="text" class="info-field__content"
                                   placeholder="страница в youtube">

                        </div>

                        <div class="organizer__info-field">

                            <label for="telegram" class="info-field__icon telegram empty-icon"></label>

                            <input id="telegram" type="text" class="info-field__content"
                                   placeholder="контакт в telegram">

                        </div>

                        <div class="organizer__info-field">

                            <label for="whatsapp" class="info-field__icon whatsapp empty-icon"></label>

                            <input id="whatsapp" type="text" class="info-field__content"
                                   placeholder="контакт в whatsapp">

                        </div>

                        <div class="organizer__info-field">

                            <label for="viber" class="info-field__icon viber empty-icon"></label>

                            <input id="viber" type="text" class="info-field__content" placeholder="контакт в viber">

                        </div>

                        <div class="organizer__info-field">

                            <label for="skype" class="info-field__icon skype empty-icon"></label>

                            <input id="skype" type="text" class="info-field__content" placeholder="контакт в skype">

                        </div>

                        <div class="organizer__info-field">

                            <label for="phone" class="info-field__icon phone empty-icon"></label>

                            <input id="phone" type="tel" class="info-field__content" placeholder="телефон для заявок">

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
</div>