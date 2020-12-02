<?php

namespace app\Models\program;

use app\base\Model;

class PrDayPoint extends Model
{
    public $id;
    public $day_id;
    public $program_id;
    public $name;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'day_id',
        'program_id',
        'name',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_day_points';
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
