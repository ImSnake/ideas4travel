<?php

namespace app\Models\organizer;

use app\base\Model;

class Company extends Model
{
    public $partner_id;
    public $partner_form_id;
    public $partner_type_id;
    public $name;
    public $rto_number;
    public $inn;
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

    private $arrPartnerType;

    const PARTNER_TYPE_OPERATOR = 1;
    const PARTNER_TYPE_AGENCY = 2;
    const PARTNER_TYPE_ANOTHER = 3;

    const COMPANY_TYPE_SELF_EMPLOYED = 1;
    const COMPANY_TYPE_INDIVIDUAL = 2;
    const COMPANY_TYPE_OOO = 3;
    const COMPANY_TYPE_ANOTHER = 4;

    const ARR_PARTNER_TYPE = [
        self::PARTNER_TYPE_OPERATOR => 'Туроператор',
        self::PARTNER_TYPE_AGENCY => 'Турагенство',
        self::PARTNER_TYPE_ANOTHER => 'Другое',
    ];

    const ARR_COMPANY_TYPE = [
        self::COMPANY_TYPE_SELF_EMPLOYED => 'Самозанятый',
        self::COMPANY_TYPE_INDIVIDUAL => 'Индивидуальный предприниматель',
        self::COMPANY_TYPE_OOO => 'Общество с ограниченной отвественностью',
        self::COMPANY_TYPE_ANOTHER => 'Другое',
    ];

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'partner_id',
        'partner_form_id',
        'partner_type_id',
        'name',
        'rto_number',
        'inn',
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
        return 'companies';
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
