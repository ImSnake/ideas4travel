<?php

namespace app\forms;

use app\base\FormModel;
use app\Models\User;

/**
 * Class SignupForm
 * @package app\forms
 */
class SignupForm extends FormModel
{
    public $id;
    public $email;
    public $password;
    public $password_repeat;
    public $status;
    public $type;
    public $first_name;
    public $last_name;
    public $phone;
    public $confirm_agreement;
    public $created_at;
    public $created_ip;
    public $verification_token;

    public $attrErrors = 'signup';

    /**
     * Метод возрващает название таблицы с которой работает форма.
     * @return string
     */
    public static function tableName()
    {
        return 'p_users';
    }

    /**
     * Правила валидации.
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'first_name',
                    'last_name',
                    'email',
                    'phone',
                    'password',
                    'password_repeat',
//                    'confirm_offer',
                    'confirm_agreement'
                ],
                'required'
            ],
            [['email'], 'email'],
            [['email'], 'unique', self::tableName()],
            [['password'], 'password'],
            [['password_repeat'], 'password_repeat', 'password'],
            [['first_name', 'last_name'], 'length', ['max' => 64]],
            [['phone'], 'length', ['max' => 20]],
        ];
    }

    /**
     * Метод добавляет новые данные зарегистрированного пользователя.
     */
    public function insert()
    {
        $sql = "INSERT INTO " . DB_P_USERS . " SET 
        email = :email, 
        password_hash = :password_hash, 
        first_name = :first_name, 
        last_name = :last_name, 
        phone = :phone, 
        created_at = NOW(), 
        created_ip = :created_ip,
        verification_token = :verification_token
        ";

        $this->db->execute($sql, [
            ':email' => $this->email,
            ':password_hash' => password_hash($this->password, PASSWORD_DEFAULT),
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':phone' => $this->phone,
            ':created_ip' => $this->created_ip,
            ':verification_token' => $this->verification_token
        ]);
    }

    /**
     * Метод проверяет, есть ли verification_token в базе. Если да, то изменяет статус пользователя на подтвержденный.
     * @param $token
     * @return bool
     */
    public function isVerificationToken($token)
    {
        // Проверяем на уникальность.
        $sql = "SELECT id FROM " . DB_P_USERS . " WHERE verification_token = :verification_token";

        // Если значение аргумента уже существует, то выводим ошибку.
        if ($result = $this->db->queryOne($sql, [':verification_token' => $token])) {
            $sql = "UPDATE " . DB_P_USERS . " SET status = " . User::STATUS_CONFIRMED . ", verification_token = '' WHERE id = {$result['id']}";
            $this->db->execute($sql);

            return true;
        }

        return false;
    }
}
