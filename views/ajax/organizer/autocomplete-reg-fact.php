<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\services\Auth;
use app\services\Db;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var Db $db_geo */
$db_geo = App::get()->db_geo;

$data = [];

$name = $_POST['name'];
$country = $_POST['country'];

if (!empty($name) && !empty($country)) {
    $name = strtolower(trim($name));
//    $sql = "SELECT name, english, id, area, vid FROM pb_city WHERE country = :country AND (LOWER(name) LIKE :name OR LOWER(english) LIKE :name) LIMIT 5";
//    $sql = "SELECT c.name c_name, c.id c_id, a.name a_name, a.id a_id, co.name co_name, co.id co_id FROM pb_city c LEFT JOIN pb_area a ON c.area = a.id LEFT JOIN pb_country co ON c.country = co.id WHERE c.country = :country AND (LOWER(c.name) LIKE :name OR LOWER(c.english) LIKE :name) LIMIT 5";
//    $sql = "SELECT c.name c_name, c.id c_id, c.area c_area, a.name a_name FROM pb_city c LEFT JOIN pb_area a ON c.area = a.id WHERE c.country = :country AND (LOWER(c.name) LIKE :name OR LOWER(c.english) LIKE :name) ORDER BY c.name LIMIT 15";
//    $sql = "SELECT c.name c_name, c.id c_id, c.area c_area, a.name a_name FROM pb_city c LEFT JOIN pb_area a ON c.area = a.id WHERE c.country = :country AND (LOWER(c.name) LIKE :name) ORDER BY c.name LIMIT 15";
    $sql = "SELECT c.name c_name, c.id c_id, c.area c_area, a.name a_name FROM pb_city c LEFT JOIN pb_area a ON c.area = a.id WHERE c.country = :country AND (LOWER(c.name) LIKE :name) ORDER BY c.name LIMIT 25";
    $result = $db_geo->queryAll($sql, [':name' => $name . '%', ':country' => $country]);

    foreach ($result as $item) {
        // Если регион равен 0, то не добавляем его в полное название.
        if ($item['c_area'] == 0) {
            $fullName = $item['c_name'];
        } else {
            $fullName = $item['c_name'] . ' (' . $item['a_name'] . ')';
        }
        array_push($data, [$fullName, $item['c_id'], $item['c_area']]);
    }
}

echo json_encode($data);