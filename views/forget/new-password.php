<?php

use app\forms\SignupForm;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $verification_token string */

$this->title = "Восстановление пароля";
$this->description = "";

$this->cssFiles = ['partnership/partnership.css'];
$this->jsFiles = ['ajax/new_password.js'];

?>

<div class="container">

    <section class="authorization">

        <div class="authorization__form register">

            <h2 class="block-title">Сброс пароля</h2>

            <form name="new-password" method="post" id="new_password">

                <div>
                    <label for="add-password" class="info-field__head">Новый&nbsp;пароль</label>
                    <input id="add-password" name="password" type="password" placeholder="не менее 8 символов"
                           required>
                </div>

                <div>
                    <label for="repeat-password" class="info-field__head">Повторить&nbsp;пароль</label>
                    <input id="repeat-password" name="password_repeat" type="password"
                           placeholder="повторить пароль" required>
                </div>

                <input id="verification_token" name="verification_token" type="hidden" value="<?= $verification_token ?>">

                <div class="form-comment red"></div>

                <div>
                    <button class="btn-orange" type="submit" name="submit">
                        <span>Изменить</span>
                    </button>
                </div>

            </form>

    </section>

</div>

</div>