<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\program\PrImg;
use app\services\Auth;
use app\services\Db;
use app\Models\program\Program;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var Partner $partner */
$partner = $auth->getPartner();

$partner_id = $partner->id;
$fileName = $_POST['name'];

/** @var PrImg $mainImg */
$prImg = (new PrImg())->getOne(['img' => $fileName]);

if ($prImg) {
    $upload_dir = '/tours/' . $prImg->partner_id . '/' . $prImg->program_id . '/';

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

    // формируем массив с данными для отправки.
    $jsonArr = [
        'program_id' => $prImg->program_id,
        'partner_id' => $prImg->partner_id,
        'type' => $prImg->type
    ];

    // Удаляем изображение из базы данных.
    $prImg->deleteWhere(['img' => $prImg->img]);

    // Обновляем дату изменения программы.
    /** @var Program $program */
    $program = (new Program())->getOne($prImg->program_id);
    $program->update_at = date('Y-m-d H:i:s', time());
    $program->update();
}

echo json_encode($jsonArr);
