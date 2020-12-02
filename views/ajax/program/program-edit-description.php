<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\program\PrCountry;
use app\Models\program\PrGeo;
use app\Models\program\Program;
use app\Models\program\PrTargetAudience;
use app\Models\program\PrTourType;
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

// Получаем название программы
$programName = trim($_POST['description']['program_name']);
// Ограничиваем длину строки.
$programName = trim(mb_strimwidth($programName, 0, 100));
$program->group_min = Request::getPostForm($_POST['description']['group_min'], $program->group_min, null);
$program->group_max = Request::getPostForm($_POST['description']['group_max'], $program->group_max, null);
$program->age_min = Request::getPostForm($_POST['description']['age_min'], $program->age_min, null);
$program->age_max = Request::getPostForm($_POST['description']['age_max'], $program->age_max, null);
$program->duration = Request::getPostForm($_POST['description']['duration'], $program->duration, null);
$program->about = Request::getPostForm($_POST['description']['about'], $program->about);

// Если название программы не пустое, то проверяем его на уникальность, и если оно уникально, то присваиваем его.
if (!empty($programName)) {
    // Проверяем название на уникальность в рамках одного партнера.
    $sql_unique = "SELECT id FROM " . Program::tableName() . " WHERE partner_id = :partner_id and name = :name";

    if (!$db->queryOne($sql_unique, [':name' => $programName, ':partner_id' => $partnerId])) {
        $program->name = $programName;
    }
}

// Создаем объект места старта.
if ($program->start) {
    $prGeoStart = (new PrGeo())->getOne($program->start);
} else {
    $prGeoStart = new PrGeo();
    $prGeoStart->program_id = $programId;
    $prGeoStart->insert();
    $prGeoStart = (new PrGeo())->getOne($db->lastInsertId());

}
// Получаем данные по старту.
$prGeoStart->program_id = $programId;
$prGeoStart->city_id = !empty($_POST['description']['start_city_id']) ? $_POST['description']['start_city_id'] : null;
$prGeoStart->area_id = !empty($_POST['description']['start_area_id']) ? $_POST['description']['start_area_id'] : null;
$prGeoStart->country_id = !empty($_POST['description']['start_country_id']) ? $_POST['description']['start_country_id'] : null;
// Клонируем город и регион.
$geo->cloneCity($prGeoStart->city_id);
// Сохраняем данные.
$prGeoStart->save();
// Получаем id старта и присваиваем объекту Program.
$program->start = $prGeoStart->getPrimaryKey();

// Создаем объект места финиша
if ($program->finish) {
    $prGeoFinish = (new PrGeo())->getOne($program->finish);
} else {
    $prGeoFinish = new PrGeo();
    $prGeoFinish->program_id = $programId;
    $prGeoFinish->insert();
    $prGeoFinish = (new PrGeo())->getOne($db->lastInsertId());
}
// Получаем данные по финишу.
$prGeoFinish->program_id = $programId;
if (!isset($_POST['description']['finish_checkbox'])) {
    $program->finish_checkbox = 0;
    $prGeoFinish->city_id = $_POST['description']['start_city_id'];
    $prGeoFinish->area_id = $_POST['description']['start_area_id'];
    $prGeoFinish->country_id = $_POST['description']['start_country_id'];
} else {
    $program->finish_checkbox = 1;
    // Если город не выбран, то обнуляем id города и региона. В будущем это можно сделать сразу через js.
    if (empty($_POST['description']['finish_city_name'])) {
        $prGeoFinish->city_id = null;
        $prGeoFinish->area_id = null;
    } else {
        $prGeoFinish->city_id = !empty($_POST['description']['finish_city_id']) ? $_POST['description']['finish_city_id'] : null;
        $prGeoFinish->area_id = !empty($_POST['description']['finish_area_id']) ? $_POST['description']['finish_area_id'] : null;
    }
    $prGeoFinish->country_id = !empty($_POST['description']['finish_country_id']) ? $_POST['description']['finish_country_id'] : null;
    // Клонируем город и регион.
    $geo->cloneCity($prGeoFinish->city_id);
}

