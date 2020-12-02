<?php

namespace app\base;

use app\helpers\Validators;
use app\services\Db;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class Model
 * @package app\base
 */
abstract class Model implements IModel
{
    // Массив ошибок.
    public $errors = [];
    // Имя атрибута для массива ошибок.
    public $attrErrors = '';
    // Массив элементов обязательных к заполнению, но непрошедших валидацию.
    public $notRequiredValidate = [];

    // Название и значение первичного ключа.
    protected $primaryKey = null;
    protected $primaryKeyValue = null;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [];

    /** @var Db */
    protected $db;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->db = App::get()->db;
    }

    /**
     * Возвращает правила валидации для атрибутов.
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    /**
     * Возвращает список имен атрибутов.
     * По умолчанию этот метод возвращает все открытые нестатические свойства класса.
     * Этот метод можно переопределить, чтобы изменить поведение по умолчанию.
     * @return array
     * @throws ReflectionException
     */
    //todo сделать protected
    public function attributes()
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

    /**
     * @return bool
     * @throws ReflectionException
     */
    public function validate()
    {
        // Получаем экземпляр класса валидатора.
        $validator = new Validators($this);

        // Объходим построчно все правила валидации и получаем массив атрибутов, правила валидации и параметры.
        foreach ($this->rules() as $rule) {
            if (is_array($rule) && isset($rule[0], $rule[1])) { // массив attributes, тип validator, параметры.
                $attributes = $rule[0];
                $typeValidator = $rule[1];

                // Преоверяем существование такого правила валидации.
                if (in_array($typeValidator, $validator->methods())) {
                    // Обходим все отрабуты и применяем к ним текующее правило валидации.
                    foreach ($attributes as $attribute) {
                        // Проверяем существует ли такой атрибут.
                        if (in_array($attribute, $this->attributes())) {
                            // Проверяем был ли занесен данный атрибут в массив элементов
                            // обязательных к заполнению, но непрошедших валидацию.
                            if (!in_array($attribute, $this->notRequiredValidate)) {
                                // Валидируем атрибут.
                                $validator->$typeValidator($attribute, $rule[2]);
                            }
                        }
                    }
                }
            }
        }

        if ($this->errors) {
            return false;
        }

        return true;
    }

    /**
     * Возвращаем массив ошибок.
     * @return array
     */
    public function getError()
    {
        return $this->errors;
    }

    /**
     * Метод возвращает экземпляр объекта по заданному id.
     * @param $id
     * @return mixed
     */
    public function getOneOld($id)
    {
        $sql = "SELECT * FROM " . static::tableName() . " WHERE {$this->primaryKey} = :{$this->primaryKey}";
        $std = $this->db->queryObject($sql, $this->getClass(), [":{$this->primaryKey}" => $id]);
        $std->primaryKeyValue = $id;
        return $std;
    }

    /**
     * Метод возвращает экземпляр объекта по заданному id или массиву параметров.
     * @param integer|array $id
     * @return mixed
     */
    public function getOne($id)
    {
        // Если значение не передано, то возвращаем false.
        if (!$id) {
            return false;
        }

        // Проверяем какое значение передано.
        if (is_array($id)) {
            // Инициализируем переменую для формирования запроса WHERE.
            $columns = [];
            $primaryKey = null;

            // Формируем строку запроса WHERE из массива параметров.
            foreach ($id as $key => $val) {
                $columns[] = "{$key} = :{$key}";
                if ($key == $this->primaryKey) {
                    $primaryKey = $val;
                }
            }

            // Собираем строку запроса WHERE.
            $columns = implode(" and ", $columns);
            // Собираем строку для параметров таблицы
            $params = $id;

        } else {
            $columns = "{$this->primaryKey} = :{$this->primaryKey}";
            $params[":{$this->primaryKey}"] = $id;

        }

        $sql = "SELECT * FROM " . static::tableName() . " WHERE {$columns}";
        $std = $this->db->queryObject($sql, $this->getClass(), $params);

        // Если есть результат, то присваиваем его primaryKeyValue
        if ($std) {
            if ($std && is_array($id)) {
                $std->primaryKeyValue = $primaryKey;
            } else {
                $std->primaryKeyValue = $id;
            }

        }

        return $std;
    }

    /**
     * Метод получает из базы данных массив элементов и возвращает их в виде объекта класса.
     * @param string $type - задает тип возвращаемого результата: array или object.
     * @return array|null  Массив элементов в виде объектов класса или массива.
     */
    public function getAll($type = 'array')
    {
        $sql = "SELECT * FROM " . static::tableName();

        if ($type == 'object') {
            return $this->db->queryArrObject($sql, $this->getClass());
        }

        if ($type == 'array') {
            return $this->db->queryAll($sql);
        }

        return null;
    }

    /**
     * Метод получает из базы данных массив элементов и возвращает их в виде объекта класса.
     * @param array $where - Массив с параметрами запроса, например: ['type' => 1, 'partner_id' => 7].
     * @param string $type - задает тип возвращаемого результата: array или object, использует: array и object.
     * @return array|null  Массив элементов в виде объектов класса или массива, но с ограничением не более 500.
     */
    public function getAllWhere(array $where, $type = 'array')
    {
        // Если запрос не в виде массива, то возвращаем null.
        if (!is_array($where)) {
            return null;
        }

        // Инициализируем переменую для формирования запроса WHERE.
        $columns = [];
        $params = [];

        // Формируем строку запроса WHERE из массива параметров.
        foreach ($where as $key => $val) {
            $columns[] = "{$key} = :{$key}";
        }

        // Собираем строку запроса WHERE.
        $columns = implode(" and ", $columns);

        // Формируем SQL запрос.
        $sql = "SELECT * FROM " . static::tableName() . " WHERE {$columns} LIMIT 500";

        if ($type == 'object') {
            return $this->db->queryArrObject($sql, $this->getClass(), $where);
        }

        if ($type == 'array') {
            return $this->db->queryAll($sql, $where);
        }

        return null;
    }

    /**
     * Метод получает из базы данных массив элементов и возвращает их в виде объекта класса.
     * @param array $where - Массив с параметрами запроса, например: ['type' => 1, 'partner_id' => 7].
     * @param string $type - задает тип возвращаемого результата: array или object, использует: array и object.
     * @return array|null  Массив элементов в виде объектов класса или массива, но с ограничением не более 500.
     */
    public static function find(array $where, $type = 'array')
    {
        // Получаем соединение с базой данных.
        $db = App::get()->db;

        // Если запрос не в виде массива, то возвращаем null.
        if (!is_array($where)) {
            return null;
        }

        // Инициализируем переменую для формирования запроса WHERE.
        $columns = [];
        $params = [];

        // Формируем строку запроса WHERE из массива параметров.
        foreach ($where as $key => $val) {
            $columns[] = "{$key} = :{$key}";
        }

        // Собираем строку запроса WHERE.
        $columns = implode(" and ", $columns);

        // Формируем SQL запрос.
        $sql = "SELECT * FROM " . static::tableName() . " WHERE {$columns}";

        if ($type == 'object') {
            return $db->queryArrObject($sql, self::class, $where);
        }

        if ($type == 'array') {
            return $db->queryAll($sql, $where);
        }

        return null;
    }

    /**
     * Метод удаляет из базы данных информацию о текущем объекте.
     */
    public function delete()
    {
        $sql = "DELETE FROM " . static::tableName() . " WHERE {$this->primaryKey} = :{$this->primaryKey}";
        $this->db->execute($sql, [":{$this->primaryKey}" => $this->primaryKeyValue]);
        $this->primaryKeyValue = null;
    }

    /**
     * Метод удаляет из таблицы строки по заданным условиям.
     * @param array $where - Массив с параметрами запроса, например: ['type' => 1, 'partner_id' => 7].
     * @return bool
     */
    public function deleteWhere(array $where)
    {
        // Если запрос не в виде массива, то возвращаем null.
        if (!is_array($where)) {
            return false;
        }

        // Инициализируем переменую для формирования запроса WHERE.
        $columns = [];

        // Формируем строку запроса WHERE из массива параметров.
        foreach ($where as $key => $val) {
            $columns[] = "{$key} = :{$key}";
        }

        // Собираем строку запроса WHERE.
        $columns = implode(" and ", $columns);

        $sql = "DELETE FROM " . static::tableName() . " WHERE {$columns}";
        $this->db->execute($sql, $where);

        return true;
    }

    public function insert()
    {
        // Инициализируем переменные для хранения полей в таблице и их параметров.
        $columns = [];
        $params = [];

        // Обходим в цикле свойства нашего массива.
        foreach ($this->attributes() as $key) {
            // Свойства должны соответствовать полям таблицы, и их значение не null.
//            if (in_array($key, $this->arrColumnsInTable) && $this->$key !== null && $this->$key != 'id') {
            if (in_array($key, $this->arrColumnsInTable) && $this->$key != 'id') {
                $params[":{$key}"] = $this->$key;
                $columns[] = "{$key}";
            }
        }

        // Собираем строку для полей таблицы.
        $columns = implode(", ", $columns);
        // Собираем строку для параметров таблицы
        $placeholders = implode(", ", array_keys($params));

        // Составляем строку запроса.
        $sql = "INSERT INTO " . static::tableName() . " ({$columns}) values ({$placeholders})";

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);

        // Присваиваем свойству ID нашего объекта значение равное ID только что вставленной строки.
        $this->primaryKeyValue = $this->db->lastInsertId();
    }

    /**
     * @return mixed|void
     * @throws ReflectionException
     */
    public function update()
    {
        // Инициализируем переменные для хранения полей в таблице и их параметров.
        $string = [];
        $params = [];

        // Обходим в цикле свойства нашего массива.
        foreach ($this->attributes() as $key) {
            // Свойства должны соответствовать полям таблицы, и их значение не null.
//            if (in_array($key, $this->arrColumnsInTable) && $this->$key !== null) {
            if (in_array($key, $this->arrColumnsInTable)) {
                $params[":{$key}"] = $this->$key;
                $string[] = "{$key} = :{$key}";
            }
        }

        // Собираем строку для полей таблицы и их значений.
        $string = implode(", ", $string);

        // Составляем строку запроса.
        $sql = "UPDATE " . static::tableName() . " SET {$string} WHERE {$this->primaryKey} = :{$this->primaryKey}";

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * @throws ReflectionException
     */
    public function save()
    {
        if (is_null($this->primaryKeyValue)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * Получаем значение первичного ключа
     * @return int|null
     */
    public function getPrimaryKey()
    {
        return $this->primaryKeyValue;
    }
}
