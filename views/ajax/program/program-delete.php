<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\Models\tour\Tour;

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

// Проверяем находится ли программа в статусе, при котором ее можно удалить.
if (in_array($program->status, [Program::STATUS_DRAFT, Program::STATUS_COMPLETED,]) ||
    in_array($program->status, [Program::STATUS_REJECTED]) && !Tour::isUnpublished($program->id)
) {
    // Удаляем программу.
    $program->delete();

    // Получаем путь к изображениям данной программы в рамках партнера.
    $imgDirProgram = IMG_DIR . "/tours/" . $partnerId . "/" . $programId;

    // Функция позволяет рекурсивно удалить директорию если она не пустая.
    function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    // Если директория с изображениями существует, то удаляем ее.
    if (is_dir($imgDirProgram)) {
        delTree($imgDirProgram);
    }
} else {
    $error = 'Данную программу нельзя удалить';
}

echo json_encode(['post' => $_POST, 'imgDirProgram' => $imgDirProgram, 'error' => $error]);
