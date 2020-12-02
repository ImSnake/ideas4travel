<?php

/**
 * Получаем курсы валют на сегодняшнюю дату используя API сайта Центрального банка РФ.
 */

// Запускаем консольное приложение
require __DIR__ . "/../consoleRun.php";

use app\services\CBRAgent;
use app\services\Currency;
use app\console\base\AppConsole;

$CBRAgent = new CBRAgent(new DateTime());

// Обходим все используемые валюты и обнавлям их курсы.
foreach (Currency::ARR_CURRENCY as $item) {
    if ($item != 'RUB') {
        if ($value = $CBRAgent->get($item)) {
            // Составляем строку запроса.
            $sql = "UPDATE " . Currency::TABLE_NAME . " SET value = :value WHERE id = :id";
            // Выполняем наш запрос.
            AppConsole::get()->db->execute($sql, [':id' => $item, ':value' => $value]);
        }
    }
}
