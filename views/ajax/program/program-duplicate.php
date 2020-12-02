<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\Models\program\PrGeo;
use app\Models\program\PrCountry;
use app\Models\program\PrFilter;
use app\Models\program\PrTourType;
use app\Models\program\PrTargetAudience;
use app\Models\program\PrDay;
use app\Models\program\PrDayActivity;
use app\Models\program\PrDayMeal;
use app\Models\program\PrDayPoint;
use app\Models\program\PrDayTransfer;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

$name = $_POST['name'];
$sourceProgramId = $_POST['program_id'];

if (!empty($name)) {
    // Уибараем лишние пробелы в начале и в конце.
    $name = trim($name);
    // Ограничиваем длину строки.
    $name = trim(mb_strimwidth($name, 0, 100));
    // Проверяем название на уникальность в рамках одного партнера.
    $sql_unique = "SELECT id FROM " . Program::tableName() . " WHERE partner_id = :partner_id and LOWER(name) = LOWER(:name)";

    if ($db->queryOne($sql_unique, [':name' => $name, ':partner_id' => $partnerId])) {
        $error = 'Программа с таким названием уже существует';
    } else {
        /** @var Program $sourceProgram */
        $sourceProgram = (new Program())->getOne($sourceProgramId);
        // Клонируем объект, меняем его статус на Черновик, обнуляем его id.
        $newProgram = clone $sourceProgram;
        $newProgram->id = null;
        $newProgram->name = $name;
        $newProgram->status = Program::STATUS_DRAFT;
        // Создаем новую программу.
        $newProgram->insert();
        // Получаем Id новой программы.
        $newProgram_id = $db->lastInsertId();
        /** @var Program $newProgram */
        $newProgram = (new Program())->getOne($newProgram_id);

        if (!is_null($newProgram->start)) {
            /** @var PrGeo $newStart */
            $newStart = clone (new PrGeo())->getOne($newProgram->start);
            $newStart->id = null;
            $newStart->program_id = $newProgram_id;
            $newStart->insert();
            $newStart_id = $db->lastInsertId();
            $newProgram->start = $newStart_id;
        }

        if (!is_null($newProgram->finish)){
            /** @var PrGeo $newFinish */
            $newFinish = clone (new PrGeo())->getOne($newProgram->finish);
            $newFinish->id = null;
            $newFinish->program_id = $newProgram_id;
            $newFinish->insert();
            $newFinish_id = $db->lastInsertId();
            $newProgram->finish = $newFinish_id;
        }

        if (!is_null($newProgram->start) && !is_null($newProgram->finish)){
            // Сохраняем новую программу.
            $newProgram->save();
        }

        // pr_country
        $sourcePrCountries = (new PrCountry())->getAllWhere(['program_id' => $sourceProgramId], 'object');
        foreach ($sourcePrCountries as $val) {
            $newPrCountry = clone $val;
            $newPrCountry->program_id = $newProgram_id;
            $newPrCountry->insert();
        }

        // pr_filter
        $sourcePrFilter = (new PrFilter())->getAllWhere(['program_id' => $sourceProgramId], 'object');
        foreach ($sourcePrFilter as $val) {
            $newPrFilter = clone $val;
            $newPrFilter->program_id = $newProgram_id;
            $newPrFilter->insert();
        }

        // pr_tour_type
        $sourcePrTourType = (new PrTourType())->getAllWhere(['program_id' => $sourceProgramId], 'object');
        foreach ($sourcePrTourType as $val) {
            $newPrTourType = clone $val;
            $newPrTourType->program_id = $newProgram_id;
            $newPrTourType->insert();
        }

        // pr_target_audience
        $sourcePrTargetAudience = (new PrTargetAudience())->getAllWhere(['program_id' => $sourceProgramId], 'object');
        foreach ($sourcePrTargetAudience as $val) {
            $newPrTargetAudience = clone $val;
            $newPrTargetAudience->program_id = $newProgram_id;
            $newPrTargetAudience->insert();
        }

        // ПРОГРАММА ПО ДНЯМ.
        // pr_days
        $sourcePrDay = (new PrDay())->getAllWhere(['program_id' => $sourceProgramId], 'object');
        foreach ($sourcePrDay as $day) {
            /** @var PrDay $newPrDay */
            $newPrDay = clone $day;
            $newPrDay->id = null;
            $newPrDay->program_id = $newProgram_id;
            $newPrDay->img_id = null;

            if (!is_null($day->geo_id)){
                /** @var PrGeo $newStart */
                $newPrDayGeo = clone (new PrGeo())->getOne($day->geo_id);
                $newPrDayGeo->id = null;
                $newPrDayGeo->program_id = $newProgram_id;
                $newPrDayGeo->insert();
                $newPrDayGeo_id = $db->lastInsertId();
                $newPrDay->geo_id = $newPrDayGeo_id;
            }

            // Создаем новый день.
            $newPrDay->insert();
            // Получаем id только что созданного дня.
            $newPrDay_id = $db->lastInsertId();

            // pr_day_activities
            $sourceDayActivity = (new PrDayActivity())->getAllWhere([
                'day_id' => $day->id,
                'program_id' => $sourceProgramId
            ], 'object');
            foreach ($sourceDayActivity as $val) {
                $newDayActivity = clone $val;
                $newDayActivity->id = null;
                $newDayActivity->day_id = $newPrDay_id;
                $newDayActivity->program_id = $newProgram_id;
                $newDayActivity->insert();
            }

            // pr_day_meal
            $sourceDayMeal = (new PrDayMeal())->getAllWhere([
                'day_id' => $day->id,
            ], 'object');
            foreach ($sourceDayMeal as $val) {
                $newDayMeal = clone $val;
                $newDayMeal->day_id = $newPrDay_id;
                $newDayMeal->insert();
            }

            // pr_day_points
            $sourceDayPoint = (new PrDayPoint())->getAllWhere([
                'day_id' => $day->id,
                'program_id' => $sourceProgramId
            ], 'object');
            foreach ($sourceDayPoint as $val) {
                $newDayPoint = clone $val;
                $newDayPoint->id = null;
                $newDayPoint->day_id = $newPrDay_id;
                $newDayPoint->program_id = $newProgram_id;
                $newDayPoint->insert();
            }

            // pr_day_transfer
            $sourceDayTransfer = (new PrDayTransfer())->getAllWhere([
                'day_id' => $day->id,
            ], 'object');
            foreach ($sourceDayTransfer as $val) {
                $newDayTransfer = clone $val;
                $newDayTransfer->day_id = $newPrDay_id;
                $newDayTransfer->insert();
            }
        }
    }
} else {
    $error = 'Название программы не может быть пустым';
}

if (is_null($error)) {
    // Создаем директории изображений для вновь созданной программы в рамках партнера.
    Program::createDirForImgPrograms($partnerId, $newProgram_id);
}

echo json_encode(['id' => $newProgram_id, 'error' => $error]);
