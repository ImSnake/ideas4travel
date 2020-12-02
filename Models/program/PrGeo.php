<?php

namespace app\Models\program;

use app\base\Model;

class PrGeo extends Model
{
    public $id;
    public $program_id;
    public $country_id;
    public $area_id;
    public $city_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'program_id',
        'country_id',
        'area_id',
        'city_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_geo';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }
}
