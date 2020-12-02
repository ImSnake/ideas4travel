<?php

namespace app\Models\tour;

use app\base\Model;

/**
 * Class ExtraCost
 * @package app\Models\tour
 */
class ExtraCost extends Model
{
    public $tour_id;
    public $name;
    public $comment;
    public $cost;
    public $currency;
    public $required;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'tour_id',
        'name',
        'comment',
        'cost',
        'currency',
        'required',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'tour_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 't_extra_cost';
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
