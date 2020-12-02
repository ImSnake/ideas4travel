<?php

use app\forms\ChooseTypeForm;
use app\helpers\HtmlHelpers;
use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */
/* @var $form ChooseTypeForm */

// Получаем массив ошибок.
$errors = $form->errors['type'];

$this->title = "Выбор профиля организатора";

$this->cssFiles = [
    'partnership/partnership.css',
    'organizer/organizer-nav.css'
];

$this->jsFiles = ['organizer/organizer_common.js'];

?>

<!--открывающий <div class="center"> зашит в nav.php -->

<section class="activation container">

    <div class="activation__form">

        <h2 class="block-title">Профиль организатора</h2>

        <form name="chooseTypeForm" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">

            <div class="info-field__box">

                <div class="info-field__head">
                    <span>Я буду действовать как</span>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <h4 class="blue">ОРГАНИЗАЦИЯ:</h4>
                            <p>- Юридическое лицо</p>
                            <p>- Индивидуальный предприниматель</p>
                            <br>
                            <h4 class="blue">ЧАСТНОЕ ЛИЦО:</h4>
                            <p>- Физическое лицо</p>
                            <p>- Самозанятый</p>
                        </div>
                    </div>
                </div>
                <!-- не удалять имя: на нем держится логика радио-кнопок-->
                <input type="radio" id="company" name="type[type]" value="company">
                <label for="company"><span>организация</span></label>
                <!-- не удалять имя: на нем держится логика радио-кнопок-->
                <input type="radio" id="person" name="type[type]" value="person">
                <label for="person"><span>частное лицо</span></label>
                <?php if (isset($errors['type'])): ?>
                    <span class="form-comment red"><?= $errors['type'] ?></span>
                <?php endif; ?>

            </div>

            <div class="info-field__box">

                <div class="info-field__head">
                    <span>Название (имя профиля)</span>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Имя профиля будут видеть все посетители сайта</p>
                        </div>
                    </div>
                </div>

                <input name="type[name]" id="name" type="text" placeholder="до 50 символов"
                       value="<?= $form->name ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <span class="form-comment red"><?= $errors['name'] ?></span>
                <?php endif; ?>

            </div>

            <div class="info-field__box">

                <div class="info-field__text">Ознакомился и принимаю условия:</div>
                <!--                    <div>Принимаю условия:</div>-->
                <div class="info-field__content">
                    <input id="user-agreement" type="checkbox"
                           name="type[confirm_offer]" <?php if (!empty($form->confirm_offer)) echo 'checked' ?>
                           required>
                    <label for="user-agreement"></label><a href="//<?= HtmlHelpers::getMainDomain() ?>/rules" class="link" target="_blank">публичная оферта</a>
                    <?php if (isset($errors['confirm_offer'])): ?>
                        <span class="form-comment red"><?= $errors['confirm_offer'] ?></span>
                    <?php endif; ?>
                </div>
                <!--                </div>-->

            </div>

            <div>
                <button class="btn-orange" type="submit" name="type[submit_type]">
                    <span>создать профиль</span>
                </button>
            </div>

        </form>

    </div>

</section>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->