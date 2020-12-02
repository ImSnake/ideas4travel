<?php

namespace app\controllers\organizer;

use app\base\App;
use app\controllers\Controller;
use app\forms\ChooseTypeForm;
use app\forms\NewPasswordForm;
use app\helpers\HtmlHelpers;
use app\Models\organizer\Company;
use app\Models\organizer\Contact;
use app\Models\organizer\Person;
use app\Models\Partner;
use app\services\Request;

/**
 * Class OrganizerController
 * @package app\controllers\organizer
 */
class OrganizerController extends Controller
{
    /**
     * @inheritDoc
     */
    protected function behavior()
    {
        parent::behavior();
        // Если пользователь НЕ авторизован перенаправляем его на главную страницу.
        if (!$this->auth->getUserId()) {
            $this->go();
        }
    }

    /**
     * URL: /organizer
     */
    public function actionIndex()
    {
        echo $this->render('organizer/index');
    }

    /**
     * URL: /organizer/about-edit
     */
    public function actionAboutEdit()
    {
        $profile = ((new Partner())->getOne($this->partner->id));

        // Если форма была отправлена.
        if (isset($_POST['about']['submit-about'])) {
            // Получаем данные, чистим и присваиваем.
            $profile->about = HtmlHelpers::cleanText($_POST['about']['about']);

            // Сохраняем полученные данные в базе.
            $profile->update();

            // Редирект.
            $this->go('organizer');
        }

        echo $this->render('organizer/about-edit', ['about' => $profile->about]);
    }

    /**
     * URL: /organizer/contact-edit
     */
    public function actionContactEdit()
    {
        /* @var $form Contact */
        $form = ((new Partner())->getOne($this->partner->id))->getContact();

        // Проверяем была ли отправлена форма.
        if (isset($_POST['contact']['submit-contact'])) {
            // Получаем данные, чистим и присваиваем.
            $form->website = Request::getPostForm($_POST['contact']['website'], null, null);
            $form->facebook = Request::getPostForm($_POST['contact']['facebook'], null, null);
            $form->instagram = Request::getPostForm($_POST['contact']['instagram'], null, null);
            $form->vkontacte = Request::getPostForm($_POST['contact']['vkontacte'], null, null);
            $form->youtube = Request::getPostForm($_POST['contact']['youtube'], null, null);
            $form->telegram = Request::getPostForm($_POST['contact']['telegram'], null, null);
            $form->whatsapp = Request::getPostForm($_POST['contact']['whatsapp'], null, null);
            $form->viber = Request::getPostForm($_POST['contact']['viber'], null, null);
            $form->skype = Request::getPostForm($_POST['contact']['skype'], null, null);
            $form->phone = Request::getPostForm($_POST['contact']['phone'], null, null);

            // Сохраняем полученные данные в базе.
            $form->update();

            // Редирект.
            $this->go('organizer');
        }

        echo $this->render('organizer/contact-edit', ['form' => $form]);
    }

