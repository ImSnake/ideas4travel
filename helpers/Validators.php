<?php

namespace app\helpers;

use app\base\App;
use app\base\Model;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Validators
{
    private $model;
    private $db;

    /**
     * Validators constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Поле обязательное для заполнения.
     * @param $attribute
     */
    public function required(string $attribute)
    {
        // Обрезаем пробелы в начале и конце.
        $this->model->$attribute = trim($this->model->$attribute);

        if (empty($this->model->$attribute)) {
            // Добавляем ошибку.
            $this->addError($attribute, 'Поле обязательное для заполнения.');
        }
    }

    /**
     * Метод проверяет корректность введенного email.
     * @param string $attribute
     */
    public function email(string $attribute)
    {
        // Переводим в нижний регистр и обрезаем пробелы в начале и конце.
        $this->model->$attribute = mb_strtolower(trim($this->model->$attribute));
        $email = $this->model->$attribute;

        // проверяем на допустимость символов
        if (!preg_match("/^([a-z0-9_\-.]+@[a-z0-9\-.]+\.[a-z]{2,7})$/i", $email)) {
            // Добавляем ошибку.
            $this->addError($attribute, 'Неверный адрес электронной почты');
        }
    }

    /**
     * Метод проверяет корректность введенного пароля.
     * @param string $attribute
     */
    public function password(string $attribute)
    {
        // Обрезаем пробелы в начале и конце.
        $pass = trim($this->model->$attribute);
        // Задаем минимальную и максимальную длину пароля.
        $min = 8;
        $max = 32;

        // пароль может включать только алфавитные символы, цифры,
        // знаки пунктуации (-!#$%&'()*+,./:;<=>?@[\]_`{|}~),
        // а его длина должна быть в заданных пределах
        if (preg_match("/^[[:alnum:][:punct:]]{" . $min . "," . $max . "}$/", $pass)) {
            // пароль не может содержать только буквы или цифры, или знаки пунктуации
//            if (preg_match("/^[a-zA-Z]+$|^[0-9]+$|^[[:punct:]]+$/", $pass)) {
//                // Добавляем ошибку.
//                $this->addError($attribute, 'Пароль не может содержать только буквы или цифры или знаки пунктуации.');
//            }
        } else {
            // Добавляем ошибку.
            $this->addError($attribute, 'Длина пароля должна быть от ' . $min . ' до ' . $max . ' символов.');
        }
    }

    /**
     * Метод проверяет совпадают ли значения поля пароль и повторить пароль.
     * @param string $attribute
     * @param string $attrPassword
     */
    public function password_repeat(string $attribute, string $attrPassword)
    {
        // Обрезаем пробелы в начале и конце.
        $pass_repeat = trim($this->model->$attribute);
        $pass = trim($this->model->$attrPassword);

        if ($pass !== $pass_repeat) {
            // Добавляем ошибку.
            $this->addError($attribute, 'Пароли не совпадают.');
        }
    }

    /**
     * Метод проверяет уникальность значения заданного атрибута.
     * @param string $attribute
     * @param string $tableName
     */
    public function unique(string $attribute, string $tableName)
    {
        // Получаем соединение с базой данных.
        $db = App::get()->db;
        // Проверяем на уникальность.
        $sql = "SELECT * FROM {$tableName} WHERE {$attribute} = :{$attribute}";

        // Если значение аргумента уже существует, то выводим ошибку.
        if ($db->queryOne($sql, [":{$attribute}" => $this->model->$attribute])) {
            // Добавляем ошибку.
            $this->addError($attribute, 'Такой ' . $attribute . ' уже существует.');
        }
    }

    /**
     * Метод проверяет соответствие длинны строки
     * Если проходит проверку - true, иначе - false
     * @param string $attribute
     * @param $params
     */
    public function length(string $attribute, $params)
    {
        // Обрезаем пробелы в начале и конце.
        $this->model->$attribute = trim($this->model->$attribute);
        // Получаем длину.
        $length = mb_strlen($this->model->$attribute);

        if (is_array($params)) {
            if ($params['max'] && $params['min']) {
                $max = $params['max'];
                $min = $params['min'];
                if ($length < $min || $length > $max) {
                    // Добавляем ошибку.
                    $this->addError($attribute, 'Длина должна быть от ' . $min . ' до ' . $max . ' символов.');
                }
            } elseif ($params['max'] && !$params['min']) {
                $max = $params['max'];
                if ($length > $max) {
                    // Добавляем ошибку.
                    $this->addError($attribute, 'Длина должна быть не более ' . $max . ' символов.');
                }
            }
        }
    }

    /**
     * Добавление ошибки.
     * @param string $attribute
     * @param string $messageErrors
     */
    protected function addError(string $attribute, string $messageErrors)
    {
        // Получаем атрибут ошибки.
        $attrErrors = $this->model->attrErrors;

        // Если отрибут ошибки пустой, то не используем его.
        if (empty($attrErrors)) {
            // Если для данного атрибута не было ошибок, то добавляем.
            if (!$this->model->errors[$attribute]) {
                $this->model->errors[$attribute] = $messageErrors;
            }
        } else {
            // Если для данного атрибута не было ошибок, то добавляем.
            if (!$this->model->errors[$attrErrors][$attribute]) {
                $this->model->errors[$attrErrors][$attribute] = $messageErrors;
            }
        }

        // Добавляем атрибут в notRequiredValidate, чтобы исключить дальнейшие проверки.
        $this->model->notRequiredValidate[] = $attribute;
    }

    /**
     * Возвращает список имен методов.
     * По умолчанию этот метод возвращает все открытые нестатические методы класса.
     * Этот метод можно переопределить, чтобы изменить поведение по умолчанию.
     * @return array
     * @throws ReflectionException
     */
    public function methods()
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (!$method->isStatic()) {
                $names[] = $method->getName();
            }
        }

        return $names;
    }
}
