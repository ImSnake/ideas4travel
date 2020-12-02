<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\program\Program;
use app\Models\program\PrVideos;
use app\services\Auth;
use app\services\Db;
use app\services\Geo;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var Partner $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var Geo $geo */
$geo = App::get()->geo;

// Получаем Id редактируемой программы.
$programId = $_POST['program_id'];

// Получаем выбранные значения фильтров.
$videos = $_POST['gallery']['video'];
// Получаем массив из названий (айдишников) переданных видео.
$arrPostVideo = [];
foreach ($videos as $item) {
    $arrPostVideo[] = $item['video'];
}
sort($arrPostVideo);

$sourceVideos = (new PrVideos())->getAllWhere(['program_id' => $programId]);
// Получаем массив из названий (айдишников) переданных видео.
$arrDBVideo = [];
foreach ($sourceVideos as $item) {
    $arrDBVideo[] = $item['video'];
}
sort($arrDBVideo);

if ($arrPostVideo != $arrDBVideo) {
    // Удаляем старые значения фильтров из программы.
    (new PrVideos())->deleteWhere(['program_id' => $programId]);

    // Заносим выбранные значения фильтров в базу данных
    if (isset($videos)) {
        foreach ($videos as $video) {
            if (!empty($video['video']) && !empty($video['url'])) {
                $video['video'] = trim($video['video']);
                $video['url'] = trim($video['url']);
                $prVideo = new PrVideos();
                $prVideo->video = $video['video'];
                $prVideo->program_id = $programId;
                $prVideo->partner_id = $partnerId;
                $prVideo->url = $video['url'];
                $prVideo->insert();
            }
        }
    }

    // Обновляем дату изменения программы.
    /** @var Program $program */
    $program = (new Program())->getOne($programId);
    $program->update_at = date('Y-m-d H:i:s', time());
    $program->update();
}

echo json_encode([
    'post' => $_POST,
]);
