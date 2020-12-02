<?php

namespace app\forms;

use app\base\FormModel;
use app\Models\User;

class NewPasswordForm extends FormModel
{
    public $password;
    public $password_repeat;

    public $attrErrors = 'new-password';

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
                    'password',
                    'password_repeat',
                ],
                'required'
            ],
            [['password'], 'password'],
            [['password_repeat'], 'password_repeat', 'password'],
        ];
    }

    /**
     * Метод изменяет хэш пароля
     * @param int|null $id
     * @return bool|void
     */
    public function update(?int $id)
    {
        if (is_null($id)) {
            return false;
        }

        $sql = "UPDATE " . DB_P_USERS . " SET password_hash = :password_hash WHERE id = :id";
        $this->db->execute($sql, ['id'=> $id, ':password_hash' => password_hash($this->password, PASSWORD_DEFAULT)]);
    }
}