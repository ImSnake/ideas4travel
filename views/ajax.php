<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\services\Auth;
use app\services\UploadHandler;
use app\services\Db;
use app\Models\Partner;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var Partner $partner */
$partner = $auth->getPartner();

$options = array(
    'upload_dir' => '/avatars/original/',
    'upload_url' => 'https://' . $_SERVER['SERVER_NAME'] . '/images/avatars/original/',
    'ajax' => true,
    'max_width' => 1080,
    'max_height' => 1080,
    'min_width' => 200,
    'min_height' => 200,
    'change' => 'max',
    'image_versions' => array(
        'big' => array(
            'upload_dir' => '/avatars/big/',
            'upload_url' => 'https://' . $_SERVER['SERVER_NAME'] . '/images/avatars/big/',
            'max_width' => 200,
            'max_height' => 200,
            'jpeg_quality' => 85,
            'change' => 'square'
        ),
        'middle' => array(
            'upload_dir' => '/avatars/middle/',
            'upload_url' => 'https://' . $_SERVER['SERVER_NAME'] . '/images/avatars/middle/',
            'max_width' => 100,
            'max_height' => 100,
            'jpeg_quality' => 95,
            'change' => 'square'
        ),
        'mini' => array(
            'upload_dir' => '/avatars/mini/',
            'upload_url' => 'https://' . $_SERVER['SERVER_NAME'] . '/images/avatars/mini/',
            'max_width' => 35,
            'max_height' => 35,
            'jpeg_quality' => 95,
            'change' => 'square'
        )
    )
);

$upload_anons_pic = new UploadHandler(IMG_DIR, $options);
$arr_upload_anons_pic = $upload_anons_pic->send_response();

if ($arr_upload_anons_pic[0]['error'] == null) {
    // Если есть файлы в заданных папках, то удаляем их.
    if (is_file(IMG_DIR . 'avatars/original/' . $partner->avatar) && $partner->avatar != 'avatar.png') {
        unlink(IMG_DIR . 'avatars/original/' . $partner->avatar);
    }
    if (is_file(IMG_DIR . 'avatars/big/' . $partner->avatar) && $partner->avatar != 'avatar.png') {
        unlink(IMG_DIR . 'avatars/big/' . $partner->avatar);
    }
    if (is_file(IMG_DIR . 'avatars/middle/' . $partner->avatar) && $partner->avatar != 'avatar.png') {
        unlink(IMG_DIR . 'avatars/middle/' . $partner->avatar);
    }
    if (is_file(IMG_DIR . 'avatars/mini/' . $partner->avatar) && $partner->avatar != 'avatar.png') {
        unlink(IMG_DIR . 'avatars/mini/' . $partner->avatar);
    }

    // Добавляем изображение в базу данных.
    $partner->avatar = $arr_upload_anons_pic[0]['name'];
    $partner->updated_at = date('Y-m-d H:i:s', time());
    $partner->update();
}

$upload_anons_pic->generate_response($upload_anons_pic->send_response());
