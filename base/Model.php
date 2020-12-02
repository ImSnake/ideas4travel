<?php

namespace app\base;

use app\helpers\Validators;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

abstract class Model
{
    // Массив ошибок.
    public $errors = [];
    // Имя атребута для массива ошибок.
    public $attrErrors = '';
    // Массив элементов обязательных к заполнению, но непрошедших валидацию.
    public $notRequiredValidate = [];

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
}
