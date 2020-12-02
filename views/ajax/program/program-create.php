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

$name = $_POST['name'];

if (!empty($name)) {
    // Уибараем лишние пробелы в начале и в конце.
    $name = trim($name);
    // Ограничиваем длину строки.
    $name = trim(mb_strimwidth($name, 0, 100));
    // Проверяем название на уникальность в рамках одного партнера.
    $sql_unique = "SELECT id FROM " . Program::tableName() . " WHERE partner_id = :partner_id and LOWER(name) = LOWER(:name)";

    if ($db->queryOne($sql_unique, [':name' => $name, ':partner_id' => $partnerId])) {
        $error = 'Программа с таким названием уже существует';
    } else {
        $sql = "INSERT INTO " . Program::tableName() . " (name, partner_id, create_at, update_at, validate_at, status_at) 
        VALUES (:name, :partner_id, :create_at, :update_at, :validate_at, :status_at)";
        $db->execute($sql, [
            ':name' => $name,
            ':partner_id' => $partnerId,
            ':create_at' => date('Y-m-d H:i:s', time()),
            ':update_at' => date('Y-m-d H:i:s', time()),
            ':validate_at' => date('Y-m-d H:i:s', time()),
            ':status_at' => date('Y-m-d H:i:s', time()),
        ]);
        $last_id = $db->lastInsertId();
    }
} else {
    $error = 'Название программы не может быть пустым';
}

if (is_null($error)) {
    // Создаем директории изображений для вновь созданной программы в рамках партнера.
    Program::createDirForImgPrograms($partnerId, $last_id);
}

echo json_encode(['id' => $last_id, 'error' => $error]);
