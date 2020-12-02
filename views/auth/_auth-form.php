<?php

use app\services\Auth;

/* @var $errors */

?>

<div class="authorization__form login">

    <h2 class="block-title">Войти в кабинет партнера</h2>

    <form name="authForm" method="post" action="<?= $actionAuthForm ?>">

        <div>
            <label for="login">Email:</label>
            <input id="login" name="auth[email]" type="text" placeholder="email" tabindex="1" required>
        </div>

        <div>
            <label for="password">Пароль:</label>
            <input id="password" name="auth[password]" type="password" tabindex="2" required>
            <a href="#">Забыли пароль?</a>
        </div>


        <?php if ($errors['auth'] === Auth::ERROR_PASSWORD_INCORRECT): ?>
            <div class="form-error">
                <span class="form-comment red">Неверный логин или пароль</span>
            </div>
        <?php endif; ?>


        <button class="btn-blue" type="submit" name="auth[submit_auth]" value="submit_auth">
            <span>Войти</span>
        </button>

    </form>

</div>