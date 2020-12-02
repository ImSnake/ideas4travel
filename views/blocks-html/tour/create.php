<!-- <div class="center"> -->
<section class="container organizer__new-tour" xmlns="http://www.w3.org/1999/html">

    <div class="back-n-wrap" data-page="tours">
        <a href="/tours"><span>назад в Туры</span></a>
    </div>

    <div class="new-tour__heading">
        <div>Опубликовать тур по программе</div>
        <div class="heading__program-name">АФРИКА XL. ОТ ПУСТЫНИ НАМИБ ДО ВОДОПАДА ВИКТОРИЯ</div>
    </div>

    <div>

        <div class="new-tour__form-block">

            <h2 class="block-title">Подробнее о туре</h2>

            <div class="form-block__field">
                <label for="start-date" class="label-width">Дата начала<span class="required"></span></label>
                <input id="start-date" name="#" type="date" data-placeholder="дд.мм.гггг" required>
            </div>

            <div class="form-block__field">
                <label for="status" class="label-width">Статус тура<span class="required"></span></label>

                <div class="select-cover">
                    <select id="status" name="" required>
                        <option selected disabled value="">из списка</option>
                        <option value="1">гарантирован</option>
                        <option value="2">идет набор</option>
                    </select>
                </div>
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>

            <div class="form-block__field">
                <label for="season" class="label-width">Тип сезона<span class="required"></span></label>
                <div class="select-cover">
                    <select id="season" name="" required>
                        <option selected disabled value="">из списка</option>
                        <option value="1">высокий</option>
                        <option value="2">низкий</option>
                        <option value="3">межсезонье</option>
                        <option value="4">нет сезоности</option>
                    </select>
                </div>
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>

            <div class="form-block__field">
                <label for="t-min" class="label-width">Погода&nbsp;&nbsp;от</label>
                <input id='t-min' type="text" class="degree" placeholder="t">
                <label for="t-max">до</label>
                <input id='t-max' type="text" class="degree" placeholder="t">
                <span>C&deg;</span>

                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="new-tour__form-block">

            <h2 class="block-title">Цены и наличие мест</h2>

            <div class="form-block__field">
                <label for="price">Стоимость<span class="required"></span></label>
                <input id="price" name="#" type="text" placeholder="сумма" required>
                <div class="select-cover currency">
                    <select id="" name="" required>
                        <option selected disabled value="">валюта</option>
                        <option value="1">₽ </option>
                        <option value="2">$ </option>
                        <option value="3">€ </option>
                    </select>
                </div>
                <!--<span>за 1 место</span>-->
            </div>

            <div class="form-block__field">
                <label for="available">Свободно<span class="required"></span></label>
                <input id="available" type="number" min="1" max="50" required>
                <span>мест</span>
            </div>

            <div class="form-block__field">
                <label for="discount">Установить скидку</label>
                <input id="discount" type="text" placeholder=" 0 %">
                <label for="discount-timeOut"> до</label>
                <input id="discount-timeOut" name="#" type="date" data-placeholder="дд.мм.гггг" required>
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>

