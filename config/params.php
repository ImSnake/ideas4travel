<?php

// Пути.
define("DOCUMENT_ROOT", __DIR__ . "/../");
define("WWW_DIR", __DIR__ . "/../www/");
define("SERVICES_DIR", __DIR__ . "/../services/");
define("VIEWS_DIR", __DIR__ . "/../views/");
define("CSS_DIR", WWW_DIR . "/css/");
define("JS_DIR", WWW_DIR . "/js/");

define("EMAIL_SUPPORT", "support@ideas4.travel");



// Базы данных кабинета партнера.
define("DB_P_USERS", "p_users");
define("DB_P_AUTH_KEYS", "p_auth_keys");
define("DB_P_AUTH_LOGS", "p_auth_logs");

// Подключение к MySQL.
if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
    define("MYSQL_DRIVER", "mysql");
    define("MYSQL_CHARSET", "utf8");
    define("MYSQL_HOST", "localhost");
    define("MYSQL_LOGIN", "root");
    define("MYSQL_PASS", "");
    define("MYSQL_DB", "i4t");
} else {
    define("MYSQL_DRIVER", "mysql");
    define("MYSQL_CHARSET", "utf8");
    define("MYSQL_HOST", "localhost");
    define("MYSQL_LOGIN", "u0748865_partner");
    define("MYSQL_PASS", "PeM34oN7seKr");
    define("MYSQL_DB", "u0748865_partner");
}
