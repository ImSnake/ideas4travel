<?php

/* @var $errors */
/* @var $true */

$this->title = "Изменение пароля";

$this->cssFiles = ['organizer/profile.css', 'partnership/partnership.css'];
$this->jsFiles = ['organizer/organizer_common.js'];

?>

<div class="container">

    <section class="authorization">

        <div class="authorization__form register">
            <a href="<?= $_SESSION['HTTP_REFERER_NEW_PASSWORD'] ?>"><span class="close-pop-up"></span></a>

            <h2 class="block-title">Смена пароля</h2>

            <?php if($true): ?>

            <form method="post" id="new_password" action="<?= $_SERVER['REQUEST_URI'] ?>">

                <div>
                    <label for="add-password" class="info-field__head">Старый пароль</label>
                    <input id="add-password" name="new-password[old_password]" type="password" placeholder="не менее 8 символов"
                           required>
                    <?php if (isset($errors['old_password'])): ?>
                        <span class="form-comment red"><?= $errors['old_password'] ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="add-password" class="info-field__head">Новый пароль&nbsp;для&nbsp;входа</label>
                    <input id="add-password" name="new-password[password]" type="password" placeholder="не менее 8 символов"
                           required>
                    <?php if (isset($errors['password'])): ?>
                        <span class="form-comment red"><?= $errors['password'] ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="repeat-password" class="info-field__head">Повторить пароль</label>
                    <input id="repeat-password" name="new-password[password_repeat]" type="password"
                           placeholder="повторить пароль" required>
                    <?php if (isset($errors['password_repeat'])): ?>
                        <span class="form-comment red"><?= $errors['password_repeat'] ?></span>
                    <?php endif; ?>
                </div>

                <div>
                    <button class="btn-orange" type="submit" name="new-password[submit]">
                        <span>Изменить</span>
                    </button>
                </div>

            </form>

            <?php else: ?>

                <p>Пароль успешно изменен!</p>

            <?php endif; ?>

    </section>

</div>

</div>
