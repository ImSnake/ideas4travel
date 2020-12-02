<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\Models\tour\Tour;
use app\helpers\DateHelpers;
use app\Models\tour\ExtraCost;
use app\Models\tour\ExtraCostPreset;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

// Получаем данный из ajax запроса.
$program_id = $_POST['program_id'];
$start_at = $_POST['start_at'];

// Проверяем получен ли id программы.
if (!empty($program_id)) {
    /** @var Program $program */
    $program = (new Program())->getOne($program_id);

    // Проверяем принадлежит ли данная программа текущему пользователю.
    if ($program->partner_id == $partnerId) {
        // Проверяем получено ли время старта тура.
        if (!empty($start_at)) {
            // Проверяем коректность даты.
            if (DateHelpers::validateDate($start_at, 'Y-m-d')) {
                // Проверяем корректность даты старта (текущее время +2 дня)
                $date = new DateTime();
                $dateStartMin = $date->add(new DateInterval('P2D'));
                $dateStartMinString = $dateStartMin->format('Y-m-d');

                if (strtotime($start_at) >= strtotime($dateStartMinString)) {
                    // Проверяем есть ли на эту дату тур для данной программы.
                    if (Tour::find(['program_id' => $program_id, 'start_at' => $start_at])) {
                        $error = 'тур на эту дату уже существует в разделе <a href="/tours" class="blue">Туры на сайте</a>';
                    }
                } else {
                    $error = 'дата начала тура должна быть не ранее сегодняшней даты + 2 дня';
                }
            } else {
                $error = 'дата начала тура не корректна';
            }
        } else {
            $error = 'дата начала тура не может быть пустой';
        }
    } else {
        $error = 'ошибка запроса пользователя';
    }
} else {
    $error = 'для создания тура не хватает данных';
}

// Если нет ошибок, то создаем новый тур.
if (!$error) {
    /** @var Tour $newTour */
    $newTour = new Tour();

    // Если был передан tour_id, то получаем тур по этому id, если нет, то получаем данные по пследнему созданному туру
    // у данной программы (исключая архивные), если у данной программы еще нет туров, то создаем пустой тур.
    if (!empty($_POST['tour_id'])) {
        /** @var Tour $tour - Получаем данные тура с tour_id. */
        $tour = (new Tour())->getOne($_POST['tour_id']);
    } else {
        // Получаем данные у последнего созданного тура для этой программы.
        $sql = "SELECT * FROM " . Tour::tableName() . " WHERE program_id = :program_id ORDER BY id desc";
        /** @var Tour $tour */
        $tour = $db->queryObject($sql, Tour::class, [':program_id' => $program_id]);
    }

    // Если есть данные по дублированному туру, то копируем данные во новь созданный тур.
    if ($tour) {
        $newTour->temp_min = $tour->temp_min;
        $newTour->temp_max = $tour->temp_max;
        $newTour->price = $tour->price;
        $newTour->currency = $tour->currency;
        $newTour->available = $tour->available;
        $newTour->discount = $tour->discount;
        $newTour->discount_at = $tour->discount_at;
        $newTour->booking_until = $tour->booking_until;
        $newTour->prepayment = $tour->prepayment;
        $newTour->pay_until = $tour->pay_until;
        $newTour->payment_extra = $tour->payment_extra;
        $newTour->booking_contact = $tour->booking_contact;
        $newTour->booking_conditions = $tour->booking_conditions;
        $newTour->refund = $tour->refund;
        $newTour->t_status_id = $tour->t_status_id;
        $newTour->t_season_id = $tour->t_season_id;
    }

    $newTour->partner_id = $partnerId;
    $newTour->program_id = $program_id;
    $newTour->start_at = $start_at;
    $newTour->t_status_admin_id = Tour::STATUS_DRAFT;
    $newTour->created_at = date("Y-m-d H:i:s");
    $newTour->updated_at = date("Y-m-d H:i:s");
    $newTour->insert();
    $last_id = $db->lastInsertId();

    // Если есть данные по дублированному туру, то дублируем данные по допрасходам обязательным и не обязательным.
    if ($tour) {
        /** @var ExtraCost $arrExtraCost */
        $arrExtraCost = (new ExtraCost())->getAllWhere(['tour_id' => $tour->id], 'object');

        foreach ($arrExtraCost as $item){
            /** @var ExtraCost $item */
            $newExtraCost = new ExtraCost();
            $newExtraCost->tour_id = $last_id;
            $newExtraCost->comment = $item->comment;
            $newExtraCost->cost = $item->cost;
            $newExtraCost->currency = $item->currency;
            $newExtraCost->required = $item->required;
            $newExtraCost->insert();
        }

        /** @var ExtraCost $arrExtraCost */
        $arrExtraCostPreset = (new ExtraCostPreset())->getAllWhere(['tour_id' => $tour->id], 'object');

        foreach ($arrExtraCostPreset as $item){
            /** @var ExtraCostPreset $item */
            $newExtraCostPreset = new ExtraCostPreset();
            $newExtraCostPreset->tour_id = $last_id;
            $newExtraCostPreset->extra_cost_preset_id = $item->extra_cost_preset_id;
            $newExtraCostPreset->comment = $item->comment;
            $newExtraCostPreset->cost = $item->cost;
            $newExtraCostPreset->currency = $item->currency;
            $newExtraCostPreset->insert();
        }
    }
}

echo json_encode(['post' => $_POST, 'id' => $last_id, 'tour' => $tour, 'arrExtraCost' => $arrExtraCost, 'arrExtraCostPreset' => $arrExtraCostPreset, 'error' => $error]);
