<?php

use app\services\renderer\TemplateRenderer;
use app\Models\Partner;
use app\widgets\moderation\PersonWidget;
use app\widgets\moderation\ContactWidget;
use app\widgets\moderation\CompanyWidget;
use app\widgets\moderation\AboutWidget;
use app\base\App;
use app\Models\User;
use app\helpers\HtmlHelpers;
use app\Models\organizer\PartnerStatusRejected;

/* @var $this TemplateRenderer */
/** @var $partner */
/** @var $user */
/** @var $dateInSite */
/** @var $typePartner */

$this->title = "Профиль организатора";
$this->description = "Информация и контакты организатора";

$this->cssFiles = ['tour/tour.css', 'organizer/moderator.css'];

$this->jsFiles = [
    'ajax/moderation/moderation-ajax.js',
];

?>

<div style="margin: 30px" class="catalog-container">

    <?php if (App::get()->auth->getRole() == User::ROLE_MODERATOR): ?>
        <!-- ВИДЖЕТ "program-moderation"-->
        <div id="partner-moderation" data-partner-id="<?= $partner->id ?>">

            <?php if ($partner->status == Partner::STATUS_CONFIRM): ?>
                <h4 class="green">ПАРТНЕР ПРОШЕЛ МОДЕРАЦИЮ</h4>
            <?php elseif ($partner->status == Partner::STATUS_IN_MODERATION): ?>
                <h4 class="orange">ПАРТНЕР НА МОДЕРАЦИИ</h4>
            <?php elseif ($partner->status == Partner::STATUS_IN_MODERATION): ?>
                <h4 class="orange">ПРОФИЛЬ ПАРТНЕРА НЕ ПОДТВЕРЖДЕН</h4>
            <?php elseif ($partner->status == Partner::STATUS_REJECTED): ?>
                <h4 class="red">ПАРТНЕР НЕ ПРОШЕЛ МОДЕРАЦИЮ</h4>
            <?php elseif ($partner->status == Partner::STATUS_BLOCKED): ?>
                <h4 class="red">ПАРТНЕР ЗАБЛОКИРОВАН</h4>
            <?php endif; ?>

            <?php if (in_array($partner->status, [Partner::STATUS_IN_MODERATION, Partner::STATUS_REJECTED])): ?>
                <div style="border: 1px solid #fd5571; padding: 12px 12px 0 12px; margin: 24px 0;">

                    <?php
                    // Получаем комментарии к октлоненной программы.
                    $partnerStatusRejected = (new PartnerStatusRejected())->getAllWhere(['partner_id' => $partner->id]);
                    ?>

                    <?php if (!empty($partnerStatusRejected)): ?>
                        <?php foreach ($partnerStatusRejected as $comment): ?>
                            <div>
                                <div style="font-weight: bold"><?= date('d.m.Y', strtotime($comment['create_at'])) ?></div>
                                <div class="history__comment"><?= HtmlHelpers::wrapTextInTag($comment['comment'],
                                        'p') ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if ($partner->status == Partner::STATUS_IN_MODERATION): ?>
                <div style="margin: 24px 0">
                    <button id="button-approve" class="green">ПОДТВЕРДИТЬ</button>
                </div>
            <div>
                <div><label for="moderation__comment">Комментарий модератора</label></div>
                <div style="margin: 12px 0"><textarea name="" id="moderation__comment" required style="width: 320px"></textarea></div>
                <div><button id="button-reject" class="red">ОТКЛОНИТЬ</button></div>
            </div>

            <?php endif; ?>

        </div>
    <?php endif; ?>


    <p><a href="/moderation/partners">Вернуться к списку партнеров</a></p>

    <h1><?= $partner->name_profile ?></h1>
    <p>
        <img src="<?= '/images/avatars/middle/' . $partner->avatar ?>" alt="organizer_avatar">
    </p>

    <p>
        <span style="font-weight: bold">Дата регистрации:</span>
        <span><?= $dateInSite ?></span>
    </p>

    <p>
        <span style="font-weight: bold">Имя профиля:</span>
        <span><?= $partner->name_profile ?></span>
    </p>

    <p>
        <span style="font-weight: bold">Контактное лицо:</span>
        <span><?= $user->first_name . ' ' . $user->last_name ?></span>
    </p>

    <p>
        <span style="font-weight: bold">Email:</span>
        <span><?= $user->email ?></span>
    </p>

    <p>
        <span style="font-weight: bold">Телефон:</span>
        <span><?= $user->phone ?></span>
    </p>

    <?php

    if ($typePartner == Partner::TYPE_PERSON) {
        // Виджет Частный гид для ЛКП.
        new PersonWidget(['partner' => $partner]);
    }

    if ($typePartner == Partner::TYPE_COMPANY) {
        // Виджет Компании для ЛКП.
        new CompanyWidget(['partner' => $partner]);
    }

    // Виджет Контакты для ЛКП.
    new ContactWidget(['partner' => $partner]);

    // Виджет О комании для ЛКП.
    new AboutWidget(['partner' => $partner]);

    ?>

</div>