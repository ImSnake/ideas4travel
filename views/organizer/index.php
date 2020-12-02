<?php

use app\base\App;
use app\Models\Partner;
use app\services\renderer\TemplateRenderer;
use app\widgets\organizer\AboutWidget;
use app\widgets\organizer\CompanyWidget;
use app\widgets\organizer\ContactWidget;
use app\widgets\organizer\MainWidget;
use app\widgets\organizer\PersonWidget;
use app\Models\organizer\PartnerStatusRejected;
use app\helpers\HtmlHelpers;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Профиль организатора";
$this->description = "Информация и контакты организатора";

$this->cssFiles = ['organizer/profile.css'];

$this->jsFiles = [
    'organizer/organizer_common.js',
    'organizer/organizer_profile.js',
    'jquery/jquery.common_plugins.js',
    'ajax/upload_avatar.js',
    'ajax/organizer/partner-moderation.js'
];

/** @var Partner $partner */
$partner = App::get()->auth->getPartner();
/** @var int $typePartner - тип партнера. */
$typePartner = $partner->partner_entity_id;

?>

<!-- <div class="center"> -->

<section id="organizer-profile" class="container organizer__profile hide-element" data-partner-id="<?= $partner->id ?>">

    <div id="profile-wrap" class="back-n-wrap" data-page="profile">
        <a href="#nav-organizer"><span>назад в Меню</span></a>
        <h2>Профиль</h2>
    </div>

    <div class="organizer__information">

        <?php

        // Виджет основного блока ЛКП.
        new MainWidget();

        if ($typePartner == Partner::TYPE_PERSON) {
            // Виджет Частный гид для ЛКП.
            new PersonWidget();
        }

        if ($typePartner == Partner::TYPE_COMPANY) {
            // Виджет Компании для ЛКП.
            new CompanyWidget();
        }

        // Виджет Контакты для ЛКП.
        new ContactWidget();

        // Виджет О комании для ЛКП.
        new AboutWidget();

        ?>

        <!-- АКТИВАЦИЯ ПРОФИЛЯ (отправить на проверку модератору) -->
        <div class="organizer__activate">

            <div>

                <?php if (in_array($partner->status, [Partner::STATUS_NOT_CONFIRM, Partner::STATUS_REJECTED])): ?>
                    <?php if ($partner->status == Partner::STATUS_REJECTED): ?>
                        <div class="red">ПРОФИЛЬ ОТКЛОНЕН</div>
                        <?php if (in_array($partner->status, [Partner::STATUS_REJECTED])): ?>
                            <div style="border: 1px solid #fd5571; padding: 12px 12px 0 12px; margin: 24px 0;">

                                <?php
                                // Получаем комментарии к октлоненной программы.
                                $partnerStatusRejected = (new PartnerStatusRejected())->getAllWhere(['partner_id' => $partner->id]);
                                ?>

                                <?php if (!empty($partnerStatusRejected)): ?>
                                    <?php foreach ($partnerStatusRejected as $comment): ?>
                                        <div>
                                            <div style="font-weight: bold">
                                                <?= date('d.m.Y', strtotime($comment['create_at'])) ?>
                                            </div>
                                            <div class="history__comment">
                                                <?= HtmlHelpers::wrapTextInTag($comment['comment'], 'p') ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <button id="button_partner_moderation" class="btn-orange" type="submit">
                        <span>Подтвердить профиль</span>
                    </button>
                    <div class="help hover">
                        <div class="help-pop-up top fade hide-element">
                            <span class="close-pop-up"></span>
                            <p>Чтобы публиковать объявления на сайте, заполни данные профиля и отправь информацию на
                                проверку.</p>
                            <p>Узнай больше о&nbsp;<a class="link" href="/support/knowledge-base#profile-check">подтверждении&nbsp;профиля</a>
                            </p>
                        </div>
                    </div>
                <?php elseif ($partner->status == Partner::STATUS_IN_MODERATION): ?>
                    <div class="grey">ПРОФИЛЬ НА МОДЕРАЦИИ</div>
                <?php elseif ($partner->status == Partner::STATUS_CONFIRM): ?>
                    <div class="green">ПРОФИЛЬ ПОДТВЕРЖДЕН</div>
                <?php elseif ($partner->status == Partner::STATUS_BLOCKED): ?>
                    <div class="bold">ПРОФИЛЬ ЗАБЛОКИРОВАН</div>
                <?php endif; ?>

            </div>

        </div>

    </div>

</section>

<!-- закрывающий тег для <div class="center"> / начало в nav.php -->
<!--</div>-->
