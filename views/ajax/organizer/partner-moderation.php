<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\helpers\MailHelpers;
use app\helpers\ProgramValidate;
use app\Models\program\Program;
use app\services\Auth;
use app\Models\User;
use app\Models\tour\Tour;
use app\helpers\PartnerValidate;
use app\Models\Partner;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Partner $partner */
$partner = $auth->getPartner();
/** @var null|string $error */
$error = null;

// Получаем полученный через ajax id партнера.
$partner_id = (int)$_POST['partner_id'];

if (empty($partner_id) || !is_int($partner_id)) {
    $error = 'Передан некорректный id программы.';
}

// Проверяем принадлежит ли программа партнеру.
if ($partner_id != $partner->id) {
    $error = 'Вы не имеете прав отправлять профиль партнера на модерацию.';
}

if (is_null($error)) {
    // Выполняем проверку партнера.
    $partnerValidate = new PartnerValidate($partner);

    // Проверяем прошел ли партнер валидацию.
    if ($partnerValidate->isValidate()) {
        // Меняем статус партнера.
        $partner->status = Partner::STATUS_IN_MODERATION;
        $partner->status_at = date('Y-m-d H:i:s', time());
        $partner->save();
        // Модератору отправляется письмо со ссылкой на партнера.
        MailHelpers::sendEmailPartnerInModeration(EMAIL_MODERATOR, $partner);
    } else {
        $error = 'Профиль рганизатора не прошел валидацию. Проверьте правильность заполнения полей:<br><br>';
        foreach ($partnerValidate->getErrors() as $e) {
            $error .= $e . "<br><br>";
        }
    }
}

echo json_encode(['post' => $_POST, 'partner' => $partner, 'error' => $error]);