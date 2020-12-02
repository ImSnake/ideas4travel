<?php

use app\widgets\header\HeaderRightWidget;

?>

<!--Шапка-->
<header class="header">

    <div class="container header__container">

        <div class="header__left">

            <a href="/">
                <div class="header__logo">
                    <!--<img src="/images/logo/logo-partner-mobile.svg" alt="logo">-->
                </div>
            </a>

        </div>


        <div class="header__right">

            <?php
            // Вставляем правый блок иконок
            new HeaderRightWidget();
            ?>

        </div>

    </div>

</header>