<?php

namespace app\services;

use app\base\App;

class Geo
{
    /** @var Db */
    protected $db;
    /** @var DbGeo */
    protected $db_geo;


    /**
     * Geo constructor.
     */
    public function __construct()
    {
        $this->db = App::get()->db;
        $this->db_geo = App::get()->db_geo;
    }

    /**
     * Метод возвращает массив стран.
     * @return array Массив стран.
     */
    public function getCountry(): array
    {
        if (empty($this->arrCountry)) {
            // Получаем массив всех городов отсортированных по имени.
            $sql = "SELECT name, id FROM pb_country GROUP BY name";

            return $this->db_geo->queryAll($sql);
        }

        return $this->arrCountry;
    }

    /**
     * Получаем данные по городу из основной базы.
     * @param int|null $id
     * @return mixed
     */
    public function getCity(?int $id)
    {
        if (is_null($id)) {
            return false;
        }

        $sql = "SELECT * FROM pb_city WHERE id = :id";
        return $this->db->queryOne($sql, [':id' => $id]);
    }

    /**
     * Получаем данные по городу из базы geo.
     * @param int|null $id
     * @return mixed
     */
    public function getCityGeo(?int $id)
    {
        if (is_null($id)) {
            return false;
        }

        $sql = "SELECT * FROM pb_city WHERE id = :id";
        return $this->db_geo->queryOne($sql, [':id' => $id]);
    }

    /**
     * Если города нет в основной базе, то клонируем его из базы geo. Здесь же проверяется и наличие региона в основной
     * базе для этого города, если региона нет, то клонируем его из базы geo.
     * @param int|null $id
     */
    public function cloneCity(?int $id)
    {
        if (is_null($id)) {
            return;
        }

        // Получаем данные по городу из основной базы.
        $arrCity = $this->getCity($id);

        // Если такого города нет, то клонируем его из базы geo.
        if (!$arrCity) {
            // Получаем данные из базы geo.
            $arrCityGeo = $this->getCityGeo($id);

            // Если нет данных, то выходим.
            if (!$arrCityGeo) {
                return;
            }

            // Формируем массив полей и их значений.
            $columns = [];
            $params = [];

            foreach ($arrCityGeo as $key => $val) {
                $columns[] = "{$key}";
                $params[":{$key}"] = $key;
            }

            $params = implode(", ", array_keys($params));
            $columns = implode(',', $columns);

            $sql_copy = "INSERT INTO pb_city ({$columns}) VALUES ({$params})";
            $this->db->execute($sql_copy, $arrCityGeo);

            // Получаем данные по только что добавленному городу из основной базы.
            $arrCityClone = $this->getCity($id);

            if ($arrCityClone) {
                // Проверяем, есть ли район, которому принадлежит город в основной базе, если нет, то клонируем его из geo.
                $this->cloneArea($arrCityClone['area']);
            }

        }
    }

    /**
     * Получаем данные по региону из основной базы.
     * @param int|null $id
     * @return mixed
     */
    public function getArea(?int $id)
    {
        if (is_null($id)) {
            return false;
        }

        $sql = "SELECT * FROM pb_area WHERE id = :id";
        return $this->db->queryOne($sql, [':id' => $id]);
    }

    /**
     * Получаем данные по региону из базы geo.
     * @param int $id
     * @return mixed
     */
    public function getAreaGeo(int $id)
    {
        $sql = "SELECT * FROM pb_area WHERE id = :id";
        return $this->db_geo->queryOne($sql, [':id' => $id]);
    }

    /**
     * Если региона нет в основной базе, то клонируем его из базы geo.
     * @param int|null $id
     */
    private function cloneArea(?int $id)
    {
        if (is_null($id)) {
            return;
        }

        // Получаем данные по региону из основной базы.
        $arrArea = $this->getArea($id);

        // Если такого города нет, то клонируем его из базы geo.
        if (!$arrArea) {
            // Получаем данные из базы geo.
            $arrAreaGeo = $this->getAreaGeo($id);

            // Если нет данных, то выходим.
            if (!$arrAreaGeo) {
                return;
            }

            // Формируем массив полей и их значений.
            $columns = [];
            $params = [];

            foreach ($arrAreaGeo as $key => $val) {
                $columns[] = "{$key}";
                $params[":{$key}"] = $key;
            }

            $params = implode(", ", array_keys($params));
            $columns = implode(',', $columns);

            $sql_copy = "INSERT INTO pb_area ({$columns}) VALUES ({$params})";
            $this->db->execute($sql_copy, $arrAreaGeo);
        }
    }

    /**
     * Получаем название города из основной базы.
     * @param int|null $id
     * @return mixed
     */
    public function getCityName(?int $id)
    {
        if (is_null($id)) {
            return '';
        }

        $sql = "SELECT name FROM pb_city WHERE id = :id";
        $result = $this->db->queryOne($sql, [':id' => $id]);

        return $result['name'];
    }

    public function getCountryName(?string $id) {
        if (is_null($id)) {
            return '';
        }

        $sql = "SELECT name FROM pb_country WHERE id = :id";
        $result = $this->db->queryOne($sql, [':id' => $id]);

        return $result['name'];
    }
}