// Сохраняем данные.
$prGeoFinish->save();
// Получаем id финиша и присваиваем объекту Program.
$program->finish = $prGeoFinish->getPrimaryKey();

// Получаем список стран.
$stringMultitour = trim($_POST['description']['multitour']);

// Если список стран не пустой, то удаляем старые значения и добавляем новые.
if (!empty($stringMultitour)) {
    // Разбиваем строку и получаем массив.
    $arrMultitour = explode(',', $stringMultitour);
    // Убирает повторяющиеся значения из массива.
    $arrMultitour = array_unique($arrMultitour);

    // Получаем массив сохраненных в базе стран для текущей программы.
    $resultCountriesDB = (new PrCountry())->getAllWhere(['program_id' => $programId]);
    // Создаем массив из полученных значений.
    $arrCountryDB = [];
    foreach ($resultCountriesDB as $value) {
        $arrCountryDB[] = $value['country_id'];
    }
    // Получаем рассхождения массивов стран в базе и полученных из формы.
    $diffArrCountry = array_diff($arrCountryDB, $arrMultitour);
    // Если есть рассхождения то из таблицы pr_geo для текущей программы обнуляем локации для полученных расхождений.
    if (!empty($diffArrCountry)) {
        $diffArrCountry = array_map(function ($item){
            return "'{$item}'";
        }, $diffArrCountry);
        $stringDiffArrCountry = implode(',', $diffArrCountry);
        $sql = "UPDATE " . PrGeo::tableName() . " SET country_id = null, area_id = null, city_id = null WHERE program_id = :program_id and country_id IN (" . $stringDiffArrCountry . ")";
        $db->execute($sql, [':program_id' => $programId]);
    }

    // Создаем объект стран прогаммы.
    $prCountry = new PrCountry();
    // Удаляем предыдущие данные из базы для данной программы.
    $prCountry->deleteWhere(['program_id' => $programId]);
    // Обходим массив в цикле и добавляем новые значения в базу.
    foreach ($arrMultitour as $value) {
        $prCountry->program_id = $programId;
        $prCountry->country_id = $value;
        $prCountry->insert();
    }

    // Если стран в программен больше 1, то это мультитур, иначе - нет.
    if (count($arrMultitour) > 1) {
        $program->multitur = 1;
    } else {
        $program->multitur = 0;
    }
}

// Получаем данные по питанию, динамике тура и уровню комфорта.
$program->meal_id = Request::getPostForm($_POST['meal'][0], $program->meal_id, null);
$program->dynamic_id = Request::getPostForm($_POST['dynamic'][0], $program->dynamic_id, null);
$program->comfort_id = Request::getPostForm($_POST['comfort'][0], $program->comfort_id, null);

// Обновляем дату изменения программы.
$program->update_at = date('Y-m-d H:i:s', time());

// Сохраняем модель Program.
$program->update();

// Получаем список типов туров.
$arrTourType = $_POST['tour_type'];

// Созаем объект типов туров.
$prTourType = new PrTourType();
// Удаляем предыдущие данные из базы для данной программы.
$prTourType->deleteWhere(['program_id' => $programId]);

// Если переданы данные по типу тура
if (!empty($arrTourType)) {
    // Обходим массив в цикле и добавляем новые значения в базу.
    foreach ($arrTourType as $value) {
        $prTourType->program_id = $programId;
        $prTourType->type_tour_id = $value;
        $prTourType->insert();
    }
}

// Получаем список целевой аудитории.
$arrTargetAudience = $_POST['target_audience'];

// Созаем объект целевой аудитории.
$prTargetAudience = new PrTargetAudience();
// Удаляем предыдущие данные из базы для данной программы.
$prTargetAudience->deleteWhere(['program_id' => $programId]);

// Если переданы данные по целевая аудитория
if (!empty($arrTargetAudience)) {
    // Обходим массив в цикле и добавляем новые значения в базу.
    foreach ($arrTargetAudience as $value) {
        $prTargetAudience->program_id = $programId;
        $prTargetAudience->target_audience_id = $value;
        $prTargetAudience->insert();
    }
}

echo json_encode([
    'post' => [$_POST, $program->age_min, $_POST['description']['age_min']]
]);
