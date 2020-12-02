<?php

use app\helpers\HtmlHelpers;

?>

<!--Подвал-->
<footer class="footer">

    <div class="container footer-container">

        <div class="footer-nav">

            <div class="footer_nav__row">
                <a href="#" class="footer-nav__item" style="color:red">О сервисе</a>
                <a href="#" style="color:red" class="footer-nav__item">Вопрос-ответ</a>
            </div>

            <div class="footer_nav__row">
                <a href="//<?= HtmlHelpers::getMainDomain() ?>/rules" class="footer-nav__item">Правила</a>
                <a href="//<?= HtmlHelpers::getMainDomain() ?>/partnership" class="footer-nav__item">Организаторам</a>
            </div>

            <div class="footer_nav__row">
                <a href="#" class="footer-nav__item" style="color:red">lorem</a>
                <a href="#" class="footer-nav__item" style="color:red">lorem</a>
            </div>

        </div>

        <div class="footer-right">

            <div class="footer__social-links">
                <a href="#"><i class="icon-facebook-rect"></i></a>
                <a href="#"><i class="icon-instagram-4"></i></a>
                <a href="#"><i class="icon-telegram"></i></a>
            </div>

            <div class="footer__copyright">
                <span>&copy; Ideas For Travel, <?= date("Y") ?></span>
            </div>

        </div>

    </div>

</footer>