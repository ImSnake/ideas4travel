<?php

namespace app\Models\tour;

use app\base\Model;

class ExtraCostPreset extends Model
{
    public $tour_id;
    public $extra_cost_preset_id;
    public $comment;
    public $cost;
    public $currency;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'tour_id',
        'extra_cost_preset_id',
        'comment',
        'cost',
        'currency',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'tour_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 't_extra_cost_preset';
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
