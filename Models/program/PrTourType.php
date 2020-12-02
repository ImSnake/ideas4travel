<?php

namespace app\Models\program;

use app\base\Model;

class PrTourType extends Model
{
    public $program_id;
    public $type_tour_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'program_id',
        'type_tour_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'program_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_tour_type';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    public function getArrTourType(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }

        return $this->db->queryAll("SELECT * FROM " . static::tableName() . " WHERE program_id = ':program_id'",
            ['program_id' => $program_id]);
    }
}
