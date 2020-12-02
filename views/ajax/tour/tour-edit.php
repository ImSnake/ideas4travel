<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\Models\program\Program;
use app\services\Auth;
use app\services\Db;
use app\Models\tour\Tour;
use app\helpers\DateHelpers;
use app\services\Request;
use app\Models\tour\ExtraCostPreset;
use app\Models\tour\ExtraCost;
use app\services\Currency;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var int $partnerId */
$partnerId = $auth->getPartner()->id;
/** @var null|string $error */
$error = null;

$tour_id = $_POST['tour_id'];

/** @var Tour $tour */
$tour = (new Tour())->getOne($tour_id);
/** @var array $program */
$program = Program::find(['id' => $tour->program_id])[0];

$currency = new Currency($db);

// Если текущий партнер не совпадает с партнером владельцем тура, то возвращаем ошибку.
if ($tour->partner_id == $partnerId) {
    $start_at = $_POST['tour']['start_at'];
    // Проверяем получено ли время старта тура.
    if (!empty($start_at)) {
        // Проверяем коректность даты.
        if (DateHelpers::validateDate($start_at, 'Y-m-d')) {
            // Если дата старта изменилась, то проверяем есть ли на эту дату другой тур для данной программы.
            if ($tour->start_at != $start_at) {
                if (!Tour::find(['program_id' => $tour->program_id, 'start_at' => $start_at])) {
                    // Получаем текущую дату в нужном формате.
                    $dateStartAt = new DateTime;
                    $dateStartAtString = $dateStartAt->format('Y-m-d');
                    // Получаем количество дней, до которых возможно бронирование тура (если есть booking_until, иначе 2).
                    $booking_until = !empty($_POST['tour']['booking_until']) ? $_POST['tour']['booking_until'] : 2;
                    // Проверяем корректность даты старта на текущий день (сегодняшняя дата + booking_until или 2 дня по умолчанию,
                    // если нет booking_until).
                    if (strtotime($start_at) >= strtotime($dateStartAtString . " + " . $booking_until . " day")) {
                        $tour->start_at = $start_at;
                    } else {
                        $error[] = 'дата начала тура должна быть не ранее ' . date('Y-m-d',
                                strtotime($dateStartAtString . " + " . $booking_until . " day"));
                    }
                } else {
                    $error[] = 'тур на эту дату уже существует.';
                }
            }
        } else {
            $error[] = 'дата начала тура не корректна';
        }
    } else {
        $error[] = 'дата начала тура не может быть пустой';
    }
} else {
    $error[] = 'У вас нет доступа для редактирования данного тура.';
}

// Проверяем количество свободных мест.
if ($_POST['tour']['available'] && $_POST['tour']['available'] > $program['group_max']) {
    $error[] = 'Количество свободных мест не может быть больше максимального размера группы - ' . $program['group_max'];
}

// Проверяем получено ли дата действия скидки.
if (!empty($_POST['tour']['discount_at'])) {
    // Проверяем коректность даты.
    if (!DateHelpers::validateDate($_POST['tour']['discount_at'], 'Y-m-d')) {
        $error[] = 'дата действия скидки не корректна';
    }
}

