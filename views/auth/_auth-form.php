<?php

use app\services\Auth;

/* @var $errors */

?>

<div class="authorization__form login">

    <h2 class="block-title">Войти&nbsp;в&nbsp;кабинет</h2>

    <form name="authForm" method="post" action="<?= $actionAuthForm ?>">

        <div>
            <label for="login" class="info-field__head">Email</label>
            <input id="login" name="auth[email]" type="text" tabindex="1" required> <!--placeholder="email"-->
        </div>

        <div>
            <label for="password" class="info-field__head">Пароль</label>
            <input id="password" name="auth[password]" type="password" tabindex="2" required>
        </div>

        <?php if ($errors['auth'] === Auth::ERROR_PASSWORD_INCORRECT): ?>
            <div class="form-error">
                <span class="form-comment red">неверный логин или пароль</span>
            </div>
        <?php endif; ?>


        <div>
            <button class="btn-blue" type="submit" name="auth[submit_auth]" value="submit_auth">
                <span>Войти</span>
            </button>
        </div>


        <div class="link">
            <a href="/forget">не&nbsp;помню&nbsp;пароль</a>
        </div>

    </form>

</div>