<?php

use app\base\App;

// Поключаем файл параметров.
require __DIR__ . "/../config/params.php";
// Подключаем конфигурационный файл
$config = require __DIR__ . "/../config/config.php";

// Подключаем класс автозагрузки Composer.
require __DIR__ . '/../vendor/autoload.php';

// Запускаем приложение.
App::get()->run($config);
