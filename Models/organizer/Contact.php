<?php

namespace app\Models\organizer;

use app\base\Model;

class Contact extends Model
{
    public $partner_id;
    public $website;
    public $facebook;
    public $instagram;
    public $vkontacte;
    public $youtube;
    public $telegram;
    public $whatsapp;
    public $viber;
    public $skype;
    public $phone;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'partner_id',
        'website',
        'facebook',
        'instagram',
        'vkontacte',
        'youtube',
        'telegram',
        'whatsapp',
        'viber',
        'skype',
        'phone'
    ];

    // Название первичного ключа.
    protected $primaryKey = 'partner_id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'contacts';
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
