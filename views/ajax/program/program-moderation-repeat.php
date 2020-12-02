<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\helpers\MailHelpers;
use app\helpers\ProgramValidate;
use app\Models\program\Program;
use app\services\Auth;
use app\Models\User;
use app\Models\tour\Tour;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем Id редактируемой программы.
$programId = (int)$_POST['program_id'];

if (empty($programId) || !is_int($programId)) {
    $error = 'Передан некорректный id программы.';
}

/** @var Program $program */
$program = (new Program())->getOne($programId);

// Проверяем принадлежит ли программа партнеру.
if ($program->partner_id != $partnerId) {
    $error = 'Вы не имеете прав отправлять программу на модерацию.';
}

if (is_null($error)) {
    // Выполняем проверку программы.
    $programValidate = new ProgramValidate($program);

    // Проверяем прошла ли программа валидацию.
    if ($programValidate->isValidate()) {
        // Меняем статус программы.
        $program->status = Program::STATUS_IN_MODERATION;
        $program->status_at = date('Y-m-d H:i:s', time());
        $program->save();
        // Модератору отправляется письмо со ссылкой на программу.
        MailHelpers::sendEmailProgramInModeration(EMAIL_MODERATOR, $program);
    } else {
        $error = 'Программа не прошла валидацию. Проверьте правильность заполнения полей:<br><br>';
        foreach ($programValidate->getErrors() as $e) {
            $error .= $e . "<br><br>";
        }
    }
}

echo json_encode(['post' => $_POST, 'error' => $error]);
