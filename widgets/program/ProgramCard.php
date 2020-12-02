<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\helpers\MailHelpers;
use app\helpers\ProgramValidate;
use app\helpers\TourStatus;
use app\Models\Partner;
use app\Models\program\PrCountry;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\Models\program\PrStatusRejected;
use app\Models\tour\Tour;
use app\Models\User;
use app\services\Geo;
use ReflectionException;

class ProgramCard extends Widget
{
    /**
     * @throws ReflectionException
     */
    public function run()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;
        /** @var User $user */
        $user = App::get()->auth->getUser();

        // Получаем массив городов.
        $countriesArr = $geo->getCountry();

        /** @var Program $program - Получаем объект текущей программы */
        $program = $this->params[0];

        // Проверяем нужно ли выполнять проверку на заполненность программы.
        if ($program->update_at > $program->validate_at) {
            // Выполняем проверку.
            $programValidate = new ProgramValidate($program);

            // Если проверка прошла, меняем статус.
            if ($programValidate->isValidate()) {
                if ($program->status == Program::STATUS_DRAFT) {
                    $program->status = Program::STATUS_COMPLETED;
                    $program->status_at = date('Y-m-d H:i:s', time());
                }
            } else {
                if (in_array($program->status, [Program::STATUS_PUBLISHED, Program::STATUS_UNPUBLISHED])) {
                    $program->status = Program::STATUS_REJECTED;
                    $program->status_at = date('Y-m-d H:i:s', time());
                    // Партнеру отправляетс письмо что программа октлонена и список ошибок.
                    MailHelpers::sendEmailToPartnerProgramRejectValidate($user, $program,
                        $programValidate->getErrors());
                    // Опубликованные и неопубликованные туры переходят в статус На модерации.
                    TourStatus::changeStatusOfTour($program, Tour::STATUS_PUBLISHED, Tour::STATUS_IN_MODERATION);
                    TourStatus::changeStatusOfTour($program, Tour::STATUS_UNPUBLISHED, Tour::STATUS_IN_MODERATION);
                    // В таблицу pr_status_rejected заносим причину отклонения (список ошибок валидации).
                    $prStatusRejected = new PrStatusRejected();
                    $prStatusRejected->partner_id = $program->partner_id;
                    $prStatusRejected->program_id = $program->id;
                    $prStatusRejected->create_at = date('Y-m-d H:i:s', time());
                    $prStatusRejected->comment = "Программа отклонена по следующей причине:" . PHP_EOL;
                    foreach ($programValidate->getErrors() as $error) {
                        $prStatusRejected->comment .= $error . PHP_EOL;
                    }
                    $prStatusRejected->insert();
                } elseif ($program->status == Program::STATUS_COMPLETED) {
                    $program->status = Program::STATUS_DRAFT;
                    $program->status_at = date('Y-m-d H:i:s', time());
                }
            }

            // Обновляем дату проверки программы.
            $program->validate_at = date('Y-m-d H:i:s', time());
            // Сохраняем изменения.
            $program->update();
        }

        // Получаем id всех стран программы.
        $arrCountryProgram = (new PrCountry())->getArrCountriesId($program->id);
        // Получаем массив из id.
        $arrCountryId = [];
        foreach ($arrCountryProgram as $val) {
            $arrCountryId[] = $val['country_id'];
        }

        // Получаем названия стран.
        $countryName = [];
        foreach ($countriesArr as $val) {
            if (in_array($val['id'], $arrCountryId)) {
                $countryName[] = $val['name'];
            }
        }

        // Получаем комфорт.
        $comfort = 0;
        foreach (Program::getArrComfort() as $key => $val) {
            if ($val['id'] == $program->comfort_id) {
                $comfort = $val['value'];
            }
        }

        // Получаем динамику.
        $dynamic = 0;
        foreach (Program::getArrDynamic() as $key => $val) {
            if ($val['id'] == $program->dynamic_id) {
                $dynamic = $val['value'];
            }
        }

        // Получаем питание.
        $meal = 0;
        foreach (Program::getArrMeals() as $key => $val) {
            if ($val['id'] == $program->meal_id) {
                $meal = $val['value'];
            }
        }

        // Получаем заглавное фото.
        $mainImg = (new PrImg())->getOne([
            'partner_id' => $program->partner_id,
            'program_id' => $program->id,
            'type' => 'main',
            'deleted' => 0
        ]);

        echo $this->render('program/views/card',
            [
                'program' => $program,
                'countryName' => implode(', ', $countryName),
                'comfort' => $comfort,
                'dynamic' => $dynamic,
                'meal' => $meal,
                'mainImg' => $mainImg
            ]
        );
    }
}
