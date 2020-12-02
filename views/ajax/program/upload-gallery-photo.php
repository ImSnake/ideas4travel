<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\PrImg;
use app\services\Auth;
use app\services\UploadHandler;
use app\services\Db;
use app\Models\Partner;
use app\Models\program\Program;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var Partner $partner */
$partner = $auth->getPartner();

// Начальное значение количества фото в архиве
$countImg = 0;

$partner_id = $partner->id;
$program_id = $_POST['program_id'];
$type = $_POST['type'];

/** @var Program $program */
$program = (new Program())->getOne($program_id);

$upload_dir = '/tours/' . $partner_id . '/' . $program_id . '/';
$upload_url = 'https://' . $_SERVER['SERVER_NAME'] . '/images/tours/' . $partner_id . '/' . $program_id . '/';

// Получаем все изображения фото-архива.
$allImg = (new PrImg())->getAllWhere([
    'partner_id' => $partner_id,
    'program_id' => $program_id,
    'type' => 0,
    'deleted' => 0
]);

// Количество загруженных фотографий в фото-архив.
$countImg = count($allImg);

// Если количество изображений меньше 28, добавляем новое изображение, иначе пропускаем.
if ($type == 0 && $countImg >= 28) {
    echo json_encode([
        'count' => $countImg,
        'error' => 'limit',
        'program_id' => $program_id,
        'partner_id' => $partner_id
    ]);

    exit;
}

$options = array(
    'upload_dir' => $upload_dir . 'user-size/',
    'upload_url' => $upload_url . 'user-size/',
    'ajax' => true,
    'max_number_of_files' => 28,
    'max_width' => 1080,
    'max_height' => 1080,
    'min_width' => 720,
    'min_height' => 444,
    'change' => 'max',
    'image_versions' => array(
        'big' => array(
            'upload_dir' => $upload_dir . 'big/',
            'upload_url' => $upload_url . 'big/',
            'max_width' => 630,
            'max_height' => 389,
            'jpeg_quality' => 85,
            'change' => 'size'
        ),
        'middle' => array(
            'upload_dir' => $upload_dir . 'middle/',
            'upload_url' => $upload_url . 'middle/',
            'max_width' => 300,
            'max_height' => 185,
            'jpeg_quality' => 95,
            'change' => 'size'
        ),
        'mini' => array(
            'upload_dir' => $upload_dir . 'mini/',
            'upload_url' => $upload_url . 'mini/',
            'max_width' => 211,
            'max_height' => 130,
            'jpeg_quality' => 95,
            'change' => 'size'
        ),
        'micro' => array(
            'upload_dir' => $upload_dir . 'micro/',
            'upload_url' => $upload_url . 'micro/',
            'max_width' => 100,
            'max_height' => 62,
            'jpeg_quality' => 95,
            'change' => 'size'
        )
    )
);

if ($type == '0') {
    $offset = 28 - $countImg;
    if ($offset < count($_FILES['files']['tmp_name'])) {
        array_splice($_FILES['files']['name'], $offset);
        array_splice($_FILES['files']['type'], $offset);
        array_splice($_FILES['files']['tmp_name'], $offset);
        array_splice($_FILES['files']['error'], $offset);
        array_splice($_FILES['files']['size'], $offset);
    }

}

$upload_anons_pic = new UploadHandler(IMG_DIR, $options);

$arr_upload_anons_pic = $upload_anons_pic->send_response();

