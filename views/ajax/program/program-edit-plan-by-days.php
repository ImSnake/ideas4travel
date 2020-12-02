<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\Partner;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\services\Geo;
use app\Models\program\PrDay;
use app\Models\program\PrGeo;
use app\helpers\HtmlHelpers;
use app\Models\program\PrDayMeal;
use app\Models\program\PrDayTransfer;
use app\Models\program\PrDayPoint;
use app\Models\program\PrDayActivity;
use app\Models\program\PrImg;

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

// Получаем массив дней.
$arrDays = $_POST['d'];

// Переменная для хранения данных по первому дню.
$valFirstDay = null;

// УДАЛЕНИЕ =============================================================================
// Количетво дней сохраненных в базе.
$countDaysInProgram = Program::getCountDays($programId);
$countDaysInProgram = (int)$countDaysInProgram['count'];
// Количество дней полученных из POST.
$countDaysInPost = count($arrDays);
// Если кол-во полученных дней меньше, чем сохранено в базе, то лишние дни удаляем.
if ($countDaysInPost < $countDaysInProgram) {
    // Обходим удаленные дни и удаляем их из базы.
    for ($i = $countDaysInProgram; $i > $countDaysInPost; $i--) {
        // Получаем день который нужно удалить.
        $dayDelete = (new PrDay())->getOne(['program_id' => $programId, 'day' => $i]);
        // Удаляем данные локации для этого дня.
        (new PrGeo())->deleteWhere(['id' => $dayDelete->geo_id]);
        // Удаляем день.
        $dayDelete->deleteWhere(['id' => $dayDelete->id]);
    }
}

// Удаляем предыдущие данные о трансфере из базы для данной программы.
(new PrDayTransfer())->deleteWhere(['program_id' => $programId]);
// Удаляем предыдущие данные о питании из базы для данной программы.
(new PrDayMeal())->deleteWhere(['program_id' => $programId]);
// Удаляем предыдущие данные о локации из базы для данной программы.
(new PrDayPoint())->deleteWhere(['program_id' => $programId]);
// Удаляем предыдущие данные об активности из базы для данной программы.
(new PrDayActivity())->deleteWhere(['program_id' => $programId]);

