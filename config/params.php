<?php

// Пути.
define("DOCUMENT_ROOT", __DIR__ . "/../");
define("WWW_DIR", __DIR__ . "/../www/");
define("SERVICES_DIR", __DIR__ . "/../services/");
define("VIEWS_DIR", __DIR__ . "/../views/");
define("VIEWS_WIDGETS_DIR", __DIR__ . "/../widgets/");
define("CSS_DIR", WWW_DIR . "/css/");
define("JS_DIR", WWW_DIR . "/js/");
define("IMG_DIR", WWW_DIR . "/images/");

define("EMAIL_SUPPORT", "puly@ideas4.travel");
define("EMAIL_MODERATOR", "puly@ideas4.travel");

// Базы данных кабинета партнера.
define("DB_P_USERS", "p_users");
define("DB_P_AUTH_KEYS", "p_auth_keys");
define("DB_P_AUTH_LOGS", "p_auth_logs");

// Подключение к MySQL.
if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
    define("MYSQL_DRIVER", "mysql");
    define("MYSQL_CHARSET", "utf8mb4");
    define("MYSQL_HOST", "localhost");
    define("MYSQL_LOGIN", "root");
    define("MYSQL_PASS", "");
    define("MYSQL_DB", "i4t");
    define("MYSQL_DB_GEO", "i4t_geo");
} elseif ($_SERVER["SERVER_NAME"] == "partner.ideas100travel.ru") {
    define("MYSQL_DRIVER", "mysql");
    define("MYSQL_CHARSET", "utf8mb4");
    define("MYSQL_HOST", "localhost");
    define("MYSQL_LOGIN", "u0748865_partner");
    define("MYSQL_PASS", "PeM34oN7seKr");
    define("MYSQL_DB", "u0748865_partner");
    define("MYSQL_DB_GEO", "u0748865_geo");
} elseif ($_SERVER["SERVER_NAME"] == "partner.ideas4travel.ru") {
    define("MYSQL_DRIVER", "mysql");
    define("MYSQL_CHARSET", "utf8mb4");
    define("MYSQL_HOST", "localhost");
    define("MYSQL_LOGIN", "u0863851_partner");
    define("MYSQL_PASS", "AeL74oN9seKr");
    define("MYSQL_DB", "u0863851_partner");
    define("MYSQL_DB_GEO", "u0863851_geo");
}
