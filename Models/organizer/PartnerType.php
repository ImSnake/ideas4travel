<?php

namespace app\Models\organizer;

use app\base\App;
use app\base\Model;
use app\helpers\ArrayHelpers;

/**
 * Class PartnerType
 * @package app\Models\organizer
 */
class PartnerType extends Model
{
    // Это константа берет id для частного гида из таблицы _partner_type.
    const PARTNER_TYPE_PERSON = 4;

    private static $arrPartnerType = null;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_entity_id',
        'name',
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
        return '_partner_type';
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
     * Метод возвращает массив из типов партнеров.
     * @param int $partner_entity_id - Сущность партнера.
     * @return array
     */
    public static function getPartnerTypes(int $partner_entity_id = null): array
    {
        if (!static::$arrPartnerType) {
            if ($partner_entity_id) {
                $where = " WHERE partner_entity_id = :partner_entity_id";
            } else {
                $where = '';
            }

            $result = App::get()->db->queryAll('SELECT * FROM ' . static::tableName() . $where, [':partner_entity_id' => $partner_entity_id]);

            // Сортируем массив по статусу.
            $result = ArrayHelpers::sortByStatus($result, false);

            // Переопределяем полученный массив в формат: [id => name]
            $arr = [];
            foreach($result as $val)
            {
                $arr[$val['id']] = $val['name'];
            }

            static::$arrPartnerType = $arr;
        }

        return static::$arrPartnerType;
    }
}
