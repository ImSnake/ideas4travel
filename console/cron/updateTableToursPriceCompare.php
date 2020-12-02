<?php

/**
 * Актуализируем стоимость тура по сегодняшенму курсу валют.
 */

// Запускаем консольное приложение
require __DIR__ . "/../consoleRun.php";

use app\console\base\AppConsole;
use app\Models\tour\Tour;
use app\services\Currency;

$db = AppConsole::get()->db;

$currency = new Currency($db);
$getUserCurrencyID = $currency->getUserCurrencyID();

// Формируем SQL запрос.
$sql = "SELECT * FROM " . Tour::tableName();
// Выполняем наш запрос.
$tours = $db->queryAll($sql);

// Обходим все используемые валюты и обнавлям их курсы.
foreach ($tours as $item) {
    // Конвертируем прайс в рубли в соответствии с текущим курсом валют.
    if ($item['currency'] != 'RUB') {
        $price_compare = $currency->convert($item['price'], $item['currency'], 'RUB');
    } else {
        $price_compare = $item['price'];
    }

    // Если доступна скидка на текущую дату, то получаем ее.
    if ($item->discount && (strtotime($item->discount_at) >= strtotime(date('Y-m-d',
                time())))){
        $discount = $item->discount;
    } else {
        $discount = 0;
    }

    // Получаем цену для сравнения с учетом скидки.
    $price_compare = $price_compare - $price_compare * $discount / 100;

    // Составляем строку запроса.
    $sql = "UPDATE " . Tour::tableName() . " SET price_compare = :price_compare WHERE id = :id";
    // Выполняем наш запрос.
    $db->execute($sql, [':price_compare' => $price_compare, ':id' => $item['id']]);
}
