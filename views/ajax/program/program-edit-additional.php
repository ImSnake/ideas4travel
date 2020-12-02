<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\program\PrFilter;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\services\Geo;
use app\services\Request;

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

/** @var Program $program */
$program = (new Program())->getOne($programId);

$program->conditions = Request::getPostForm($_POST['additional']['conditions'], $program->conditions, null);
$program->features_region = Request::getPostForm($_POST['additional']['features_region'], $program->features_region,
    null);
$program->what_take = Request::getPostForm($_POST['additional']['what_take'], $program->what_take, null);
$program->health = Request::getPostForm($_POST['additional']['health'], $program->health);
$program->additional = Request::getPostForm($_POST['additional']['additional'], $program->additional);

$program->save();

// Получаем выбранные значения фильтров.
$filters = $_POST['additional']['filter_id'];

// Удаляем старые значения фильтров из программы.
(new PrFilter())->deleteWhere(['program_id' => $programId]);

if (!empty($filters)) {
    // Заносим выбранные значения фильтров в базу данных
    foreach ($filters as $filter) {
        $prFilter = new PrFilter();
        $prFilter->program_id = $programId;
        $prFilter->partner_id = $partnerId;
        $prFilter->filter_id = $filter;
        $prFilter->insert();
    }
}

echo json_encode([
    'post' => $_POST
]);
