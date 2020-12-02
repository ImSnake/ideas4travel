<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\Models\User;
use app\Models\tour\Tour;
use app\helpers\TourValidate;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var User $user */
$user = $auth->getUser();
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем Id редактируемой программы.
$programId = (int)$_POST['program_id'];

if (empty($programId) || !is_int($programId)) {
    $error = 'Передан некорректный id программы.';
}

// Проверяем принадлежит ли программа партнеру.
if ($user->role != User::ROLE_MODERATOR) {
    $error = 'Вы не имеете прав для публикации тура.';
}

if (is_null($error)) {
    /** @var Program $program */
    $program = (new Program())->getOne($programId);
    $status = $program->status;
    // Проверяем находится ли программа на модерации.
    if ($program->status == Program::STATUS_IN_MODERATION) {
        // Меняем статус программы.
        $program->status = Program::STATUS_PUBLISHED;
        $program->status_at = date('Y-m-d H:i:s', time());

        // Получаем все туры со статусом in_moderation для текущей программы.
        $tours = (new Tour())->getAllWhere([
            'program_id' => $programId,
            't_status_admin_id' => Tour::STATUS_IN_MODERATION
        ]);

        // Обходим все туры для этой программы в статусе на модерации
        if ($tours) {
            $tourArr = [];
            foreach ($tours as $item) {
                // Получаем тур.
                $tour = (new Tour())->getOne($item['id']);

                // Если даты старта на текущий день корректна, то переводим тур в опубликованные, иначе в завершенные.
                if ($tour->checkExpiredStartAt()) {
                    // Выполняем валидацию тура.
                    $tourValidate = new TourValidate($tour);
                    // Выполняем валидацию тура.
                    $tourIsValidate = $tourValidate->isValidate();
                    // Если тур прошел валидацию, то меняем статус тура.
                    if ($tourIsValidate === true) {
                        $tour->t_status_admin_id = Tour::STATUS_PUBLISHED;

                        // Выполняем логирование опубликованного тура.
                        $tour->publishStartLog();
                    } else {
                        $tour->t_status_admin_id = Tour::STATUS_UNPUBLISHED;
                    }
                } else {
                    $tour->t_status_admin_id = Tour::STATUS_TIME_UP;
                }

                $tour->save();
            }
        }

        // Проверяем есть ли опубликованные туры или нет.
        if (Tour::isPublished($program->id)) {
            $program->status = Program::STATUS_PUBLISHED;
        } else {
            $program->status = Program::STATUS_UNPUBLISHED;
        }

        $program->save();
    } else {
        $error = 'Программа не находится на модерации';
    }
}

echo json_encode(['post' => $_POST, 'status' => $status, 'error' => $error]);
