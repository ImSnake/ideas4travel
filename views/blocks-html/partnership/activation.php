<div class="center">

    <section class="activation container">

        <div class="activation__form">

            <h2 class="block-title">профиль партнера</h2>

            <form action="#" method="post">

                <div class="info-field__box">

                    <div class="info-field__head">
                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <p>Название (никнейм) является общедоступным.</p>
                                <p>Оно будет отображаться под вашими публикацияи на сайте и при переписке с
                                    пользователями.</p>
                            </div>
                        </div>
                        <span>Название</span>
                    </div>

                    <input id="name" type="text" placeholder="Приключения с Ивановым Иваном">

                </div>

                <div class="info-field__box">

                    <div class="info-field__head">
                        <div class="help hover">
                            <div class="help-pop-up right fade hide-element">
                                <span class="close-pop-up"></span>
                                <h4 class="blue">ОРГАНИЗАЦИЯ:</h4>
                                <p>- Юридическое лицо</p>
                                <p>- Индивидуальный предприниматель</p>
                                <p>- Самозанятый</p>
                                <h4 class="blue">ЧАСТНЫЙ ГИД:</h4>
                                <p>- Физическое лицо</p>
                            </div>
                        </div>
                        <span>Я буду действовать как</span>
                    </div>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="company" name="partner-type" value="company">
                    <label for="company"><span>организация</span></label>
                    <!-- не удалять имя: на нем держится логика радио-кнопок-->
                    <input type="radio" id="person" name="partner-type" value="person">
                    <label for="person"><span>частный гид</span></label>

                </div>

                <div>
                    <button class="btn-orange" type="submit">
                        <span>Активировать</span>
                    </button>
                </div>

            </form>

        </div>

    </section>

</div>
