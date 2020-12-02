<?php

namespace app\Models;

use app\base\App;
use app\base\Model;

class User extends Model

{
    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED = 1;

    const TYPE_NOT_DEFINED = 0;
    const TYPE_COMPANY = 1;
    const TYPE_PERSON = 2;

    public $id;
    public $email;
    public $password;
    public $password_repeat;
    public $status;
    public $type;
    public $first_name;
    public $last_name;
    public $phone;
    public $confirm_offer;
    public $confirm_agreement;
    public $created_at;
    public $created_ip;
    public $verification_token;

    private $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = App::get()->db;
    }

    /**
     * Метод возрващает название таблицы с которой работает форма.
     * @return string
     */
    public static function tableName()
    {
        return 'p_users';
    }

    public function getOne($id)
    {
        $table = static::tableName();
        $sql = "select * from " . $table . " where id = :id";
        $std = $this->db->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
        return $std;
    }
}