    public function actionCompanyEdit()
    {
        // Получаем массив всех городов отсортированных по имени.
        $sql = "SELECT name, id FROM pb_country GROUP BY name";
        $countriesArr = App::get()->db_geo->queryAll($sql);

        /** @var Partner $partner */
        $partner = App::get()->auth->getPartner();

        /* @var $form Company */
        $form = $partner->getProfile();

        if (isset($_POST['company']['submit-company'])) {
            // Получаем данные, чистим и присваиваем.
            $form->partner_form_id = Request::getPostForm($_POST['company']['partner_form_id'], $form->partner_form_id);
            $form->partner_type_id = Request::getPostForm($_POST['company']['partner_type_id'], $form->partner_type_id);
            $form->name = Request::getPostForm($_POST['company']['name'], $form->name);
            $form->rto_number = Request::getPostForm($_POST['company']['rto_number'], $form->rto_number, null);
            $form->inn = Request::getPostForm($_POST['company']['inn'], $form->inn);
            $form->reg_index = Request::getPostForm($_POST['company']['reg_index'], $form->reg_index);
            $form->reg_country = Request::getPostForm($_POST['company']['reg_country'], $form->reg_country);
            $form->reg_area = Request::getPostForm($_POST['company']['reg_area'], $form->reg_area);
            $form->reg_city = Request::getPostForm($_POST['company']['reg_city'], $form->reg_city);
            $form->reg_city_name = Request::getPostForm($_POST['company']['reg_city_name'], '');
            if (empty($form->reg_city_name)) {
                $form->reg_area = 0;
                $form->reg_city = 0;
            }
            $form->reg_address = Request::getPostForm($_POST['company']['reg_address'], $form->reg_address);
            $form->fact_match = Request::getPostForm($_POST['company']['fact_match'], 'off');
            if ($form->fact_match == 'on') {
                $form->fact_index = Request::getPostForm($_POST['company']['reg_index'], $form->fact_index);
                $form->fact_country = Request::getPostForm($_POST['company']['reg_country'], $form->fact_country);
                $form->fact_area = Request::getPostForm($_POST['company']['reg_area'], $form->fact_area);
                $form->fact_city = Request::getPostForm($_POST['company']['reg_city'], $form->fact_city);
                $form->fact_city_name = Request::getPostForm($_POST['company']['reg_city_name'], '');
                $form->fact_address = Request::getPostForm($_POST['company']['reg_address'], $form->fact_address);
            } else {
                $form->fact_index = Request::getPostForm($_POST['company']['fact_index'], $form->fact_index);
                $form->fact_country = Request::getPostForm($_POST['company']['fact_country'], $form->fact_country);
                $form->fact_area = Request::getPostForm($_POST['company']['fact_area'], $form->fact_area);
                $form->fact_city = Request::getPostForm($_POST['company']['fact_city'], $form->fact_city);
                $form->fact_city_name = Request::getPostForm($_POST['company']['fact_city_name'], '');
                $form->fact_address = Request::getPostForm($_POST['company']['fact_address'], $form->fact_address);
            }
            if (empty($form->fact_city_name)) {
                $form->fact_area = 0;
                $form->fact_city = 0;
            }
            $form->phone = Request::getPostForm($_POST['company']['phone'], $form->phone);
            $form->email = Request::getPostForm($_POST['company']['email'], $form->email);

            // Сохраняем полученные данные в базе.
            $form->update();

            // Редирект.
            $this->go('organizer');
        }

        echo $this->render('organizer/company-edit',
            ['form' => $form, 'partner' => $partner, 'countriesArr' => $countriesArr]);
    }

    /**
     * URL: /organizer/person-edit
     */
    public function actionPersonEdit()
    {
        // Получаем массив всех городов.
        $sql = "SELECT name, id FROM pb_country GROUP BY name";
        $countriesArr = App::get()->db_geo->queryAll($sql);

        /* @var $form Person */
        $form = ((new Partner())->getOne($this->partner->id))->getProfile();

        if (isset($_POST['person']['submit-person'])) {
            // Получаем данные, чистим и присваиваем.
            $form->partner_form_id = 8;
            $form->partner_type_id = Partner::PARTNER_TYPE_PERSON;
            $form->first_name = Request::getPostForm($_POST['person']['first_name'], $form->first_name);
            $form->last_name = Request::getPostForm($_POST['person']['last_name'], $form->last_name);
            $form->patronymic = Request::getPostForm($_POST['person']['patronymic'], $form->patronymic);
            $form->birthday = Request::getPostForm($_POST['person']['birthday'], $form->birthday);
            $form->sex = Request::getPostForm($_POST['person']['sex'], $form->sex);
            $form->person_experience = Request::getPostForm($_POST['person']['person_experience'],
                $form->person_experience, 0);
            $form->tour_experience = Request::getPostForm($_POST['person']['tour_experience'], $form->tour_experience,
                0);
            $form->tour_number = Request::getPostForm($_POST['person']['tour_number'], $form->tour_number, 0);
            $form->reg_index = Request::getPostForm($_POST['person']['reg_index'], $form->reg_index);
            $form->reg_country = Request::getPostForm($_POST['person']['reg_country'], $form->reg_country);
            $form->reg_area = Request::getPostForm($_POST['person']['reg_area'], $form->reg_area);
            $form->reg_city = Request::getPostForm($_POST['person']['reg_city'], $form->reg_city);
            $form->reg_city_name = Request::getPostForm($_POST['person']['reg_city_name'], '');
            if (empty($form->reg_city_name)) {
                $form->reg_area = 0;
                $form->reg_city = 0;
            }
            $form->reg_address = Request::getPostForm($_POST['person']['reg_address'], $form->reg_address);
            $form->fact_match = Request::getPostForm($_POST['person']['fact_match'], 'off');
            if ($form->fact_match == 'on') {
                $form->fact_index = Request::getPostForm($_POST['person']['reg_index'], $form->fact_index);
                $form->fact_country = Request::getPostForm($_POST['person']['reg_country'], $form->fact_country);
                $form->fact_area = Request::getPostForm($_POST['person']['reg_area'], $form->fact_area);
                $form->fact_city = Request::getPostForm($_POST['person']['reg_city'], $form->fact_city);
                $form->fact_city_name = Request::getPostForm($_POST['person']['reg_city_name'], '');
                $form->fact_address = Request::getPostForm($_POST['person']['reg_address'], $form->fact_address);
            } else {
                $form->fact_index = Request::getPostForm($_POST['person']['fact_index'], $form->fact_index);
                $form->fact_country = Request::getPostForm($_POST['person']['fact_country'], $form->fact_country);
                $form->fact_area = Request::getPostForm($_POST['person']['fact_area'], $form->fact_area);
                $form->fact_city = Request::getPostForm($_POST['person']['fact_city'], $form->fact_city);
                $form->fact_city_name = Request::getPostForm($_POST['person']['fact_city_name'], '');
                $form->fact_address = Request::getPostForm($_POST['person']['fact_address'], $form->fact_address);
            }
            if (empty($form->fact_city_name)) {
                $form->fact_area = 0;
                $form->fact_city = 0;
            }

            // Сохраняем полученные данные в базе.
            $form->update();

            // Редирект.
            $this->go('organizer');
        }

        echo $this->render('organizer/person-edit', ['form' => $form, 'countriesArr' => $countriesArr]);
    }

