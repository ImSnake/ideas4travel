<?php

namespace app\Models\program;

use app\base\App;
use app\base\Model;
use app\helpers\ArrayHelpers;
use app\services\Db;

class PrDay extends Model
{
    public $id;
    public $program_id;
    public $day;
    public $geo_id;
    public $accommodation_id;
    public $accommodation_room_id;
    public $description;
    public $distance;
    public $img_id;
    public $day_place_checkbox;
    public $accommodation_checkbox;
    public $meal_checkbox;
    public $transfer_checkbox;

    /** @var Db */
    protected $db;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'program_id',
        'day',
        'geo_id',
        'accommodation_id',
        'accommodation_room_id',
        'description',
        'distance',
        'img_id',
        'day_place_checkbox',
        'accommodation_checkbox',
        'meal_checkbox',
        'transfer_checkbox',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_days';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    /**
     * Получаем список элементов размещения для дней.
     * @return array
     */
    public static function getArrAccommodation()
    {
        $arrAccommodation = App::get()->db->queryAll("SELECT * FROM _day_accommodation");

        return ArrayHelpers::sortByStatus($arrAccommodation, false);
    }

    /**
     * Получаем данные по конкретному размещению.
     * @return mixed
     */
    public function getAccommodation()
    {
        return $this->db->queryOne("SELECT * FROM _day_accommodation WHERE id = :id",
            [':id' => $this->accommodation_id]);
    }

    /**
     * Получаем список элементов типов комнат в размещении для дней.
     * @return array
     */
    public static function getArrAccommodationRoom()
    {
        $arrAccommodationRoom = App::get()->db->queryAll("SELECT * FROM _day_accommodation_room");

        return ArrayHelpers::sortByStatus($arrAccommodationRoom, false);
    }

    /**
     * Получаем данные по конкретной типу комнат.
     * @return mixed
     */
    public function getAccommodationRoom()
    {
        return $this->db->queryOne("SELECT * FROM _day_accommodation_room WHERE id = :id",
            [':id' => $this->accommodation_room_id]);
    }

    /**
     * Получаем список элементов питания для дней.
     * @return array
     */
    public static function getArrDayMeal()
    {
        $arrDayMeal = App::get()->db->queryAll("SELECT * FROM _day_meal");

        return ArrayHelpers::sortByStatus($arrDayMeal, false);
    }

    /**
     * Получаем список id выбранных элементов питания для дней.
     * @return array|bool
     */
    public function getDayMeal()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT day_meal_id FROM " . PrDayMeal::tableName() . " WHERE day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        foreach ($result as $val) {
            $arr[] = $val['day_meal_id'];
        }

        return $arr;
    }

    public function getDayMealName()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT m.name FROM " . PrDayMeal::tableName() . " pm INNER JOIN _day_meal m ON pm.day_meal_id = m.id WHERE pm.day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        foreach ($result as $val) {
            $arr[] = $val['name'];
        }

        return $arr;
    }

    /**
     * Получаем список элементов питания для дней.
     * @return array
     */
    public static function getArrDayTransfer()
    {
        $arrDayTransfer = App::get()->db->queryAll("SELECT * FROM _day_transfer");

        return ArrayHelpers::sortByStatus($arrDayTransfer);
    }

    /**
     * Получаем список id выбранных элементов питания для дней.
     * @return array
     */
    public function getDayTransfer()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT day_transfer_id FROM " . PrDayTransfer::tableName() . " WHERE day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        foreach ($result as $val) {
            $arr[] = $val['day_transfer_id'];
        }

        return $arr;
    }

    public function getDayTransferInfo()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT t.id, t.name FROM " . PrDayTransfer::tableName() . " pt INNER JOIN _day_transfer t ON pt.day_transfer_id = t.id WHERE pt.day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        return $result;
    }

    /**
     * Получаем список элементов локации для дней.
     * @return array
     */
    public function getDayPoint()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT * FROM " . PrDayPoint::tableName() . " WHERE day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        return $result;
    }

    /**
     * Получаем список элементов активности для дней.
     * @return array
     */
    public function getDayActivity()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT * FROM " . PrDayActivity::tableName() . " WHERE day_id = :day_id",
            ['day_id' => $this->id]);

        if (!$result) {
            return [];
        }

        return $result;
    }
}
