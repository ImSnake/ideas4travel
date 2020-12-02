<?php

namespace app\Models\program;

use app\base\Model;

class PrVideos extends Model
{
    public $id;
    public $video;
    public $partner_id;
    public $program_id;
    public $url;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'video',
        'partner_id',
        'program_id',
        'url',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_videos';
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
