<?php

namespace app\console\base;

use app\base\IStorage;
use Exception;

/**
 * Class ComponentsStorage обеспечивает хранение объектов наших компонентов.
 * @package app\base
 */
class ComponentsStorage implements IStorage
{
    private $items = [];

    /**
     * Метод помещает объект заданного компонента в массив для хранения.
     * @param $name - Название компонента.
     * @param $object - Объект компонента.
     */
    public function set($name, $object)
    {
        $this->items[$name] = $object;
    }

    /**
     * Метод проверяет существование объекта нашего компонента в хранилище, если объект существует, то
     * метод возвращает его, если не существует, то создает его и возвращает.
     * @param $name - Название компонента.
     * @return object - объект копонента.
     * @throws Exception
     */
    public function get($name)
    {
        if (!isset($this->items[$name])) {
            $this->items[$name] = AppConsole::get()->createComponent($name);
        }

        return $this->items[$name];
    }
}
