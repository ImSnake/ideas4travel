<?php

use app\Models\organizer\Contact;
use app\Models\Partner;
use app\base\App;

/** @var $contact Contact */
/** @var Partner $partner */
$partner = App::get()->auth->getPartner();

?>

<!-- КОНТАКТЫ: после проверки профиля при редактировании можно только добавлять данные и нельзя удалять проверенную информацию -->
<div class="organizer__links">

    <!--    <div class="hover edit-menu">-->
    <!--        <div class="menu-list fade hide-element">-->
    <!--            <span><a href="/organizer/contact-edit">Редактировать</a></span>-->
    <!--        </div>-->
    <!--    </div>-->

    <?php if (!in_array($partner->status, [Partner::STATUS_IN_MODERATION, Partner::STATUS_CONFIRM])): ?>
        <a href="/organizer/contact-edit" class="edit-menu"></a>
    <?php endif; ?>

    <h2 class="block-title">Контакты</h2>

    <div class="links__group">

        <div class="organizer__info-field">

            <?php if ($contact->website): ?>
                <span class="info-field__icon website"></span>
                <a href="<?= $contact->website ?>" target="_blank"
                   class="info-field__content link"><?= $contact->website ?></a>
            <?php else: ?>
                <span class="info-field__icon website empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->facebook): ?>
                <span class="info-field__icon facebook"></span>
                <a href="<?= $contact->facebook ?>" target="_blank"
                   class="info-field__content link"><?= $contact->facebook ?></a>
            <?php else: ?>
                <span class="info-field__icon facebook empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->instagram): ?>
                <span class="info-field__icon instagram"></span>
                <a href="<?= $contact->instagram ?>" target="_blank"
                   class="info-field__content link"><?= $contact->instagram ?></a>
            <?php else: ?>
                <span class="info-field__icon instagram empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->vkontacte): ?>
                <span class="info-field__icon vkontacte"></span>
                <a href="<?= $contact->vkontacte ?>" target="_blank"
                   class="info-field__content link"><?= $contact->vkontacte ?></a>
            <?php else: ?>
                <span class="info-field__icon vkontacte empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->youtube): ?>
                <span class="info-field__icon youtube"></span>
                <a href="<?= $contact->youtube ?>" target="_blank"
                   class="info-field__content link"><?= $contact->youtube ?></a>
            <?php else: ?>
                <span class="info-field__icon youtube empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->telegram): ?>
                <span class="info-field__icon telegram"></span>
                <span class="info-field__content text"><?= $contact->telegram ?></span>
            <?php else: ?>
                <span class="info-field__icon telegram empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->whatsapp): ?>
                <span class="info-field__icon whatsapp"></span>
                <span class="info-field__content text"><?= $contact->whatsapp ?></span>
            <?php else: ?>
                <span class="info-field__icon whatsapp empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->viber): ?>
                <span class="info-field__icon viber"></span>
                <span class="info-field__content text"><?= $contact->viber ?></span>
            <?php else: ?>
                <span class="info-field__icon viber empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->skype): ?>
                <span class="info-field__icon skype"></span>
                <span class="info-field__content text"><?= $contact->skype ?></span>
            <?php else: ?>
                <span class="info-field__icon skype empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

        <div class="organizer__info-field">

            <?php if ($contact->phone): ?>
                <span class="info-field__icon phone"></span>
                <span class="info-field__content text"><?= $contact->phone ?></span>
            <?php else: ?>
                <span class="info-field__icon phone empty-icon"></span>
                <span class="info-field__content unfilled">добавить</span>
            <?php endif; ?>

        </div>

    </div>

</div>