<?php

namespace app\Models\organizer;

use app\base\Model;

class Person extends Model
{
    public $partner_id;
    public $partner_form_id;
    public $partner_type_id;
    public $first_name;
    public $last_name;
    public $patronymic;
    public $birthday;
    public $sex;
    public $person_experience;
    public $tour_experience;
    public $tour_number;
    public $reg_index;
    public $reg_country;
    public $reg_area;
    public $reg_city;
    public $reg_city_name;
    public $reg_address;
    public $fact_match;
    public $fact_index;
    public $fact_country;
    public $fact_area;
    public $fact_city;
    public $fact_city_name;
    public $fact_address;
    public $phone;
    public $email;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'partner_id',
        'partner_form_id',
        'partner_type_id',
        'first_name',
        'last_name',
        'patronymic',
        'birthday',
        'sex',
        'person_experience',
        'tour_experience',
        'tour_number',
        'reg_index',
        'reg_country',
        'reg_area',
        'reg_city',
        'reg_address',
        'fact_match',
        'fact_index',
        'fact_country',
        'fact_area',
        'fact_city',
        'fact_address',
        'phone',
        'email',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'partner_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'persons';
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
