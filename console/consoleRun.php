<?php

/**
 * Общий файл для всех консольных исполняемых файлов, который запускает консольное приложение.
 * Файл необходимо включать самым первым в исполняемые файлы.
 */

use app\console\base\AppConsole;

// Поключаем файл параметров.
require __DIR__ . "/config/params.php";
// Подключаем конфигурационный файл
$config = require __DIR__ . "/config/config.php";

// Подключаем класс автозагрузки Composer.
require __DIR__ . '/../vendor/autoload.php';

// Запускаем приложение.
AppConsole::get()->run($config);
