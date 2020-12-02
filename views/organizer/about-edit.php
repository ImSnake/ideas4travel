<?php

/* @var $about */

$this->title = "Редактировать информацию об организаторе";

$this->cssFiles = ['organizer/profile.css'];
$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_form.js'
];

?>

<!--открывающий <div class="center"> зашит в nav.php -->

<div class="container">

    <section class="organizer__profile">

        <div class="organizer__information">

            <div class="back-n-wrap" data-page="">
                <a href="/organizer"><span>назад</span><span class="mobile">&nbsp;в&nbsp;Меню</span></a>
                <h2>Редактировать описание деятельности</h2>
            </div>

            <!-- ФОРМА ДЛЯ "ОБ ОРГАНИЗАТОРЕ" -->

            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" class="organizer__about">

                <h2 class="block-title">Об&nbsp;организаторе</h2>

                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">

                    <div class="organizer__info-field">
                        <textarea id="organizer-about" rows="16" maxlength="1000" name="about[about]"
                                  placeholder="до 1000 символов"><?= $about ?></textarea>
                    </div>

                    <div class="organizer__button">
                        <button type="submit" class="btn-blue" name="about[submit-about]">
                            <span>Сохранить</span>
                        </button>
                    </div>

                </form>


        </div>

    </section>

</div>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->