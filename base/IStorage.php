<?php

namespace app\base;

/**
 * Interface IStorage обеспечивает хранение объектов.
 * @package app\base
 */
interface IStorage
{
    /**
     * Метод помещает объект заданного элемента в массив для хранения.
     * @param $name - Название элемента.
     * @param $object - Объект элемента.
     */
    public function set($name, $object);

    /**
     * Метод проверяет существование объекта нашего элемента в хранилище, если объект существует, то
     * метод возвращает его, если не существует, то создает его и возвращает.
     * @param $name - Название элемента.
     * @return object - объект элемента.
     */
    public function get($name);
}