<?php

namespace app\Models\program;

use app\base\Model;

class PrFilter extends Model
{
    public $program_id;
    public $partner_id;
    public $filter_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'program_id',
        'partner_id',
        'filter_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'program_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_filter';
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