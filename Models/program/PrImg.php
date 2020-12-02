<?php

namespace app\Models\program;

use app\base\Model;

class PrImg extends Model
{
    public $id;
    public $partner_id;
    public $program_id;
    public $img;
    public $description;
    public $type;
    public $deleted;
    public $created_at;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_id',
        'program_id',
        'img',
        'description',
        'type',
        'deleted',
        'created_at',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_img';
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
