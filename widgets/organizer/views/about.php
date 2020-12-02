<?php

use app\helpers\HtmlHelpers;
use app\base\App;
use app\Models\Partner;

/** @var $about */
/** @var Partner $partner */
$partner = App::get()->auth->getPartner();

?>

<!-- ОБ ОРГАНИЗАТОРЕ: блок всегда доступен для редактирования без обращения к модератору -->
<div class="organizer__about">

    <!--    <div class="hover edit-menu">-->
    <!--        <div class="menu-list fade hide-element">-->
    <!--            <span><a href="/organizer/about-edit">Редактировать</a></span>-->
    <!--        </div>-->
    <!--    </div>-->

    <?php if ($partner->status != Partner::STATUS_IN_MODERATION): ?>
        <a href="/organizer/about-edit" class="edit-menu"></a>
    <?php endif; ?>

    <h2 class="block-title">Об&nbsp;организаторе</h2>

    <div class="organizer__info-field">
        <?php if ($about): ?>
            <span class="info-field__content"><?= HtmlHelpers::wrapTextInTag($about, 'p') ?></span>
        <?php else: ?>
            <span class="info-field__content unfilled">добавить</span>
        <?php endif; ?>

    </div>

</div>