<?php

namespace app\helpers;

use app\base\App;
use app\Models\organizer\Company;
use app\Models\organizer\Contact;
use app\Models\organizer\Person;
use app\Models\Partner;
use app\Models\program\PrDay;
use app\Models\program\Program;
use app\services\Db;

/**
 * Class PartnerValidate
 * @package app\helpers
 */
class PartnerValidate
{
    /** @var Db */
    private $db;
    /** @var Partner */
    private $partner;
    /** @var int */
    private $typePartner;
    /** @var array */
    private $errors = [];
    /** @var array */

    /**
     * PartnerValidate constructor.
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->db = App::get()->db;
        $this->partner = $partner;
        $this->typePartner = $partner->partner_entity_id;
    }

    /**
     * Метод выполняет проверку партнера на корректное заполнение.
     * @return bool - Если проверка прошла успешно - true, иначе - false.
     */
    public function isValidate(): bool
    {
        if ($this->typePartner == Partner::TYPE_PERSON) {
            /** @var Person $person */
            $person = (new Person())->getOne(['partner_id' => $this->partner->id]);

            // Выполняем проверку обязательных полей у Person.
            $this->checkRequiredPerson($person,
                [
                    'sex',
                    'first_name',
                    'last_name',
                    'patronymic',
                    'birthday',
                    'reg_country',
                    'reg_index',
                    'reg_city',
                    'reg_address',
                    'fact_country',
                    'fact_index',
                    'fact_city',
                    'fact_address',
                    'person_experience',
                    'tour_experience',
                    'tour_number',
                ]
            );
        }

        if ($this->typePartner == Partner::TYPE_COMPANY) {
            /** @var Company $company */
            $company = (new Company())->getOne(['partner_id' => $this->partner->id]);

            // Для туроператоров проверяем наличие лицензии.
            if ($company->partner_type_id == Partner::PARTNER_TYPE_OPERATOR) {
                $this->checkRtoNumber($company);
            }

            // Выполняем проверку обязательных полей у Company.
            $this->checkRequiredCompany($company,
                [
                    'partner_form_id',
                    'partner_type_id',
                    'name',
                    'inn',
                    'reg_country',
                    'reg_index',
                    'reg_city',
                    'reg_address',
                    'fact_country',
                    'fact_index',
                    'fact_city',
                    'fact_address',
                ]
            );
        }

        // Проверка поля Об организаторе.
        $this->checkAbout();

        // Проверка на заполненость блока контакты.
        $this->checkContact();

        // Если во время проверки возникли ошибки, то возвращае false, иначе true.
        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }

    /**
     * Метод возвращает массив ошибок возникших при проверке программы.
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Метод проверяет блок Чатсный гид на заполненность обязательных полей.
     * @param array $columns - массив с ключами полей, которые нужно проверить, например: ['name', 'status']
     * @param Person $person - объект проверяемого класса.
     */
    private function checkRequiredPerson(Person $person, array $columns)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                if (property_exists(Person::class, $column)) {
                    if (is_null($person->$column) || empty($person->$column)) {
                        $this->errors[] = "Частный гид: поле $column не заполнено";
                    }
                }
            }
        }
    }

    /**
     * Метод проверяет блок Организация на заполненность обязательных полей.
     * @param array $columns - массив с ключами полей, которые нужно проверить, например: ['name', 'status']
     * @param Company $company - объект проверяемого класса.
     */
    private function checkRequiredCompany(Company $company, array $columns)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                if (property_exists(Person::class, $column)) {
                    if (is_null($company->$column) || empty($company->$column)) {
                        $this->errors[] = "Организация: поле $column не заполнено";
                    }
                }
            }
        }
    }

    /**
     * Проверака на совпадение количества дней в описании и количества дней в плане по дням.
     * @param Company $company
     */
    private function checkRtoNumber(Company $company)
    {
        if (!$company->rto_number) {
            $this->errors[] = 'туроператорам необходимо указать номер лицензии';
        }
    }

    /**
     * Проверка на заполнение поля Об организаторе и проверка его длины (не менее 10 знаков).
     */
    private function checkAbout()
    {
        $about = $this->partner->about;

        if (!$about) {
            $this->errors[] = 'необходимо указать информацию об организаторе';
        }

        if ($about && mb_strlen($about) <= 10) {
            $this->errors[] = 'информация об организаторе не может быть меньше 10 знаков';
        }
    }

    /**
     * Проверка на заполненость блока контакты. Минимум 2 контакта, минимум одна сохраненная гиперссылка и
     * минимум один сохраненные котакт.
     */
    private function checkContact()
    {
        /** @var Contact $contact */
        $contact = (new Contact())->getOne(['partner_id' => $this->partner->id]);

        $arrLink = [];
        $elemLink = ['website', 'facebook', 'instagram', 'vkontacte', 'youtube'];
        foreach ($elemLink as $item) {
            if ($contact->$item) {
                $arrLink[] = $contact->$item;
            }
        }

        $arrContact = [];
        $elemContact = ['telegram', 'whatsapp', 'viber', 'skype', 'phone'];
        foreach ($elemContact as $item) {
            if ($contact->$item) {
                $arrContact[] = $contact->$item;
            }
        }

        if (count(array_merge($arrLink, $arrContact)) < 2) {
            $this->errors[] = 'должно быть заполнено минимум два контакта';
        }

        if (count($arrLink) < 1) {
            $this->errors[] = 'должен быть минимум один контакт из: website, facebook, instagram, vkontacte, youtube';
        }

        if (count($arrContact) < 1) {
            $this->errors[] = 'должен быть минимум один контакт из: telegram, whatsapp, viber, skype, phone';
        }
    }
}
