<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\tour\Tour;
use app\services\Auth;
use app\services\Db;
use app\helpers\TourValidate;
use app\helpers\TourStatus;
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

/** @var Tour $tour */
$tour = (new Tour())->getOne($tourId);
/** @var Program $program */
$program = (new Program())->getOne($tour->program_id);

// Проверяем принадлежит ли тур партнеру.
if ($tour->partner_id == $partnerId) {
    if (!in_array($tour->t_status_admin_id, [Tour::STATUS_PUBLISHED])) {
        // Выполняем валидацию тура.
        $tourValidate = new TourValidate($tour);
        // Выполняем валидацию тура.
        $tourIsValidate = $tourValidate->isValidate();
        // Если тур прошел валидацию, то меняем статусы тура и программы.
        if ($tourIsValidate === true) {
            // Получаем статус тура.
            $oldStatusTour = $tour->t_status_admin_id == Tour::STATUS_PUBLISHED;

            // Если даты старта на текущий день корректна, то переводим тур в опубликованные, иначе в завершенные.
            if ($tour->checkExpiredStartAt()) {
                if (!TourStatus::tourPublish($program, $tour, $tourIsValidate)) {
                    $error = 'Тур не опубликован.';
                }
            } else {
                if (!in_array($tour->t_status_admin_id, [Tour::STATUS_DRAFT])) {
                    $tour->t_status_admin_id = Tour::STATUS_TIME_UP;
                    $error = 'Время старта просрочено и тур переведен в статус Завершен.';
                    $tour->save();
                    // Если тур был опубликован, то проверяем нужно ли менять статус программы.
                    if ($oldStatusTour == Tour::STATUS_PUBLISHED){
                        // Проверяем есть ли опубликованные туры или нет.
                        if (Tour::isPublished($program->id)) {
                            $program->status = Program::STATUS_PUBLISHED;
                        } else {
                            $program->status = Program::STATUS_UNPUBLISHED;
                        }
                        $program->save();
                    }
                }
            }
        }
    } else {
        $error = 'Тур уже опубликован';
    }
} else {
    $error = 'Вы не имеете прав для публикации тура.';
}

echo json_encode([
    'post' => $_POST,
    'tourIsValidate' => $tourIsValidate,
    'tourGetError' => $tourValidate->getErrors(),
    'error' => $error
]);
