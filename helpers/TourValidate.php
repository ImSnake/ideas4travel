<?php

namespace app\helpers;

use app\base\App;
use app\Models\tour\ExtraCost;
use app\Models\tour\ExtraCostPreset;
use app\Models\tour\Tour;
use app\services\Db;

class TourValidate
{
    /** @var Db */
    private $db;
    /** @var Tour */
    private $tour;
    /** @var array */
    private $errors = [];

    /**
     * TourValidate constructor.
     * @param Tour $tour
     */
    public function __construct(Tour $tour)
    {
        $this->db = App::get()->db;
        $this->tour = $tour;
    }

    /**
     * Метод выполняет проверку программы на корректное заполнение.
     * @return bool - Если проверка прошла успешно - true, иначе - false.
     */
    public function isValidate(): bool
    {
        // Проверяем блок Описание у программы на заполненность обязательных полей.
        $this->checkRequiredTour([
            'start_at',
            't_status_id',
            't_season_id',
        ]);

        // Проверяем поле Стоимость.
        $this->checkPrice();

        // Проверяем поле Погода от и до
        $this->checkTemp();

        // Проверяем поле Свободно.
        $this->checkAvailable();

        // Проверяем поле Установить скидку.
        $this->checkDiscount();

        // Проверяем поле Предоплата.
        $this->checkPrepayment();

        // Проверяем поле Прием заявок.
        $this->checkBookingUntil();

        // Проверяем поле Оплата участия.
        $this->checkPayUntil();

        // Проверяем предопределенные обязательные затраты..
        $this->checkExtraCostPreset();

        // Проверяем добаленные позиции обзятальных затрат и дополнительных затрат.
        $this->checkExtraCostRequiredAndAdditional();

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
     * Метод проверяет тур (данные для таблицы tours) на заполненность обязательных полей.
     * @param array $columns - массив с ключами полей, которые нужно проверить, например: ['name', 'status']
     */
    private function checkRequiredTour(array $columns)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                if (property_exists(Tour::class, $column)) {
                    if (is_null($this->tour->$column)) {
                        $this->errors[] = "поле $column не заполнено";
                    }
                }
            }
        }
    }

    /**
     * Проверака Стоимости тура.
     */
    private function checkPrice()
    {
        if (!is_null($this->tour->price) && $this->tour->price < 1) {
            $this->errors[] = 'стоимость тура не может быть меньше 1';
        }

        if (is_null($this->tour->currency)) {
            $this->errors[] = 'должна быть указана стоимость тура';
        }

        if (is_null($this->tour->currency)) {
            $this->errors[] = 'у стоимости тура должна быть указана валюта';
        }
    }

    /**
     * Проверяем Погоду от и до.
     */
    private function checkTemp()
    {
        if (!is_null($this->tour->temp_max) && !is_null($this->tour->temp_min) && ($this->tour->temp_min > $this->tour->temp_max)) {
            $this->errors[] = 'минимальная температура не может быть больше максимальной';
        }

        if (!is_null($this->tour->temp_min) && ($this->tour->temp_min < -70 || $this->tour->temp_min > 70)) {
            $this->errors[] = 'температура можеть быть в диапазоне от -70 до 70 градусов';
        }

        if (!is_null($this->tour->temp_max) && ($this->tour->temp_max < -70 || $this->tour->temp_max > 70)) {
            $this->errors[] = 'температура можеть быть в диапазоне от -70 до 70 градусов';
        }
    }

    /**
     * Проверяем поле СВободно.
     */
    private function checkAvailable()
    {
        if (is_null($this->tour->available)) {
            $this->errors[] = 'поле Свобоодно не заполнено';
        }

        if (!is_null($this->tour->available) && ($this->tour->available < 1 || $this->tour->available > 50)) {
            $this->errors[] = 'поле Свободно можеть быть в диапазоне от 1 до 50';
        }
    }

    /**
     * Проверяем поле Установить скидку.
     */
    private function checkDiscount()
    {
        if (!is_null($this->tour->discount) && ($this->tour->discount < 0 || $this->tour->discount > 100)) {
            $this->errors[] = 'поле Установить скидку может быть в диапазоне от 0 до 10';
        }
    }

    /**
     * Проверяем поле Предоплата.
     */
    private function checkPrepayment()
    {
        if (!is_null($this->tour->prepayment) && ($this->tour->prepayment < 0 || $this->tour->prepayment > 100)) {
            $this->errors[] = 'поле Предоплата может быть в диапазоне от 0 до 10';
        }
    }

    /**
     * Проверяем поле Прием заявок.
     */
    private function checkBookingUntil()
    {
        if (!is_null($this->tour->booking_until) && $this->tour->booking_until < 1) {
            $this->errors[] = 'поле Прием заявок не может быть меньше 1';
        }
    }

    /**
     * Проверяем поле Оплата участия.
     */
    private function checkPayUntil()
    {
        if (!is_null($this->tour->pay_until) && $this->tour->pay_until < 1) {
            $this->errors[] = 'поле Оплата участия не может быть меньше 1';
        }
    }

    /**
     * Проверяем предопределенные обязательные затраты.
     */
    private function checkExtraCostPreset()
    {
        // Получаем список названий предустановленной дополнительной стоимости.
        $arrNameExtraCostPreset = Tour::getArrExtraCostPreset();

        $nameExtraCostPreset = [];

        foreach ($arrNameExtraCostPreset as $item) {
            $nameExtraCostPreset[$item['id']] = $item;
        }

        // Получаем список предустановленной дополнительной стоимости для тура.
        $arrExtraCostPreset = ExtraCostPreset::find(['tour_id' => $this->tour->id]);

        foreach ($arrExtraCostPreset as $item) {
            if (is_null($item['cost']) || is_null($item['currency'])) {
                $this->errors[] = 'у обязательных затрат в блоке ' . $nameExtraCostPreset[$item['extra_cost_preset_id']]['name'] . ' не заполнены поля сумма или валюта';
            }

            if (!is_null($item['cost']) && $item['cost'] < 1) {
                $this->errors[] = 'у обязательных затрат в блоке ' . $nameExtraCostPreset[$item['extra_cost_preset_id']]['name'] . ' сумма не может быть меньше 1';
            }
        }
    }

    /**
     * Проверяем добаленные позиции обзятальных затрат и дополнительных затрат.
     */
    private function checkExtraCostRequiredAndAdditional()
    {
        $arrExtraCost = ExtraCost::find(['tour_id' => $this->tour->id]);

        $error = null;

        foreach ($arrExtraCost as $item) {
            if (is_null($item['cost']) || is_null($item['currency'])) {
                $error = true;
                break;
            }

            if (!is_null($item['cost']) && $item['cost'] < 1) {
                $error = true;
                break;
            }
        }

        if ($error) {
            $this->errors[] = 'у добавленных вручную затрат все поля должны быть заполнены, а поле сумма не можеть быть меньше 1';
        }
    }
}
