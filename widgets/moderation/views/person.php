<?php

use app\Models\organizer\Person;

/** @var $person Person */

?>

    <h2>Частный гид</h2>

<?php if ($person->first_name): ?>

    <p>
        <span style="font-weight: bold">имя организатора:</span>
        <span>
                <?= $person->last_name ? $person->last_name : '' ?>
                <?= $person->first_name ? $person->first_name : '' ?>
                <?= $person->patronymic ? $person->patronymic : '' ?>
            </span>
    </p>

    <p>
        <span style="font-weight: bold">Дата&nbsp;рождения:</span>
        <span><?= $person->birthday ?></span>
    </p>

    <?php if ($person->fact_match == 'on'): ?>

        <p>
            <span style="font-weight: bold">Адрес проживания и регистрации:</span>
            <span class="info-field__content"><?= $person->fullAddressReg ?></span>
        </p>

    <?php else: ?>

        <p>
            <span style="font-weight: bold">Адрес по прописке:</span>
            <span class="info-field__content"><?= $person->fullAddressReg ?></span>
        </p>

        <p>
            <span style="font-weight: bold">Адрес проживания</span>
            <span class="info-field__content"><?= $person->fullAddressFact ?></span>
        </p>

    <?php endif; ?>

<?php else: ?>

    <p>не заполнено</p>

<?php endif; ?>