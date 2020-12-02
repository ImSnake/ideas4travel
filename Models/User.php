<?php

namespace app\Models;

use app\base\Model;

/**
 * Class User
 * @package app\Models
 */
class User extends Model
{
    // Статусы пользователей.
    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED = 1;

    // Роли пользователей.
    const ROLE_USER = 0;
    const ROLE_MODERATOR = 1;

    public $id;
    public $partner_id;
    public $email;
    public $password_hash;
    public $first_name;
    public $last_name;
    public $phone;
    public $status;
    public $role;
    public $created_at;
    public $updated_at;
    public $created_ip;
    public $confirm_offer;
    public $confirm_agreement;
    public $verification_token;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_id',
        'email',
        'password_hash',
        'first_name',
        'last_name',
        'phone',
        'status',
        'role',
        'created_at',
        'updated_at',
        'created_ip',
        'confirm_offer',
        'confirm_agreement',
        'verification_token',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'p_users';
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
