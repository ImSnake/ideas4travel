<?php

namespace app\services;

use PDO;
use PDOStatement;

/**
 * Class Db - Содержит свойства и методы отвечающие за соединение с базой данных.
 * @package app\services
 */
class Db
{
    /** @var null - Свойство в котором будет храниться соединение с базой данных. */
    protected $conn = null;

    /**
     * Метод проверяет установлено ли соединение с сервером базы данных. Если соединение не установлено, то
     * устанавливает и возвращает его. Если соединение уже установлено, просто возвращает его.
     * @return null|PDO соединение между PHP и сервером базы данных.
     */
    protected function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new PDO(
                $this->prepareDsnString(),
                MYSQL_LOGIN,
                MYSQL_PASS
            );

            $this->conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
            );
        }

        return $this->conn;
    }

    /**
     * Приватный метод возвращает подготовленную строку DSN.
     * @return string
     */
    protected function prepareDsnString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s", MYSQL_DRIVER, MYSQL_HOST, MYSQL_DB, MYSQL_CHARSET);
    }

    /**
     * Метод выполняет выполняет подготовленный запрос и возвращает результирующий набор.
     * @param string $sql - Строка запроса.
     * @param array $params - Параметры к переменным запроса.
     * @return bool|PDOStatement Возвращается результирующий набор или false в случае неудачи.
     */
    private function query(string $sql, array $params = [])
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    /**
     * Метод возвращает из базы строку в виде заданном в режиме выборки.
     * @param string $sql - Строка запроса.
     * @param array $params - Параметры к переменным запроса.
     * @return mixed В случае успешного выполнения возвращается значение в зависти от режима выборки,
     * в случае неудачи, возвращает false.
     */
    public function queryOne(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Метод возвращает из базы строки в виде заданном в режиме выборки.
     * @param string $sql - Строка запроса.
     * @param array $params - Параметры к переменным запроса.
     * @return array Возвращает массив, содержащий все строки результирующего набора в виде заданном в режиме выборки.
     */
    public function queryAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Метод возвращает результат выборки в виде объекта заданного класса.
     * @param string $sql - Строка запроса.
     * @param string $class - Класс от которого будет создан объект выборки.
     * @param array $params - Параметры к переменным запроса.
     * @return mixed Возвращает результат в виде объекта, имена свойств которого совпадают с именами столбцов.
     */
    public function queryObject(string $sql, string $class, array $params = [])
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(PDO::FETCH_CLASS, $class);
        return $smtp->fetch();
    }

    /**
     * Метод возвращает массив результатов выборки в виде объектов заданного класса.
     * @param string $sql - Строка запроса.
     * @param string $class - Класс от которого будет создан объект выборки.
     * @param array $params - Параметры к переменным запроса.
     * @return array Возвращает массив результатов выборки в виде объектов, имена свойств которых совпадают с именами
     *   столбцов.
     */
    public function queryArrObject(string $sql, string $class, array $params = [])
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(PDO::FETCH_CLASS, $class);
        return $smtp->fetchAll();
    }

    /**
     * Метод позволяет выполнять запросы не связанные с выборкой данных и возвращением результатов.
     * @param string $sql - Строка запроса.
     * @param array $params - Параметры к переменным запроса.
     */
    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }

    /**
     * Метод возвращает ID последней вставленной строки в базу данных.
     * @return string Возвращает ID последней вставленной строки в базу данных.
     */
    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}
