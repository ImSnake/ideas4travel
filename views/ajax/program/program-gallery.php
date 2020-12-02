<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\PrImg;
use app\services\Auth;
use app\services\Db;
use app\Models\program\Program;
use app\Models\Partner;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

/** @var int $programId Получаем Id программы */
$partnerId = $_POST['partner_id'];
$programId = $_POST['program_id'];

// Получаем все фотографии галереи для текущей программы.
$allImg = (new PrImg())->getAllWhere([
    'partner_id' => $partnerId,
    'program_id' => $programId,
    'deleted' => 0
]);

$arrImg = [];
foreach ($allImg as $key => $value) {
    $arrImg[$key]['name'] = $value['img'];
    $arrImg[$key]['alt'] = "gallery-image";
    if ($value['type'] == '0') {
        $arrImg[$key]['type'] = 'gallery';
    } else {
        $arrImg[$key]['type'] = $value['type'];
    }

    $arrImg[$key]['day'] = null;
}

$a = [
    [
        "name" => "t000001_01.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_02.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_03.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_04.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_05.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_06.jpg",
        "alt" => "gallery-image",
        "type" => "gallery",
        "day" => null
    ],
    [
        "name" => "t000001_map.jpg",
        "alt" => "map-image",
        "type" => "map",
        "day" => null
    ],
    [
        "name" => "t000001_main.jpg",
        "alt" => "main-image",
        "type" => "main",
        "day" => null
    ]
];

echo json_encode($arrImg);