<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
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
$tourId = $_POST['tour_id'];

/** @var Tour $tour */
$tour = (new Tour())->getOne($tourId);

// Если тур принадлежит партнеру, то удаляем его.
if ($tour->partner_id == $partnerId) {
    // Удаляем тур.
    $tour->delete();
} else {
    $error = 'Вы не имеете прав для удаления тура.';
}

echo json_encode(['post' => $_POST, 'error' => $error]);