    /**
     * URL: /organizer/choose-type
     */
    public function actionChooseType()
    {
        // Если пользователь авторизован и у него выбран тип профил, то перенаправляем его на главную страницу.
        if (($this->user && $this->partner) || !$this->user) {
            $this->go();
        }

        // Создаем экземпляр класса формы и заполняем его данными.
        $form = new ChooseTypeForm();

        // Если форма была отправлена.
        if (isset($_POST['type']['submit_type'])) {
            $form->name = $_POST['type']['name'];
            $form->type = $_POST['type']['type'];
            $form->confirm_offer = $_POST['type']['confirm_offer'];

            if ($form->validate()) {
                // Обновляем данные в базе.
                $form->chooseType();

                // Перенаправляем на главную страницу
                $this->go();
            } else {
                echo $this->render('organizer/choose-type-form', ['form' => $form]);
            }
        } else {
            echo $this->render('organizer/choose-type-form', ['form' => $form]);
        }
    }

    /**
     * URL: /organizer/new-password
     */
    public function actionNewPassword()
    {
        $errors = null;

        if (isset($_POST['new-password']['submit'])) {
            $old_password = trim($_POST['new-password']['old_password']);
            $password = trim($_POST['new-password']['password']);
            $repeat_password = trim($_POST['new-password']['password_repeat']);

            // Проверяем верно ли пользователь ввел старый пароль.
            $sql = 'SELECT password_hash, id FROM ' . DB_P_USERS . ' WHERE id = :id';
            $result = $this->db->queryOne($sql, [':id' => $this->user->id]);
            $password_hash = $result['password_hash'];

            if ($password_hash) {
                if (password_verify($old_password, $password_hash)) {
                    $form = new NewPasswordForm();
                    $form->password = $password;
                    $form->password_repeat = $repeat_password;

                    if ($form->validate()) {
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "UPDATE " . DB_P_USERS . " SET password_hash = :password_hash WHERE id = :id";
                        $this->db->execute($sql, [':password_hash' => $password_hash, ':id' => $this->user->id]);

                        echo $this->render('organizer/new-password', ['errors' => $errors, 'true' => false]);

                        // Удаляем страницу с которой перешли на смену пароля.
                        unset($_SESSION['HTTP_REFERER_NEW_PASSWORD']);
                    } else {
                        $errors = $form->errors['new-password'];
                        echo $this->render('organizer/new-password', ['errors' => $errors, 'true' => true]);
                    }
                } else {
                    $errors['old_password'] = 'старый пароль указан не верно';
                    echo $this->render('organizer/new-password', ['errors' => $errors, 'true' => true]);
                }
            } else {
                $errors['old_password'] = 'старый пароль не указан';
                echo $this->render('organizer/new-password', ['errors' => $errors, 'true' => true]);
            }
        } else {
            // Страница с которой перешли на смену пароля.
            $_SESSION['HTTP_REFERER_NEW_PASSWORD'] = $_SERVER['HTTP_REFERER'];

            echo $this->render('organizer/new-password', ['errors' => $errors, 'true' => true]);
        }


    }
}
