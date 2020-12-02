<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\tour\Tour;
use app\services\Auth;
use app\services\Db;
use app\Models\program\Program;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем Id редактируемой программы.
$tourId = $_POST['tour_id'];
$finishReason = $_POST['finish_reason'];

/** @var Tour $tour */
$tour = (new Tour())->getOne($tourId);
/** @var Program $program */
$program = (new Program())->getOne($tour->program_id);

// Если тур принадлежит партнеру, то меняем статус.
if ($tour->partner_id == $partnerId) {
    // Меняем статус тура и сохраняем его.
    $tour->t_status_admin_id = $finishReason;
    $tour->save();

    // Выполняем логирование снятого с публикации тура.
    $tour->publishFinishLog();

    // Проверяем есть ли опубликованные туры или нет.
    if (Tour::isPublished($tour->program_id)) {
        $program->status = Program::STATUS_PUBLISHED;
    } else {
        $program->status = Program::STATUS_UNPUBLISHED;
    }
    $program->save();
} else {
    $error = 'Вы не имеете прав для снятия тура с публикации.';
}

echo json_encode(['post' => $_POST, 'error' => $error]);
