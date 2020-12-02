<?php

namespace app\Models\program;

use app\base\Model;

class PrCountry extends Model
{
    public $program_id;
    public $country_id;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'program_id',
        'country_id',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'program_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'pr_countries';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    public function getArrCountriesId($program_id)
    {
        $sql = "SELECT country_id FROM " . static::tableName() . " WHERE program_id = :program_id";
        return $this->db->queryAll($sql, [':program_id' => $program_id]);
    }

    public function getArrCountries($program_id)
    {
        $sql = "SELECT pb_c.id, pb_c.name FROM " . static::tableName() . " pr_c RIGHT JOIN pb_country pb_c ON pr_c.country_id = pb_c.id WHERE pr_c.program_id = :program_id";
        return $this->db->queryAll($sql, [':program_id' => $program_id]);
    }
}