if (!$error) {
    $tour->t_status_id = Request::getPostForm($_POST['tour']['t_status_id'], $tour->t_status_id, null);
    $tour->t_season_id = Request::getPostForm($_POST['tour']['t_season_id'], $tour->t_season_id, null);
    $tour->temp_min = Request::getPostForm($_POST['tour']['temp_min'], $tour->temp_min, null);
    $tour->temp_max = Request::getPostForm($_POST['tour']['temp_max'], $tour->temp_max, null);


    // Если доступна скидка на текущую дату, то получаем ее.
    if ($tour->discount && (strtotime($tour->discount_at) >= strtotime(date('Y-m-d',
                time())))){
        $discount = $tour->discount;
    } else {
        $discount = 0;
    }

    $tour->price = Request::getPostForm($_POST['tour']['price'], $tour->price, null);
    $tour->currency = Request::getPostForm($_POST['tour']['currency'], $tour->currency, null);
    $tour->available = Request::getPostForm($_POST['tour']['available'], $tour->available, null);
    $tour->discount = Request::getPostForm($_POST['tour']['discount'], abs($tour->discount), null);
    $tour->discount = $tour->discount >= 0 || $tour->discount <= 100 ? $tour->discount : null;
    if (is_null($tour->discount)) {
        $tour->discount_at = null;
    } else {
        if (is_null($tour->discount_at)) {
            $date = new DateTime($tour->start_at);
            $date->add(new DateInterval('P' . $program['duration'] . 'D'));
            $tour->discount_at = $date->format('Y-m-d');
        } else {
            $tour->discount_at = Request::getPostForm($_POST['tour']['discount_at'], $tour->discount_at, null);
        }
    }
    $tour->booking_until = Request::getPostForm($_POST['tour']['booking_until'], abs($tour->booking_until), 2);
    $tour->booking_until = $tour->booking_until <= 365 ? $tour->booking_until : 365;
    $tour->prepayment = Request::getPostForm($_POST['tour']['prepayment'], abs($tour->prepayment), null);
    $tour->prepayment = $tour->prepayment >= 0 || $tour->prepayment <= 100 ? $tour->prepayment : null;
    $tour->pay_until = Request::getPostForm($_POST['tour']['pay_until'], abs($tour->pay_until), 2);
    $tour->pay_until = $tour->pay_until <= 365 ? $tour->pay_until : 365;
    $tour->booking_contact = Request::getPostForm($_POST['tour']['booking_contact'], $tour->booking_contact, null);
    $tour->booking_conditions = Request::getPostForm($_POST['tour']['booking_conditions'], $tour->booking_conditions,
        null);
    $tour->refund = Request::getPostForm($_POST['tour']['refund'], $tour->refund, null);

    // Конвертируем прайс в рубли в соответствии с текущим курсом валют.
    if ($tour->currency != 'RUB') {
        $price_compare = $currency->convert($tour->price, $tour->currency, 'RUB');
    } else {
        $price_compare = $tour->price;
    }

    // Получаем цену для сравнения с учетом скидки.
    $tour->price_compare = $price_compare - $price_compare * $discount / 100;

    $tour->updated_at = date("Y-m-d H:i:s");
    $tour->save();

    // ДОПОЛНИТЕЛЬНАЯ СТОИМОСТЬ =============================================================

    // Получаем данные по предустановленной дополнительной стоимости.
    $extraCostPresent = $_POST['tour']['extra_cost_preset'];

    // Удаляем старые значения предустановленной дополнительной стоимости.
    (new ExtraCostPreset())->deleteWhere(['tour_id' => $tour->id]);

    foreach ($extraCostPresent as $key => $value) {
        if (isset($value['checkbox']) && (!empty(trim($value['cost'])) || !empty(trim($value['currency'])) || !empty(trim($value['comment'])))) {
            $newExtraCostPreset = new ExtraCostPreset();
            $newExtraCostPreset->tour_id = $tour->id;
            $newExtraCostPreset->extra_cost_preset_id = $key;
            $newExtraCostPreset->comment = Request::getPostForm($value['comment'], null, null);
            $newExtraCostPreset->cost = Request::getPostForm($value['cost'], null, null);
            $newExtraCostPreset->currency = Request::getPostForm($value['currency'], null, null);
            $newExtraCostPreset->insert();
        }
    }

    // Удаляем старый данные о дополнительной стоимости.
    (new ExtraCost())->deleteWhere(['tour_id' => $tour->id]);

    // Получаем данные по предустановленной дополнительной стоимости.
    if ($extraCostRequired = $_POST['tour']['extra_cost_required']) {
        foreach ($extraCostRequired as $value) {
            if (!empty(trim($value['cost'])) || !empty(trim($value['currency'])) || !empty(trim($value['comment']))) {
                $newExtraCost = new ExtraCost();
                $newExtraCost->tour_id = $tour->id;
                $newExtraCost->comment = Request::getPostForm($value['comment'], null, null);
                $newExtraCost->cost = Request::getPostForm($value['cost'], null, null);
                $newExtraCost->currency = Request::getPostForm($value['currency'], null, null);
                $newExtraCost->required = 1;
                $newExtraCost->insert();
            }
        }
    }


    // Получаем данные по предустановленной дополнительной стоимости.
    if ($extraCostAdditional = $_POST['tour']['extra_cost_additional']) {
        foreach ($extraCostAdditional as $value) {
            if (!empty(trim($value['cost'])) || !empty(trim($value['currency'])) || !empty(trim($value['comment']))) {
                $newExtraCost = new ExtraCost();
                $newExtraCost->tour_id = $tour->id;
                $newExtraCost->comment = Request::getPostForm($value['comment'], null, null);
                $newExtraCost->cost = Request::getPostForm($value['cost'], null, null);
                $newExtraCost->currency = Request::getPostForm($value['currency'], null, null);
                $newExtraCost->required = '0';
                $newExtraCost->insert();
            }
        }
    }

}

echo json_encode(['post' => $_POST, 'start_at' => $start_at, 'error' => $error]);
