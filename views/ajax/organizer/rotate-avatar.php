<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\services\Auth;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var string $avatar */
$avatar = $auth->getPartner()->avatar;
/** @var null|string $error */
$error = null;

// Если это не аватар по умолчанию, то поворачиваем его на 90 градусов и сохраняем.
if ($avatar != 'avatar.png') {
    try {
        // Получаем объект исходного изображения.
        $image = new Imagick(IMG_DIR . '/avatars/original/' . $avatar);
        // Поварачиваем исходное изображение на 90 градусов.
        $image->rotateImage('#ffffff', 90);
        // Перезаписываем перевернутое исходное изображение.
        $image->writeImage(IMG_DIR . '/avatars/original/' . $avatar);
        // Получаем превью-изображение 200 х 200 из исходного изображения и перезаписываем его.
        $image->cropThumbnailImage(200, 200);
        $image->writeImage(IMG_DIR . '/avatars/big/' . $avatar);
        // Получаем превью-изображение 100 х 100 из исходного изображения и перезаписываем его.
        $image->cropThumbnailImage(100, 100);
        $image->writeImage(IMG_DIR . '/avatars/middle/' . $avatar);
        // Получаем превью-изображение 35 х 35 из исходного изображения и перезаписываем его.
        $image->cropThumbnailImage(35, 35);
        $image->writeImage(IMG_DIR . '/avatars/mini/' . $avatar);
    } catch (Exception $e) {
        // Если есть ошибки сохраняем их.
        $error = $e->getMessage();
    }
} else {
    $error = 'Файл avatar.png имеет правильную ориентацию.';
}

echo json_encode(['error' => $error]);
