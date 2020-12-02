<?php

namespace app\helpers;

use app\base\App;
use app\Models\program\PrDay;
use app\Models\program\PrDayMeal;
use app\Models\program\PrGeo;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\Models\program\PrTargetAudience;
use app\Models\program\PrTourType;
use app\services\Db;

/**
 * Class ProgramValidate
 * @package app\helpers
 */
class ProgramValidate
{
    // Минимальное количество изображений в фото-архиве.
    const MIN_IMG_IN_GALLERY = 9;

    /** @var Db */
    private $db;
    /** @var Program */
    private $program;
    /** @var array */
    private $errors = [];
    /** @var array */
    private $arrDays = [];
    /** @var array */
    private $arrGeo = [];

    /**
     * ProgramValidate constructor.
     * @param Program $program
     */
    public function __construct(Program $program)
    {
        $this->db = App::get()->db;
        $this->program = $program;
        $this->arrDays = PrDay::find(['program_id' => $this->program->id]);
        $this->arrGeo = $this->getGeo();
    }

    /**
     * Метод выполняет проверку программы на корректное заполнение.
     * @return bool - Если проверка прошла успешно - true, иначе - false.
     */
    public function isValidate(): bool
    {
        // Проверака на совпадение количества дней в описании и количества дней в плане по дням.
        $this->checkNumberOfDays();

        // Проверяем блок Описание у программы на заполненность обязательных полей.
        $this->checkRequiredDescription([
            'name',
            'group_min',
            'group_max',
            'age_min',
            'age_max',
            'duration',
            'meal_id',
            'dynamic_id',
            'comfort_id',
            'about',
        ]);

        // Проверяем поле Тип тура у программы на заполненность.
        $this->checkRequiredTourType();

        // Проверяем поле Целевая аудитория у программы на заполненность.
        $this->checkRequiredTargetAudience();

        // Проверяем корректность заполненнения галереи.
        $this->checkImg();

        // Проверяем корректность заполнения места старта и финиша в описании программы.
        $this->checkGeoStartFinish();

        $this->checkPlanByDays();

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
     * Проверака на совпадение количества дней в описании и количества дней в плане по дням.
     */
    private function checkNumberOfDays()
    {
        if ($this->program->duration != count($this->arrDays)) {
            $this->errors[] = 'длительность программы в Описании не совпадает с количеством дней в Плане по дням';
        }
    }

    /**
     * Метод проверяет блок Описание у программы на заполненность обязательных полей.
     * @param array $columns - массив с ключами полей, которые нужно проверить, например: ['name', 'status']
     */
    private function checkRequiredDescription(array $columns)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                if (property_exists(Program::class, $column)) {
                    if (is_null($this->program->$column)) {
                        $this->errors[] = "поле $column не заполнено";
                    }
                }
            }
        }
    }

    /**
     * Метод проверяет поле Тип тура у программы на заполненность.
     */
    private function checkRequiredTourType()
    {
        if (!PrTourType::find(['program_id' => $this->program->id])) {
            $this->errors[] = "поле Тип тура не заполнено";
        }
    }

    /**
     * Метод проверяет поле Целевая аудитория у программы на заполненность.
     */
    private function checkRequiredTargetAudience()
    {
        if (!PrTargetAudience::find(['program_id' => $this->program->id])) {
            $this->errors[] = "поле Целевая аудитория не заполнено";
        }
    }

    /**
     * Метод проверяет наличие упрограммы заглавного фото, и количество изображений в галереи.
     */
    private function checkImg()
    {
        // Получаем все картинки программы.
        $sql = "SELECT * FROM " . PrImg::tableName() . " WHERE program_id = :program_id";
        $arrayImg = $this->db->queryAll($sql, [':program_id' => $this->program->id]);

        // Инициализируем новый масиив для типов изображений: 0, main, map.
        $arr['0'] = [];
        $arr['main'] = [];
        $arr['map'] = [];

        // Перебираем массив и помещаем элементы в массив по статусам.
        foreach ($arrayImg as $item) {
            if (mb_strtolower($item['type']) == '0') {
                $arr['0'][] = $item;
            } elseif (mb_strtolower($item['type']) == 'main') {
                $arr['main'] = $item;
            } elseif (mb_strtolower($item['type']) == 'map') {
                $arr['map'] = $item;
            }
        }

        if (empty($arr['main'])) {
            $this->errors[] = "отсутствует заглавное фото";
        }

        if (empty($arr['0'])) {
            $this->errors[] = "отсутствуют фото в фото-архиве";
        }

        if (!empty($arr['0']) && count($arr['0']) < self::MIN_IMG_IN_GALLERY) {
            $this->errors[] = "в фото-архиве должно быть не менее " . self::MIN_IMG_IN_GALLERY . " фото";
        }
    }

    /**
     * Метод получает массив geo локаций для текущей программы и на его основе формирует новый массив,
     * с ключами соответствующими geo_id.
     * @return array
     */
    private function getGeo(): array
    {
        // Получаем массив geo локаций для текущей программы.
        $arrGeo = (new PrGeo())->getAllWhere(['program_id' => $this->program->id]);

        /** @var array $newArrGeo */
        $newArrGeo = [];

        // Обходим массив и на его основе создаем новый массив с нужной нам структурой.
        foreach ($arrGeo as $item) {
            $newArrGeo[$item['id']] = [
                'country_id' => $item['country_id'],
                'area_id' => $item['area_id'],
                'city_id' => $item['city_id'],
            ];
        }

        return $newArrGeo;
    }

    /**
     * Метод проверяет корректность заполнения места старта и финиша в описании программы. Должны быть заполнены
     * страна и город. Место финиша проверяется только тогда, когда стоит галочка "место финиша в другом месте".
     */
    private function checkGeoStartFinish()
    {
        $arrGeo = $this->arrGeo;

        if (is_null($arrGeo[$this->program->start]['country_id']) || is_null($arrGeo[$this->program->start]['city_id'])) {
            $this->errors[] = "не корректно заполнено место старта";
        }

        if ($this->program->finish_checkbox == 1) {
            if (is_null($arrGeo[$this->program->finish]['country_id']) || is_null($arrGeo[$this->program->finish]['city_id'])) {
                $this->errors[] = "не корректно заполнено место финиша";
            }
        }
    }

    /**
     * Метод проверяет в Плане по дням корректность заполнения полей: Ночевка, Размещение и Питание.
     */
    private function checkPlanByDays()
    {
        $arrGeo = $this->arrGeo;
        $arrDays = $this->arrDays;

        foreach ($arrDays as $arrDay) {
            // Проверяем корректное заполнение места ночевки.
            if (is_null($arrGeo[$arrDay['geo_id']]['country_id']) && $arrDay['day'] != $this->program->duration) {
                $this->errors[] = "день " . $arrDay['day'] . ": не корректно заполнено место ночевки";
            }

            // Проверяем корректность заполнения Размещения: тип жилья, вместимость номера.
            if ((is_null($arrDay['accommodation_id']) || is_null($arrDay['accommodation_room_id'])) && $arrDay['day'] != $this->program->duration) {
                $this->errors[] = "день " . $arrDay['day'] . ": не корректно заполнено Размещение";
            }

            // Проверяем корректность заполнения Питания.
            if (empty(PrDayMeal::find(['day_id' => $arrDay['id']]))) {
                $this->errors[] = "день " . $arrDay['day'] . ": не корректно заполнено Питание";
            }
        }
    }
}
