<?php

namespace app\Models;

use app\base\Model;
use app\Models\organizer\Company;
use app\Models\organizer\Contact;
use app\Models\organizer\PartnerType;
use app\Models\organizer\Person;

/**
 * Class Partner
 * @package app\Models
 */
class Partner extends Model
{
    const TYPE_NOT_DEFINED = 0;
    const TYPE_COMPANY = 1;
    const TYPE_PERSON = 2;

    const STATUS_NOT_CONFIRM = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_IN_MODERATION = 3;
    const STATUS_REJECTED = 4;
    const STATUS_BLOCKED = 5;
    const STATUS_NAMES = [
        1 => 'Не подтвержден',
        2 => 'Подтвержден',
        3 => 'На модерации',
        4 => 'Отклонен',
        5 => 'Заблокирован',
    ];

    const PARTNER_TYPE_OPERATOR = 1;
    const PARTNER_TYPE_COMPANY = 2;
    const PARTNER_TYPE_AGENCY = 3;
    const PARTNER_TYPE_PERSON = 4;

    const ARR_PARTNER_TYPE = [
        self::PARTNER_TYPE_OPERATOR => 'Туроператор',
        self::PARTNER_TYPE_COMPANY => 'Компания',
        self::PARTNER_TYPE_AGENCY => 'Турагенство',
        self::PARTNER_TYPE_PERSON => 'Частный гид',
    ];

    public $id;
    public $name_profile;
    public $avatar;
    public $partner_entity_id;
    public $status;
    public $confirm_offer;
    public $about;
    public $created_at;
    public $updated_at;
    public $status_at;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'name_profile',
        'avatar',
        'partner_entity_id',
        'status',
        'confirm_offer',
        'about',
        'created_at',
        'updated_at',
        'status_at'
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'partners';
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
     * Получаем объект профайла авторизованного пользователя.
     * @return mixed|null
     */
    public function getProfile()
    {
        if ($this->partner_entity_id == self::TYPE_COMPANY) {
            return $company = (new Company())->getOne($this->id);
        }

        if ($this->partner_entity_id == self::TYPE_PERSON) {
            return $company = (new Person())->getOne($this->id);
        }

        return null;
    }

    public function getContact()
    {
        return (new Contact())->getOne($this->id);
    }

    public function getPartnerType()
    {
        return (new PartnerType())->getOne($this->getProfile()->partner_type_id);
    }
}
