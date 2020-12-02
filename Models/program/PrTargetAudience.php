<?php

namespace app\Models\program;

use app\base\Model;

class PrTargetAudience extends Model
{
    public $program_id;
    public $target_audience_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'program_id',
        'target_audience_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'program_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_target_audience';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    public function getArrTargetAudience(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }

        return $this->db->queryAll("SELECT * FROM " . static::tableName() . " WHERE program_id = ':program_id'",
            ['program_id' => $program_id]);
    }
}
