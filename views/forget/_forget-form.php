<?php

/* @var $error */
/* @var $email string */

?>

<div class="authorization__form register">

    <h2 class="block-title">Восстановить пароль</h2>

    <form name="signupForm" method="post" action="<?= $actionSignupForm ?>">

        <div>
            <label for="email" class="info-field__head">логин личного кабинета</label>
            <input id="email" type="email" name="forget[email]" placeholder="email"
                   value="<?= $email ?>" required>
            <?php if (isset($error)): ?>
                <span class="form-comment red"><?= $error ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button class="btn-orange" type="submit" name="forget[submit]">
                <span>Далее</span>
            </button>
        </div>

    </form>

</div>