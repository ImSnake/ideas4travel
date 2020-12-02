<?php

use app\Models\organizer\Company;
use app\Models\organizer\PartnerForm;
use app\Models\organizer\PartnerType;
use app\Models\Partner;

/** @var $company Company */
/** @var $partner Partner */

?>

<!-- Организатор "ОРГАНИЗАЦИЯ": после проверки профиля нельзя редактировать -->
<div class="organizer__personal-data media-default">

    <!--    <div class="hover edit-menu">-->
    <!--        <div class="menu-list fade hide-element">-->
    <!--            <span><a href="/organizer/company-edit">Редактировать</a></span>-->
    <!--        </div>-->
    <!--    </div>-->

    <?php if (!in_array($partner->status, [Partner::STATUS_IN_MODERATION, Partner::STATUS_CONFIRM])): ?>
        <a href="/organizer/company-edit" class="edit-menu"></a>
    <?php endif; ?>

    <h2 class="block-title">Организация</h2>

    <?php if ($company->partner_type_id): ?>

        <?php if ($company->partner_type_id == Partner::PARTNER_TYPE_OPERATOR): ?>

<!--            <div class="organizer__info-field">-->
<!---->
<!--                <span class="info-field__head">ДЕЯТЕЛЬНОСТЬ</span>-->
<!---->
<!--                --><?php //if ($company->partner_type_id): ?>
<!--                    <span class="info-field__content">--><?//= PartnerType::getPartnerTypes(Partner::TYPE_COMPANY)[$company->partner_type_id] ?><!--</span>-->
<!--                --><?php //else: ?>
<!--                    <span class="info-field__content unfilled">добавить</span>-->
<!--                --><?php //endif; ?>
<!---->
<!--            </div>-->

            <!-- ПОКАЗЫВАТЬ СТРОКУ "Номер лицензии" ТОЛЬКО ДЛЯ ПАРТНЕРА "ОРГАНИЗАТОР-ТУРОПЕРАТОР" -->
            <div class="organizer__info-field">

                <span class="info-field__head">НОМЕР ЛИЦЕНЗИИ ТУРОПЕРАТОРА</span>

                <?php if ($company->rto_number): ?>
                    <span class="info-field__content"><?= $company->rto_number ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>
            <!-- ПОКАЗЫВАТЬ СТРОКУ "Номер лицензии" ТОЛЬКО ДЛЯ ПАРТНЕРА "ОРГАНИЗАТОР-ТУРОПЕРАТОР" -->

        <?php endif; ?>

        <div class="organizer__info-field">

            <span class="info-field__head">НАЗВАНИЕ</span>

            <?php if ($company->name): ?>
                <?php $partner_form = PartnerForm::getPartnerForm(Partner::TYPE_COMPANY)[$company->partner_form_id]; ?>
                <span class="info-field__content"><?= $company->partner_form_id ? $partner_form['abbr'] : '' ?> <?= $company->name ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">ИНН</span>

            <?php if ($company->inn): ?>
                <span class="info-field__content"><?= $company->inn ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <?php if ($company->fact_match == 'on'): ?>

            <div class="organizer__info-field">

                <span class="info-field__head">Юридический и Фактический&nbsp;адрес</span>

                <?php if ($company->fullAddressReg): ?>
                    <span class="info-field__content"><?= $company->fullAddressReg ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

        <?php else: ?>

            <div class="organizer__info-field">

                <span class="info-field__head">Юридический&nbsp;адрес</span>

                <?php if ($company->fullAddressReg): ?>
                    <span class="info-field__content"><?= $company->fullAddressReg ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

            <div class="organizer__info-field">

                <span class="info-field__head">Фактический&nbsp;адрес</span>

                <?php if ($company->fullAddressFact): ?>
                    <span class="info-field__content"><?= $company->fullAddressFact ?></span>
                <?php else: ?>
                    <span class="info-field__content unfilled">добавить</span>
                <?php endif; ?>

            </div>

        <?php endif; ?>

        <div class="organizer__info-field">

            <span class="info-field__head">ДОП.&nbsp;ТЕЛЕФОН</span>

            <?php if ($company->phone): ?>
                <span class="info-field__content"><?= $company->phone ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">ДОП.&nbsp;EMAIL</span>

            <?php if ($company->email): ?>
                <span class="info-field__content"><?= $company->email ?></span>
            <?php else: ?>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

    <?php else: ?>
        <span class="info-field__content unfilled">заполнить профиль</span>
    <?php endif; ?>

</div>