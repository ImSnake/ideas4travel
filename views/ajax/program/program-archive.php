<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\Models\tour\Tour;
use app\services\Auth;
use app\services\Db;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем Id редактируемой программы.
$programId = $_POST['program_id'];

/** @var Program $program */
$program = (new Program())->getOne($programId);

// Проверяем принадлежит ли программа партнеру.
if ($program->partner_id != $partnerId) {
    $error = 'Вы не имеете прав отправлять программу в архив.';
}

if (is_null($error)) {
    // Проверяем находится ли программа в статусе, при котором ее можно заархивировать.
    if (in_array($program->status, [Program::STATUS_REJECTED]) && Tour::isUnpublished($program->id) ||
        in_array($program->status, [Program::STATUS_UNPUBLISHED])
    ) {
        // Меняем статус программы на архивный.
        $program->status = Program::STATUS_ARCHIVED;
        $program->status_at = date('Y-m-d H:i:s', time());
        $program->save();

        // Все туры программы в статусе DRAFT (черновик) удаляем.
        (new Tour())->deleteWhere(['program_id' => $programId, 't_status_admin_id' => Tour::STATUS_DRAFT]);
    } else {
        $error = 'Данную программу нельзя архивировать';
    }
}

echo json_encode(['post' => $_POST, 'error' => $error]);