<!--
            <div class="form-block__field">
                <input id="kids-price" type="checkbox">
                <label for="kids-price"></label>
                <span>есть скидки на участие детей</span>
            </div>-->

        </div>

        <div class="new-tour__form-block">

            <h2 class="block-title">Бронирование</h2>

            <div class="form-block__field">
                <label for="book-term">Прием заявок не позднее<!--<span class="required"></span>--></label>
                <input id="book-term" name="" type="number" min='2' max="100" placeholder="2">
                <span>дней до начала</span>
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>

            <div class="form-block__field">
                <label for="pre-pay">Предоплата</label>
                <input id="pre-pay" type="number" min="0" max="100" placeholder=" 0 % ">
            </div>

            <div class="form-block__field">
                <label for="pay-term">Оплата участия не позднее</label>
                <input id="pay-term" type="number" min="0" placeholder=" 2 ">
                <span>дней до начала</span>
            </div>

            <div class="form-block__field">
                <label for="tour-contact">Контакты для бронирования тура</label>
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
                <textarea id="tour-contact" rows="1"></textarea>
            </div>

            <div class="form-block__field top-space">
                <span class="text">Условия бронирования и оплаты</span>
                <textarea id="payment-extra" rows="1"></textarea>
            </div>

            <div class="form-block__field">
                <span class="text">Условия отмены и возврата<span>
                <textarea id="refund" rows="1"></textarea>
            </div>



        </div>

    </div>


    <div id="extra-costs">
        <h2>В ЦЕНУ ТУРА НЕ ВКЛЮЧЕНО</h2>

        <div>
            <div class="extra-costs__title">Обязательные расходы
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Отметьте расходы по программе не включеные в цену тура, но требующие <span class="blue bold">обязательной</span>
                            оплаты для участия.</p>
                        <p>Все не отмеченные в данном блоке расходы по программе считаются включенными в цену тура.</p>
                    </div>
                </div>
            </div>

            <div class="extra-costs__field">
                <input id="transfer" type="checkbox">
                <label for="transfer"><span>билеты до места сбора группы</span></label>

                <div class="extra-costs__block hide-element">
                    <!--                    <div class="text">Как добраться из Москвы</div>-->
                    <textarea id="transfer-comment" rows="2" placeholder="как добраться до места из Москвы"></textarea>
                    <div class="group">
                        <label for="transfer-costs">Расходы</label>
                        <input id="transfer-costs" name="#" type="number" min="0" placeholder="сумма затрат">
                        <div class="select-cover currency">
                            <select id="" name="" required>
                                <option selected disabled value="">валюта</option>
                                <option value="1">₽</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="extra-costs__field">
                <input id="accommodation" type="checkbox">
                <label for="accommodation"><span>проживание</span></label>
                <div class="extra-costs__block hide-element">
                    <!--                    <div class="text">Какие дни не включены</div>-->
                    <textarea id="" rows="2" placeholder="в какие дни проживание не включено"></textarea>
                    <div class="group">
                        <label for="">Расходы</label>
                        <input id="" name="#" type="number" min="0" placeholder="сумма затрат">
                        <div class="select-cover currency">
                            <select id="" name="" required>
                                <option selected disabled value="">валюта</option>
                                <option value="1">₽</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="extra-costs__field">
                <input id="meal" type="checkbox">
                <label for="meal"><span>питание</span></label>
                <div class="extra-costs__block hide-element">
                    <!--                    <div class="text">Что не включено</div>-->
                    <textarea id="" rows="2" placeholder="в какие дни питание не включено"></textarea>
                    <div class="group">
                        <label for="">Расходы</label>
                        <input id="" name="#" type="number" min="0" placeholder="сумма затрат">
                        <div class="select-cover currency">
                            <select id="" name="" required>
                                <option selected disabled value="">валюта</option>
                                <option value="1">₽</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="extra-costs__field">
                <input id="visa" type="checkbox">
                <label for="visa"><span>виза для граждан РФ</span></label>
                <div class="extra-costs__block hide-element">
                    <!--                    <div class="text">Информация о визе</div>-->
                    <textarea id="" rows="2" placeholder="информация о визе"></textarea>
                    <div class="group">
                        <label for="">Расходы</label>
                        <input id="" name="#" type="number" min="0" placeholder="сумма затрат">
                        <div class="select-cover currency">
                            <select id="" name="" required>
                                <option selected disabled value="">валюта</option>
                                <option value="1">₽</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="extra-costs__field">
                <input id="insurance" type="checkbox">
                <label for="insurance"><span>страховка</span></label>
                <div class="extra-costs__block hide-element">
                    <!--                    <div class="text">Информация о страховке</div>-->
                    <textarea id="" rows="2" placeholder="вид страхования"></textarea>
                    <div class="group">
                        <label for="">Расходы</label>
                        <input id="" name="#" type="number" min="0" placeholder="сумма затрат">
                        <div class="select-cover currency">
                            <select id="" name="" required>
                                <option selected disabled value="">валюта</option>
                                <option value="1">₽</option>
                                <option value="2">$</option>
                                <option value="3">€</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="add-elem">добавить</div>
        </div>

        <div>
            <div class="extra-costs__title">Дополнительные расходы
                <div class="help hover">
                    <div class="help-pop-up top fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis labore minima obcae</p>
                    </div>
                </div>
            </div>
            <div class="add-elem">добавить</div>
        </div>
    </div>

    <div class="new-tour__bottom">
        <div class="btn-orange">
            <span>ОПУБЛИКОВАТЬ</span>
        </div>
    </div>

</section>

<div id="template" class="extra-costs__field hide-element">
    <div class="delete-elem">удалить</div>
    <div class="extra-costs__block">
        <textarea id="" rows="2" placeholder="комментарий"></textarea>
        <div class="group">
            <label for=""></label>
            <input id="" name="#" type="number" min="0" placeholder="сумма затрат">
            <div class="select-cover currency">
                <select id="" name="" required>
                    <option selected disabled value="">валюта</option>
                    <option value="1">₽</option>
                    <option value="2">$</option>
                    <option value="3">€</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- закрывающий тег к <div class="center"> (начало в nav.php) -->
<!--</div>-->
