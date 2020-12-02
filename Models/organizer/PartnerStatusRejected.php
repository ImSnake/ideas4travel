<?php

namespace app\Models\organizer;

use app\base\Model;

/**
 * Class PartnerStatusRejected
 * @package app\Models\organizer
 */
class PartnerStatusRejected extends Model
{
    public $create_at;
    public $partner_id;
    public $comment;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'create_at',
        'partner_id',
        'comment',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'partner_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'p_status_rejected';
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
