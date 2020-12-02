<?php

namespace app\Models\program;

use app\base\Model;

/**
 * Class PrStatusRejected
 * @package app\Models\program
 */
class PrStatusRejected extends Model
{
    public $create_at;
    public $partner_id;
    public $program_id;
    public $comment;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'create_at',
        'partner_id',
        'program_id',
        'comment',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'program_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_status_rejected';
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
