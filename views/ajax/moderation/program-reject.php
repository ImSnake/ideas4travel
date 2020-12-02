<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\Models\program\PrStatusRejected;
use app\services\Mailer;
use app\Models\User;
use app\helpers\MailHelpers;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var User $user */
$user = $auth->getUser();
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем Id редактируемой программы.
$programId = $_POST['program_id'];
$comment = $_POST['comment'];

/** @var Program $program */
$program = (new Program())->getOne($programId);

/** @var User $p_user */
$p_user = (new User())->getOne(['partner_id' => $program->partner_id]);

// Проверяем принадлежит ли программа партнеру.
if ($user->role != User::ROLE_MODERATOR) {
    $error = 'Вы не имеете прав для публикации тура.';
}

if (is_null($error)) {
    // Меняем статус программы.
    $program->status = Program::STATUS_REJECTED;
    $program->status_at = date('Y-m-d H:i:s', time());
    $program->save();

    // Заносим дополнительную информацию по отклоненной программе.
    $prStatusRejected = new PrStatusRejected();
    $prStatusRejected->create_at = date('Y-m-d H:i:s', time());
    $prStatusRejected->partner_id = $program->partner_id;
    $prStatusRejected->program_id = $programId;
    $prStatusRejected->comment = trim($comment);
    $prStatusRejected->insert();

    // Отправляем письмо партнеру с причиной отклонения.
    MailHelpers::sendEmailToPartnerProgramRejectModeration($p_user, $program, $comment);
}

echo json_encode(['post' => $_POST, 'error' => $error]);
