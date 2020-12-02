<div class="center">

    <section class="authorization container">

        <div class="authorization__form register">

            <h2 class="block-title">Новый партнер</h2>

            <form action="#" method="post">

                <div>
                    <label for="contact">Контактное лицо:</label>
                    <input id="name" type="text" placeholder="имя" required>
                    <span class="form-comment red">Добавьте контактную информацию</span>

                    <input id="surname" type="text" placeholder="фамилия" required>
                    <span class="form-comment red">Добавьте контактную информацию</span>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input id="email" type="email" placeholder="логин для входа" required>
                </div>

                <div>
                    <label for="phone">Мобильный телефон:</label>
                    <input id="phone" type="tel" placeholder="+7 (123) 456-78-90" required>
                </div>

                <div>
                    <label for="add-password">Придумайте пароль:</label>
                    <input id="add-password" type="password" required>
                </div>

                <div>
                    <label for="repeat-password">Повторите пароль:</label>
                    <input id="repeat-password" type="password" required>
                    <span class="form-comment red">Пароли не совпадают</span>
                </div>

                <div class="agreement">

                    <div>Ознакомился и принимаю условия:</div>

                    <div>
                        <input id="user-agreement" type="checkbox" required>
                        <label for="user-agreement"></label>
                        <a href="partnership-offer.php" class="link" target="_blank">оферта для партнеров</a>
                    </div>

                    <div>
                        <input id="partner-agreement" type="checkbox" required>
                        <label for="partner-agreement"></label>
                        <a href="rules.php" class="link" target="_blank">пользовательское соглашение</a>
                    </div>

                </div>

                <div>
                    <button class="btn-orange" type="submit">
                        <span>Регистрация</span>
                    </button>
                </div>

            </form>

        </div>

        <div class="authorization__form login">

            <h2 class="block-title">В кабинет партнера</h2>

            <form action="#" method="post">

                <div>
                    <label for="login">Логин:</label>
                    <input id="login" type="text" placeholder="email" required>
                    <span class="form-comment red">Неверный логин или пароль</span>
                </div>

                <div>
                    <label for="password">Пароль:</label>
                    <input id="password" type="password" required>
                    <span class="form-comment red">Неверный логин или пароль</span>
                    <a href="#">Забыли пароль?</a>
                </div>

                <div>
                    <button class="btn-blue" type="submit">
                        <span>Войти</span>
                    </button>
                </div>

            </form>

        </div>

    </section>

</div>
