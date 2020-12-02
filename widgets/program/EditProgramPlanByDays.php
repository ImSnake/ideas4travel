<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrCountry;
use app\Models\program\PrDay;
use app\Models\program\PrGeo;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\services\Geo;

class EditProgramPlanByDays extends Widget
{
    public function run()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;

        // Получаем из url ID программы
        $program_id = App::get()->request->getUrlParams()['id'];

        /** @var Program $program */
        $program = (new Program())->getOne($program_id);


        // Получаем массив объектов всех дней программы.
        $arrAllDays = $program->getAllDays();

        // Массив для данных по дням.
        $days = [];

        // Массив для списка выбранного питания.
        $dayMeal = [];

        // Если дней в программе еще нет, до добавляем в массив два пустых значения.
        if (empty($arrAllDays)) {
            array_push($arrAllDays, new PrDay(), new PrDay());
            $arrAllDays[0]->day = 1;
            $arrAllDays[1]->day = 2;
        }

        for ($i = 0; $i < count($arrAllDays); $i++) {
            /** @var PrDay $day */
            $day = $arrAllDays[$i];
            $days[$day->day]['id'] = $day->id;
            $days[$day->day]['program_id'] = $day->program_id;
            $days[$day->day]['day'] = $day->day;
            $days[$day->day]['geo_id'] = $day->geo_id;
            $days[$day->day]['accommodation_id'] = $day->accommodation_id;
            $days[$day->day]['accommodation_room_id'] = $day->accommodation_room_id;
            $days[$day->day]['description'] = $day->description;
            $days[$day->day]['distance'] = $day->distance;
            $days[$day->day]['img_id'] = $day->img_id;
            $days[$day->day]['day_place_checkbox'] = $day->day_place_checkbox;
            $days[$day->day]['accommodation_checkbox'] = $day->accommodation_checkbox;
            $days[$day->day]['meal_checkbox'] = $day->meal_checkbox;
            $days[$day->day]['transfer_checkbox'] = $day->transfer_checkbox;

            /** @var PrGeo $days [$day->day]['geo'] */
            $days[$day->day]['geo'] = $day->geo_id ? (new PrGeo())->getOne($day->geo_id) : new PrGeo();

            // Получаем список выбранного питания для дня.
            $dayMeal[$day->day] = $day->getDayMeal();

            // Получаем список выбранного трансфера для дня.
            $dayTransfer[$day->day] = $day->getDayTransfer();

            // Получаем список локации для дня.
            $dayPoint[$day->day] = $day->getDayPoint();

            // Получаем список активности для дня.
            $dayActivity[$day->day] = $day->getDayActivity();

            // Получаем имя файла фотографии дня.
            $dayImg[$day->day] = (new PrImg())->getOne($day->img_id)->img;
        }

        // Получаем список элементов размещения для дней.
        $arrAccommodation = PrDay::getArrAccommodation();

        // Получаем список элементов типов комнат размещения для дней.
        $arrAccommodationRoom = PrDay::getArrAccommodationRoom();

        // Получаем список элементов питания для дней.
        $arrDayMeal = PrDay::getArrDayMeal();

        // Получаем список элементов питания для дней.
        $arrDayTransfer = PrDay::getArrDayTransfer();

        // Получаем список стран для программы.
        $arrCountry = (new PrCountry())->getArrCountries($program_id);

        // Получаем все остальные фото.
        $allImg = (new PrImg())->getAllWhere([
            'partner_id' => $program->partner_id,
            'program_id' => $program_id,
            'type' => 0,
            'deleted' => 0
        ]);
        $arrImg = [];
        if ($allImg) {
            foreach ($allImg as $img) {
                $arrImg[] = $img['img'];
            }
            $imgString = implode($arrImg, ',');
        } else {
            $imgString = '';
        }

        echo $this->render('program/views/form_plan_by_days',
            [
                'geo' => $geo,
                'program' => $program,
                'days' => $days,
                'arrAccommodation' => $arrAccommodation,
                'arrAccommodationRoom' => $arrAccommodationRoom,
                'arrDayMeal' => $arrDayMeal,
                'dayMeal' => $dayMeal,
                'arrDayTransfer' => $arrDayTransfer,
                'dayTransfer' => $dayTransfer,
                'dayPoint' => $dayPoint,
                'dayActivity' => $dayActivity,
                'dayImg' => $dayImg,
                'arrCountry' => $arrCountry,
                'imgString' => $imgString,
            ]
        );
    }
}
