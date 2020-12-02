<?php

namespace app\services;

class DbGeo extends Db
{
    /**
     * Приватный метод возвращает подготовленную строку DSN.
     * @return string
     */
    protected function prepareDsnString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s", MYSQL_DRIVER, MYSQL_HOST, MYSQL_DB_GEO, MYSQL_CHARSET);
    }
}