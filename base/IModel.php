<?php

namespace app\base;

/**
 * Interface IModel
 * @package app\base
 */
interface IModel
{
    /**
     * Метод получает из базы данных элемент и возвращает его в виде объекта класса.
     * @param int $id
     * @return mixed
     */
    public function getOne(int $id);

    /**
     * Метод удаляет из базы данных информацию о текущем объекте.
     * @return mixed
     */
    public function delete();

    /**
     * Метод вставляет данные текущего объекта в базу данных.
     * @return mixed
     */
    public function insert();

    /**
     * Метод обновляет данные текущего объекта в базе данных.
     * @return mixed
     */
    public function update();

    /**
     * Метод возвращает класс сущности с которой будет работать модель.
     * @return string
     */
    public function getClass();

    /** Метод возвращает название таблицы в базе данных для текущего класса. */
    public static function tableName();
}
