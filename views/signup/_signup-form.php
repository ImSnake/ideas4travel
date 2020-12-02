<?php

use app\forms\SignupForm;
use app\helpers\HtmlHelpers;

/* @var $errors */
/* @var $form SignupForm */

// Получаем массив ошибок.
$errors = $form->errors['signup']

?>

<div class="authorization__form register">

    <h2 class="block-title">Новый&nbsp;организатор</h2>

    <form name="signupForm" method="post" action="<?= $actionSignupForm ?>">

        <div>
            <label for="contact" class="info-field__head">Контактное&nbsp;лицо</label>
            <input id="name" type="text" name="signup[first_name]" placeholder="имя"
                   value="<?= $form->first_name ?>" required>
            <?php if (isset($errors['first_name'])): ?>
                <span class="form-comment red"><?= $errors['first_name'] ?></span>
            <?php endif; ?>
            <input id="surname" type="text" name="signup[last_name]" placeholder="фамилия"
                   value="<?= $form->last_name ?>" required>
            <?php if (isset($errors['last_name'])): ?>
                <span class="form-comment red"><?= $errors['last_name'] ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="email" class="info-field__head">Email</label>
            <input id="email" type="email" name="signup[email]" placeholder="логин для входа"
                   value="<?= $form->email ?>" required>
            <?php if (isset($errors['email'])): ?>
                <span class="form-comment red"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="phone" class="info-field__head">Мобильный&nbsp;телефон</label>
            <input id="phone" type="tel" name="signup[phone]" placeholder="+7 (123) 456-78-90"
                   value="<?= $form->phone ?>" required>
            <?php if (isset($errors['phone'])): ?>
                <span class="form-comment red"><?= $errors['phone'] ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="add-password" class="info-field__head">Пароль&nbsp;для&nbsp;входа</label>
            <input id="add-password" name="signup[password]" type="password" placeholder="не менее 8 символов" required>
            <?php if (isset($errors['password'])): ?>
                <span class="form-comment red"><?= $errors['password'] ?></span>
            <?php endif; ?>
        </div>

        <div>
        <!--<label for="repeat-password">Повторить&nbsp;пароль</label>-->
            <input id="repeat-password" name="signup[password_repeat]" type="password" placeholder="повторить пароль" required>
            <?php if (isset($errors['password_repeat'])): ?>
                <span class="form-comment red"><?= $errors['password_repeat'] ?></span>
            <?php endif; ?>
        </div>

        <div class="agreement">

            <div>Ознакомился и принимаю:</div>

            <div>
                <input id="partner-agreement" type="checkbox"
                       name="signup[confirm_agreement]" <?php if (!empty($form->confirm_agreement)) echo 'checked' ?> required>
                <label for="partner-agreement"><a href="//<?= HtmlHelpers::getMainDomain() ?>/rules" class="link" target="_blank">правила работы сервиса</a></label>
                <?php if (isset($errors['confirm_agreement'])): ?>
                    <span class="form-comment red"><?= $errors['confirm_agreement'] ?></span>
                <?php endif; ?>
            </div>

        </div>

        <div>
            <button class="btn-orange" type="submit" name="signup[submit_signup]">
                <span>Регистрация</span>
            </button>
        </div>

    </form>

</div>