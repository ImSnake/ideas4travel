<!--Шапка-->
<header class="header">

    <div class="container header__container">

        <div class="header__left">

            <a href="/">
                <div class="header__logo">
                    <img src="/images/logo/logo-square-svg.svg" alt="logo">
                </div>
            </a>

        </div>

        <div class="header__right">

            <div class="header__currency">
                <form action="#">
                    <select name="currency" id="currency">
                        <option value="ruble">&#8381;</option>
                        <option value="dollar">&dollar;</option>
                        <option value="euro">&euro;</option>
                    </select>
                </form>
            </div>

            <div class="header__notifications">

                <div class="header__favorite">
                    <a href="#">
                        <span class="notifications__point"></span>
                        <i class="icon-heart"></i>
                    </a>
                </div>

                <div class="header__requests">
                    <a href="#">
                        <span class="notifications__point"></span>
                        <i class="icon-suitcase"></i>
                    </a>
                </div>

                <div class="header__chat">
                    <a href="#">
                        <span class="notifications__point"></span>
                        <i class="icon-chat-1"></i>
                    </a>
                </div>

            </div>

            <div class="header__menu">

                <!-- БУРГЕР МЕНЮ
                <div class="header_burger-menu">
                    <a href="#">
                        <div></div>
                        <div></div>
                        <div></div>
                    </a>
                </div> -->

                <div class="header__user">

                    <div class="user_unknown">
                        <div class="user__icon">
                            <i class="icofont-user"></i>
                        </div>
                        <div class="menu-list right fade hide-element">
                            <span><a href="/auth">Войти</a></span>
                            <span><a href="/signup">Регистрация</a></span>
                        </div>
                    </div>

                    <div class="user__avatar">
                        <img src="/images/test/organizer_company.jpg" alt="user-avatar">
                        <div class="menu-list right fade hide-element">
                            <span><a href="#">База знаний</a></span>
                            <span><a href="/auth/logout">Выход</a></span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</header>