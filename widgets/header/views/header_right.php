<?php

use app\Models\User;
use app\Models\Partner;
use app\base\App;
use app\services\Currency;

/** @var $user User */
/** @var $partner Partner */

/** @var Currency $currency */
$currency = App::get()->currency;
// Получаем ID валюты выбранной пользователем для отображения.
$getUserCurrencyID = $currency->getUserCurrencyID();

?>

<!-- Общий блок для всех (виден всегда): посетитетль, зарегестрированный пользователь и партнер -->
<div class="header__currency">
    <form action="#">
        <div class="select-cover">
            <select name="currency" id="currency">
                <?php foreach ($currency->getCurrency() as $item): ?>
                    <?php if ($item['id'] == $getUserCurrencyID): ?>
                        <?php $selected = 'selected'; ?>
                    <?php else: ?>
                        <?php $selected = ''; ?>
                    <?php endif; ?>
                    <option value="<?= $item['id'] ?>" <?= $selected ?>><?= $item['symbol'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>


<div class="header__notifications">

    <!-- для партнерского сайта ТОЛЬКО для АВТОРИЗОВАННОГО партнера -->
    <?php if ($user): ?>
        <div class="header__requests">
            <a href="/requests">
                <!--<span class="notifications__point"></span>-->
                <i class="icon-suitcase"></i>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($user): ?>
        <!-- Общий блок для всех АВТОРИЗОВАННЫХ юзеров: пользователь и партнер -->
        <!--        <div class="header__chat">
                    <a href="#">
                        <span class="notifications__point"></span>
                        <i class="icon-chat-1"></i>
                    </a>
                </div>-->
    <?php endif; ?>

</div>

<div class="header__menu">

    <div class="header__user">

        <?php if ($user): ?>
            <!-- ТОЛЬКО для партнерского сайта после авторизации партнера -->
            <div class="user__avatar">
                <?php if ($partner): ?>
                    <img src="/images/avatars/mini/<?= $partner->avatar ?>"
                         alt="user-avatar">
                <?php else: ?>
                    <img src="/images/avatars/mini/avatar.png" alt="user-avatar">
                <?php endif; ?>
                <div class="menu-list right fade hide-element">
                    <span class="close-pop-up"></span>
                    <!--                            <div><a href="/organizer">Профиль</a></div>-->
                    <!--<div><a href="/support">Помощь</a></div>-->
                    <div><a href="/support/knowledge-base#how-to-publish">База знаний</a></div>
                    <div><a href="/organizer/new-password">Сменить пароль</a></div>
                    <div><a href="/auth/logout">Выход</a></div>
                </div>
            </div>
        <?php else: ?>
            <!-- ТОЛЬКО для партнерского сайта до авторизации партнера -->
            <div class="user_unknown">
                <div class="user__icon">
                    <i class="icofont-user"></i>
                </div>
                <div class="menu-list right fade hide-element">
                    <span class="close-pop-up"></span>
                    <div><a href="/auth">Войти</a></div>
                    <div><a href="/signup">Регистрация</a></div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