// ЗАГЛАВНОЕ ФОТО
if ($arr_upload_anons_pic[0]['error'] == null && $type == 'main') {
    // Проверяем, есть ли у этой программы заглавное фото, если есть, то удаляем его из директорий и из базы.
    /** @var PrImg $mainImg */
    $prImg = (new PrImg())->getOne([
        'partner_id' => $partner_id,
        'program_id' => $program_id,
        'type' => 'main',
        'deleted' => 0
    ]);
    if ($prImg) {
        // Если есть файлы в заданных папках, то удаляем их.
        if (is_file(IMG_DIR . $upload_dir . 'user-size/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'user-size/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'big/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'big/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'middle/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'middle/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'mini/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'mini/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'micro/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'micro/' . $prImg->img);
        }
        // Добавляем изображение в базу данных.
        $prImg->img = $arr_upload_anons_pic[0]['name'];
        $prImg->partner_id = $partner_id;
        $prImg->program_id = $program_id;
        $prImg->type = 'main';
        $prImg->created_at = date('Y-m-d H:i:s', time());
        $prImg->deleted = 0;
        $prImg->update();
    } else {
        $prImg = new PrImg();
    }

    // Добавляем изображение в базу данных.
    $prImg->img = $arr_upload_anons_pic[0]['name'];
    $prImg->partner_id = $partner_id;
    $prImg->program_id = $program_id;
    $prImg->type = 'main';
    $prImg->created_at = date('Y-m-d H:i:s', time());
    $prImg->deleted = 0;
    $prImg->insert();

    // Обновляем дату изменения программы.
    $program->update_at = date('Y-m-d H:i:s', time());
    $program->update();
}

// ФОТО-АРХИВ
if ($type == '0') {
    // Обходим все загруженные изображения.
    foreach ($arr_upload_anons_pic as $value){
        // Проверяем на наличие ошибок.
        if ($value['error'] == null){
            // Создаем объект изображений.
            $prImg = new PrImg();
            // Добавляем изображение в базу данных.
            $prImg->img = $value['name'];
            $prImg->partner_id = $partner_id;
            $prImg->program_id = $program_id;
            $prImg->type = '0';
            $prImg->created_at = date('Y-m-d H:i:s', time());
            $prImg->deleted = 0;
            $prImg->insert();

            // Увеличиваем количество на 1
            $countImg++;
        }
    }

    // Обновляем дату изменения программы.
    $program->update_at = date('Y-m-d H:i:s', time());
    $program->update();
}

// КАРТА
if ($arr_upload_anons_pic[0]['error'] == null && $type == 'map') {
    // Проверяем, есть ли у этой программы карта, если есть, то удаляем ее из директорий и из базы.
    /** @var PrImg $mainImg */
    $prImg = (new PrImg())->getOne([
        'partner_id' => $partner_id,
        'program_id' => $program_id,
        'type' => 'map',
        'deleted' => 0
    ]);
    if ($prImg) {
        // Если есть файлы в заданных папках, то удаляем их.
        if (is_file(IMG_DIR . $upload_dir . 'user-size/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'user-size/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'big/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'big/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'middle/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'middle/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'mini/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'mini/' . $prImg->img);
        }
        if (is_file(IMG_DIR . $upload_dir . 'micro/' . $prImg->img)) {
            unlink(IMG_DIR . $upload_dir . 'micro/' . $prImg->img);
        }
        // Добавляем изображение в базу данных.
        $prImg->img = $arr_upload_anons_pic[0]['name'];
        $prImg->partner_id = $partner_id;
        $prImg->program_id = $program_id;
        $prImg->type = 'map';
        $prImg->created_at = date('Y-m-d H:i:s', time());
        $prImg->deleted = 0;
        $prImg->update();
    } else {
        $prImg = new PrImg();
    }

    // Добавляем изображение в базу данных.
    $prImg->img = $arr_upload_anons_pic[0]['name'];
    $prImg->partner_id = $partner_id;
    $prImg->program_id = $program_id;
    $prImg->type = 'map';
    $prImg->created_at = date('Y-m-d H:i:s', time());
    $prImg->deleted = 0;
    $prImg->insert();
}

echo json_encode([
    'count' => $countImg,
    'program_id' => $program_id,
    'partner_id' => $partner_id,
    'response' => $upload_anons_pic->send_response()
]);
