<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\services\Auth;
use app\services\Db;
use app\Models\program\PrImg;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем название картинки из запроса.
$imgName = $_POST['img'];
// Если в имени есть дополнительные данные (name.jpg?0.45651332), то удаляем их.
$imgName = explode('?', $imgName)[0];

if ($imgName) {
    /** @var PrImg $prImg */
    $prImg = (new PrImg())->getOne(['img' => $imgName]);

    // Если картинка принадлежит текущему партнеру, то идем дальше.
    if ($prImg->partner_id == $partnerId) {
        $upload_dir = '/tours/' . $prImg->partner_id . '/' . $prImg->program_id . '/';
        try {
            // Получаем объект исходного изображения.
            $image = new Imagick(IMG_DIR . $upload_dir . 'user-size/' . $imgName);
            // Поварачиваем исходное изображение на 90 градусов.
            $image->rotateImage('#ffffff', 90);
            // Перезаписываем перевернутое исходное изображение.
            $image->writeImage(IMG_DIR . $upload_dir . 'user-size/' . $imgName);
            // Получаем превью-изображение из исходного изображения и перезаписываем его.
            $image->cropThumbnailImage(630, 389);
            $image->writeImage(IMG_DIR . $upload_dir . 'big/' . $imgName);
            // Получаем превью-изображение из исходного изображения и перезаписываем его.
            $image->cropThumbnailImage(300, 185);
            $image->writeImage(IMG_DIR . $upload_dir . 'middle/' . $imgName);
            // Получаем превью-изображение из исходного изображения и перезаписываем его.
            $image->cropThumbnailImage(211, 130);
            $image->writeImage(IMG_DIR . $upload_dir . 'mini/' . $imgName);
            // Получаем превью-изображение из исходного изображения и перезаписываем его.
            $image->cropThumbnailImage(100, 62);
            $image->writeImage(IMG_DIR . $upload_dir . 'micro/' . $imgName);
        } catch (Exception $e) {
            // Если есть ошибки сохраняем их.
            $error = $e->getMessage();
        }
    } else {
        $error = 'У вас нет прав редактировать изображение';
    }
} else {
    $error = 'Название изображение не передано';
}

echo json_encode(['post' => $_POST, 'upload_dir' => $upload_dir, 'error' => $error]);
