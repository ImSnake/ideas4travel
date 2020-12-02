<?php

use app\Models\organizer\Company;
use app\Models\organizer\PartnerForm;
use app\Models\Partner;

/** @var $company Company */
/** @var $partner Partner */

?>

<h2>Организация</h2>

<?php if ($company->partner_type_id): ?>

    <?php if ($company->partner_type_id == Partner::PARTNER_TYPE_OPERATOR): ?>

        <p>
            <span style="font-weight: bold">Номер лицензии туроператора:</span>
            <span><?= $company->rto_number ?></span>
        </p>

    <?php endif; ?>

    <p>
        <span style="font-weight: bold">Название:</span>
        <?php $partner_form = PartnerForm::getPartnerForm(Partner::TYPE_COMPANY)[$company->partner_form_id]; ?>
        <span><?= $company->partner_form_id ? $partner_form['abbr'] : '' ?> <?= $company->name ?></span>
    </p>

    <p>
        <span style="font-weight: bold">ИНН:</span>
        <span><?= $company->inn ?></span>
    </p>

    <?php if ($company->fact_match == 'on'): ?>

        <p>
            <span style="font-weight: bold">Юридический и Фактический адрес:</span>
            <span><?= $company->fullAddressReg ?></span>
        </p>

    <?php else: ?>

        <p>
            <span style="font-weight: bold">Юридический адрес:</span>
            <span><?= $company->fullAddressReg ?></span>
        </p>

        <p>
            <span style="font-weight: bold">Фактический адрес:</span>
            <span class="info-field__content"><?= $company->fullAddressFact ?></span>
        </p>

    <?php endif; ?>

    <p>
        <span style="font-weight: bold">доп. телефон:</span>
        <span><?= $company->phone ?></span>
    </p>

    <p>
        <span style="font-weight: bold">доп. email:</span>
        <span><?= $company->email ?></span>
    </p>

<?php else: ?>

    <p>не заполнено</p>

<?php endif; ?>