// ОБРАБОТКА ДАННЫХ ПОЛУЧЕННЫХ ДНЕЙ =====================================================
// Обходим массив дней в цикле и заносим данные в базу.
for ($i = 1; $i <= count($arrDays); $i++) {
    // Получаем данные по дню, прдевательно преобразуем ключ к формату 01, 03, 12 и т.д.
    $val = $arrDays[HtmlHelpers::doubleNumber($i)];

    // Если первый день, то запоминаем его значение в заданную переменную.
    if ($i == 1) {
        $valFirstDay = $val;
    }

    /** @var PrDay $day */
    $day_id = (new PrDay())->getOne(['program_id' => $programId, 'day' => $i])->id;
    if ($day_id) {
        $day = (new PrDay())->getOne($day_id);
    } else {
        $day = new PrDay();
        $day->program_id = $programId;
        $day->day = $i;
        $day->save();
        $day_id = $day->getPrimaryKey();
        $day = (new PrDay())->getOne($day_id);
    }

    // Создаем объект ночевки.
    if ($day->geo_id) {
        $prGeo = (new PrGeo())->getOne($day->geo_id);
    } else {
        $prGeo = new PrGeo();
    }

    // Проверяем чекбокс на ночевке.
    if (isset($valFirstDay['day_place_checkbox'])) {
        $day->day_place_checkbox = 1;
    } else {
        $day->day_place_checkbox = 0;
    }

    // Проверяем чекбокс на размещении.
    if (isset($valFirstDay['accommodation_checkbox'])) {
        $day->accommodation_checkbox = 1;
    } else {
        $day->accommodation_checkbox = 0;
    }

    // Проверяем чекбокс на питании.
    if (isset($valFirstDay['meal_checkbox'])) {
        $day->meal_checkbox = 1;
    } else {
        $day->meal_checkbox = 0;
    }

    // Проверяем чекбокс на трансфер.
    if (isset($valFirstDay['transfer_checkbox'])) {
        $day->transfer_checkbox = 1;
    } else {
        $day->transfer_checkbox = 0;
    }

    // Если на первном дне поставлен лукер, то для данного дня используем данные из первого дня.
    if (isset($valFirstDay['day_place_checkbox']) && $i != 1) {
        $val['city_id'] = $valFirstDay['city_id'];
        $val['area_id'] = $valFirstDay['area_id'];
        $val['country_id'] = $valFirstDay['country_id'];
    }

    // Присваиваем данные объекту ночевки.
    $prGeo->program_id = $programId;
    $prGeo->city_id = !empty($val['city_id']) && isset($val['country_id']) ? $val['city_id'] : null;
    $prGeo->area_id = !empty($val['area_id']) && isset($val['country_id']) ? $val['area_id'] : null;
    $prGeo->country_id = !empty($val['country_id']) ? $val['country_id'] : null;
    // Клонируем город и регион.
    $geo->cloneCity($prGeo->city_id);
    // Сохраняем данные.
    $prGeo->save();
    // Получаем id ночевки и присваиваем объекту PrDay.
    $day->geo_id = $prGeo->getPrimaryKey();

    // Если на первном дне поставлен лукер, то для данного дня используем данные из первого дня.
    if (isset($valFirstDay['accommodation_checkbox'])) {
        $day->accommodation_id = $valFirstDay['accommodation'];
        $day->accommodation_room_id = $valFirstDay['accommodation_room'];
    } else {
        $day->accommodation_id = $val['accommodation'];
        $day->accommodation_room_id = $val['accommodation_room'];
    }

    if (isset($valFirstDay['meal_checkbox'])) {
        $valMeal = $valFirstDay;
    } else {
        $valMeal = $val;
    }

    // Созаем объект типов туров.
    $prDayMeal = new PrDayMeal();

    // Если переданы данные по типу тура
    if (!empty($valMeal['meal'])) {
        // Обходим массив в цикле и добавляем новые значения в базу.
        foreach ($valMeal['meal'] as $value) {
            $prDayMeal->day_id = $day_id;
            $prDayMeal->program_id = $programId;
            $prDayMeal->day_meal_id = $value;
            $prDayMeal->insert();
        }
    }

    if (isset($valFirstDay['transfer_checkbox'])) {
        $valTransfer = $valFirstDay;
    } else {
        $valTransfer = $val;
    }

    // Созаем объект типов туров.
    $prDayTransfer = new PrDayTransfer();

    // Если переданы данные по типу тура
    if (!empty($valTransfer['transfer'])) {
        // Обходим массив в цикле и добавляем новые значения в базу.
        foreach ($valTransfer['transfer'] as $value) {
            $prDayTransfer->day_id = $day_id;
            $prDayTransfer->program_id = $programId;
            $prDayTransfer->day_transfer_id = $value;
            $prDayTransfer->insert();
        }
    }

    $day->distance = $valTransfer['transfer_distance'] ? $valTransfer['transfer_distance'] : null;

    // ЛОКАЦИЯ --------------------------------------------------
    // Созаем объект.
    $prDayPoint = new PrDayPoint();

    // Обходим массив в цикле и добавляем новые значения в базу.
    foreach ($val['point'] as $value) {
        if (!empty($value)) {
            $prDayPoint->day_id = $day_id;
            $prDayPoint->program_id = $programId;
            $prDayPoint->name = $value;
            $prDayPoint->insert();
        }
    }

    // АКТИВНОСТЬ --------------------------------------------------
    // Созаем объект.
    $prDayActivity = new PrDayActivity();

    // Обходим массив в цикле и добавляем новые значения в базу.
    foreach ($val['activity'] as $value) {
        if (!empty($value)) {
            $prDayActivity->day_id = $day_id;
            $prDayActivity->program_id = $programId;
            $prDayActivity->name = $value;
            $prDayActivity->insert();
        }
    }

    // ПРОГРАММА ДНЯ
    $day->description = $val['description'];

    // КАРТИНКА ДНЯ
    /** @var PrImg $img */
    $img = (new PrImg())->getOne(['img' => $val['img']]);
    $day->img_id = $img->id;

    // Сохраняем модель PrDay.
    $day->save();
}

// Обновляем дату изменения программы.
/** @var Program $program */
$program = (new Program())->getOne($programId);
$program->update_at = date('Y-m-d H:i:s', time());
$program->update();

echo json_encode([
    'post' => [$arrDays, $dayDelete]
]);
