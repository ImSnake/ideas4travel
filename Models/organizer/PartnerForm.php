<?php

namespace app\Models\organizer;

use app\base\App;
use app\base\Model;
use app\helpers\ArrayHelpers;

/**
 * Class PartnerForm
 * @package app\Models\organizer
 */
class PartnerForm extends Model
{
    private static $arrPartnerForm = null;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_entity_id',
        'form',
        'abbr',
        'status'
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return '_partner_form';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    /**
     * Метод возвращает массив из типов компаний для выбранной сущности партнера.
     * @param $partner_entity_id int - Сущность партнера.
     * @return array
     */
    public static function getPartnerForm($partner_entity_id): array
    {
        if (!static::$arrPartnerForm) {
            $sql = 'SELECT * FROM ' . static::tableName() . ' WHERE partner_entity_id = :partner_entity_id';
            $result = App::get()->db->queryAll($sql, [':partner_entity_id' => $partner_entity_id]);

            // Сортируем массив по статусу.
            $result = ArrayHelpers::sortByStatus($result, false);

            // Переопределяем полученный массив в формат: [id => name]
            $arr = [];
            foreach($result as $val)
            {
                $arr[$val['id']]['form'] = $val['form'];
                $arr[$val['id']]['abbr'] = $val['abbr'];
            }

            static::$arrPartnerForm = $arr;
        }

        return static::$arrPartnerForm;
    }
}