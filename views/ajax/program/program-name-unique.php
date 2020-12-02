<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
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

$programId = $_POST['program_id'];
$name = $_POST['name'];

if (!empty($name)) {
    // Уибараем лишние пробелы в начале и в конце.
    $name = trim($name);
    // Ограничиваем длину строки.
    $name = trim(mb_strimwidth($name, 0, 100));
    // Проверяем название на уникальность в рамках одного партнера.
    $sql_unique = "SELECT id FROM " . Program::tableName() . " WHERE partner_id = :partner_id and LOWER(name) = LOWER(:name) and id != :id";

    if ($db->queryOne($sql_unique, [':name' => $name, ':partner_id' => $partnerId, ':id' => $programId])) {
        $error = 'Программа с таким названием уже существует';
    }

} else {
    $error = 'Название программы не может быть пустым';
}

echo json_encode(['error' => $error]);
