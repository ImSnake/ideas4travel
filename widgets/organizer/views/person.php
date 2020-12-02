<?php

use app\Models\organizer\Person;
use app\helpers\HtmlHelpers;
use app\base\App;
use app\Models\Partner;

/** @var $person Person */
/** @var Partner $partner */
$partner = App::get()->auth->getPartner();

?>

<!-- Организатор "ЧАСТНЫЙ ГИД": после проверки профиля нельзя редактировать -->
<div class="organizer__personal-data media-default">

    <!--    <div class="hover edit-menu">-->
    <!--        <div class="menu-list fade hide-element">-->
    <!--            <span><a href="/organizer/person-edit">Редактировать</a></span>-->
    <!--        </div>-->
    <!--    </div>-->

    <?php if (!in_array($partner->status, [Partner::STATUS_IN_MODERATION, Partner::STATUS_CONFIRM])): ?>
        <a href="/organizer/person-edit" class="edit-menu"></a>
    <?php endif; ?>

    <h2 class="block-title">Частный гид</h2>

    <?php if ($person->first_name): ?>

        <div class="organizer__info-field">

            <span class="info-field__head">имя организатора</span>
            <?php if ($person->first_name): ?>
                <span class="info-field__content"><?= $person->last_name ? $person->last_name : '' ?> <?= $person->first_name ? $person->first_name : '' ?> <?= $person->patronymic ? $person->patronymic : '' ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">Дата&nbsp;рождения</span>

            <?php if ($person->birthday): ?>
                <span class="info-field__content"><?= $person->birthday ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <?php if ($person->fact_match == 'on'): ?>

            <div class="organizer__info-field">

                <span class="info-field__head">АДРЕС&nbsp;ПРОЖИВАНИЯ И РЕГИСТРАЦИИ</span>

                <?php if ($person->fullAddressReg): ?>
                    <span class="info-field__content"><?= $person->fullAddressReg ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

        <?php else: ?>

            <div class="organizer__info-field">

                <span class="info-field__head">АДРЕС ПО ПРОПИСКЕ</span>

                <?php if ($person->fullAddressReg): ?>
                    <span class="info-field__content"><?= $person->fullAddressReg ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

            <div class="organizer__info-field">

                <span class="info-field__head">АДРЕС&nbsp;ПРОЖИВАНИЯ</span>

                <?php if ($person->fullAddressFact): ?>
                    <span class="info-field__content"><?= $person->fullAddressFact ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    <?php else: ?>
        <span class="info-field__content unfilled">заполнить профиль</span>
    <?php endif; ?>

</div>