<?php

namespace app\Models\program;

use app\base\Model;

class PrDayMeal extends Model
{
    public $day_id;
    public $day_meal_id;
    public $program_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'day_id',
        'day_meal_id',
        'program_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'day_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_day_meal';
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
