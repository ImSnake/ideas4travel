<?php

namespace app\forms;

use app\base\App;
use app\base\FormModel;
use app\Models\organizer\Company;
use app\Models\organizer\Contact;
use app\Models\organizer\PartnerType;
use app\Models\organizer\Person;
use app\Models\Partner;
use app\Models\User;

/**
 * Class ChooseTypeForm
 * @package app\forms
 */
class ChooseTypeForm extends FormModel
{
    public $type;
    public $name;
    public $confirm_offer;

    public $attrErrors = 'type';

    /**
     * Правила валидации.
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'type', 'confirm_offer'], 'required'],
        ];
    }

    /**
     * Метод задает тип партнера на выбранный и добавляет название.
     */
    public function chooseType()
    {
        // Опредляем тип партнера.
        if ($this->type == 'company') {
            $type_db = Partner::TYPE_COMPANY;
            $partner_type_db = 0;
        } elseif ($this->type == 'person') {
            $type_db = Partner::TYPE_PERSON;
            $partner_type_db = PartnerType::PARTNER_TYPE_PERSON;
        } else {
            $type_db = Partner::TYPE_NOT_DEFINED;
            $partner_type_db = 0;
        }

        // Добавляем в базу нового партнера с заданным типом.
        $sql_insert = "INSERT INTO " . Partner::tableName() . " SET
        partner_entity_id = :partner_entity_id,
        name_profile = :name_profile,
        status = :status,
        created_at = NOW(),
        updated_at = NOW()
        ";

        $this->db->execute($sql_insert, [
            ':partner_entity_id' => $type_db,
            ':name_profile' => $this->name,
            ':status' => Partner::STATUS_NOT_CONFIRM
        ]);

        // Получаем id только что созданного партнера.
        $new_partner_id = $this->db->lastInsertId();

        // Присваиваем пользователю id только что созданного партнера.
        $sql_update = "UPDATE " . User::tableName() . " SET 
        partner_id = :partner_id,
        status = :status,
        updated_at = NOW()
        WHERE id = " . App::get()->auth->getUserId() . "
        ";

        $this->db->execute($sql_update, [
            ':status' => User::STATUS_CONFIRMED,
            ':partner_id' => $new_partner_id
        ]);

        // Вставляем строку в таблицу профиля партнера в зависимости от типа.
        if ($this->type == 'company') {

            $company = new Company();
            $company->partner_id = $new_partner_id;
            $company->insert();
        } elseif ($this->type == 'person') {
            $person = new Person();
            $person->partner_id = $new_partner_id;
            $person->insert();
        }

        // Вставляем строку в таблицу контакты для только что созданного партнера.
        $contact = new Contact();
        $contact->partner_id = $new_partner_id;
        $contact->insert();

        // Создаем директорию для изображений для вновь созданного партнера.
        if(!is_dir(IMG_DIR."/tours/".$new_partner_id)) {
            mkdir(IMG_DIR."/tours/".$new_partner_id, 0755);
        }
    }
}
