<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\User;
use app\services\Auth;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var User $user */
$user = $auth->getUser();
///** @var Partner $partner */
//$partner = $auth->getPartner();
/** @var int $partnerId */
$partnerId = $partner->id;
/** @var null|string $error */
$error = null;

// Получаем переданный Id партнера.
$partner_id = (int)$_POST['partner_id'];
/** @var Partner $partner */
$partner = (new Partner())->getOne($partner_id);

if (empty($partner_id) || !is_int($partner_id)) {
    $error = 'Передан некорректный id партнера.';
}

// Проверяем принадлежит ли программа партнеру.
if ($user->role != User::ROLE_MODERATOR) {
    $error = 'Вы не имеете прав для модерации партнера.';
}

if (is_null($error)) {
    // Проверяем находится ли партнер на модерации.
    if ($partner->status == Partner::STATUS_IN_MODERATION) {
        // Меняем статус партнера.
        $partner->status = Partner::STATUS_CONFIRM;
        $partner->status_at = date('Y-m-d H:i:s', time());
        $partner->save();
    } else {
        $error = 'Партнер не находится на модерации';
    }
}

echo json_encode(['post' => $_POST, 'error' => $error]);
