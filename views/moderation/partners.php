<?php

use app\services\renderer\TemplateRenderer;
use app\Models\Partner;

/* @var $errors */
/* @var $partners array */
/* @var $this TemplateRenderer */

$this->title = "Список партнеров";
$this->description = "";

$this->cssFiles = ['organizer/moderator.css'];

?>

<div class="container back-n-wrap">
    <a href="/moderation" class="link">на главную страницу</a>
</div>

<section class="container moderation">

    <!--    <h1 class="block-title">Список программ доступных для модератора</h1>-->

    <?php if ($partners[Partner::STATUS_IN_MODERATION]): ?>
        <h2 class="table__title orange"><?= Partner::STATUS_NAMES[Partner::STATUS_IN_MODERATION] ?></h2>
        <div class="table">
            <?php foreach ($partners[Partner::STATUS_IN_MODERATION] as $partner): ?>
                <div class="table__row">
                    <div class="user__avatar" style="box-sizing: content-box">
                        <img src="/images/avatars/mini/<?= $partner['avatar'] ?>" alt="">
                    </div>
                    <div class="table__data">
                        <a href="/moderation/partners/<?= $partner['id'] ?>" class="link"><?= $partner['name_profile'] ?></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($partners[Partner::STATUS_REJECTED]): ?>
        <h2 class="table__title orange"><?= Partner::STATUS_NAMES[Partner::STATUS_REJECTED] ?></h2>
        <div class="table">
            <?php foreach ($partners[Partner::STATUS_REJECTED] as $partner): ?>
                <div class="table__row">
                    <div class="user__avatar" style="box-sizing: content-box">
                        <img src="/images/avatars/mini/<?= $partner['avatar'] ?>" alt="">
                    </div>
                    <div class="table__data">
                        <a href="/moderation/partners/<?= $partner['id'] ?>" class="link"><?= $partner['name_profile'] ?></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($partners[Partner::STATUS_CONFIRM]): ?>
        <h2 class="table__title orange"><?= Partner::STATUS_NAMES[Partner::STATUS_CONFIRM] ?></h2>
        <div class="table">
            <?php foreach ($partners[Partner::STATUS_CONFIRM] as $partner): ?>
                <div class="table__row">
                    <div class="user__avatar" style="box-sizing: content-box">
                        <img src="/images/avatars/mini/<?= $partner['avatar'] ?>" alt="">
                    </div>
                    <div class="table__data">
                        <a href="/moderation/partners/<?= $partner['id'] ?>" class="link"><?= $partner['name_profile'] ?></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($partners[Partner::STATUS_BLOCKED]): ?>
        <h2 class="table__title orange"><?= Partner::STATUS_NAMES[Partner::STATUS_BLOCKED] ?></h2>
        <div class="table">
            <?php foreach ($partners[Partner::STATUS_BLOCKED] as $partner): ?>
                <div class="table__row">
                    <div class="user__avatar" style="box-sizing: content-box">
                        <img src="/images/avatars/mini/<?= $partner['avatar'] ?>" alt="">
                    </div>
                    <div class="table__data">
                        <a href="/moderation/partners/<?= $partner['id'] ?>" class="link"><?= $partner['name_profile'] ?></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($partners[Partner::STATUS_NOT_CONFIRM]): ?>
        <h2 class="table__title orange"><?= Partner::STATUS_NAMES[Partner::STATUS_NOT_CONFIRM] ?></h2>
        <div class="table">
            <?php foreach ($partners[Partner::STATUS_NOT_CONFIRM] as $partner): ?>
                <div class="table__row">
                    <div class="user__avatar" style="box-sizing: content-box">
                        <img src="/images/avatars/mini/<?= $partner['avatar'] ?>" alt="">
                    </div>
                    <div class="table__data">
                        <a href="/moderation/partners/<?= $partner['id'] ?>" class="link"><?= $partner['name_profile'] ?></a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section>
