<?php


namespace app\Models\tour;


use app\base\Model;

class TourPublishedLog extends Model
{
    public $id;
    public $tour_id;
    public $program_id;
    public $partner_id;
    public $started_at;
    public $finished_at;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'tour_id',
        'program_id',
        'partner_id',
        'started_at',
        'finished_at',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 't_published_log';
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
