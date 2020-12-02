<?php

namespace app\helpers;

use DateTime;
use Exception;

/**
 * Class DateHelpers
 * @package app\helpers
 */
class DateHelpers
{
    /**
     * Метод проверяет корректносить даты.
     * @param $date
     * @param string $format
     * @return bool - если дата корректна, то возвращается true, иначе - false.
     */
    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Метод выводит строковое представление переданной даты в формате - 8 марта.
     * @param $date - дата в формате которые принимает DateTime.
     * @return string
     */
    public static function getDayMonth($date)
    {
        try {
            $date = new DateTime($date);
        } catch (Exception $e) {
            return '';
        }

        // Получаем день месяца.
        $day = $date->format('j');

        // Получаем день недели.
        $month = $date->format('m');

        switch ($month) {
            case 1:
                $monthString = 'Января';
                break;
            case 2:
                $monthString = 'Февраля';
                break;
            case 3:
                $monthString = 'Марта';
                break;
            case 4:
                $monthString = 'Апреля';
                break;
            case 5:
                $monthString = 'Мая';
                break;
            case 6:
                $monthString = 'Июня';
                break;
            case 7:
                $monthString = 'Июля';
                break;
            case 8:
                $monthString = 'Августа';
                break;
            case 9:
                $monthString = 'Сентября';
                break;
            case 10:
                $monthString = 'Октября';
                break;
            case 11:
                $monthString = 'Ноября';
                break;
            case 12:
                $monthString = 'Декабря';
                break;
            default:
                $monthString = '';
        }

        return $day . ' ' . $monthString;
    }

    /**
     * Метод выводит строковое представление дня недели.
     * @param $date - дата в формате которые принимает DateTime.
     * @return string
     */
    public static function getTextDay($date)
    {
        try {
            $date = new DateTime($date);
        } catch (Exception $e) {
            return '';
        }

        // Получаем день месяца.
        $day = $date->format('N');

        switch ($day) {
            case 1:
                return 'Понедельник';
                break;
            case 2:
                return 'Вторник';
                break;
            case 3:
                return 'Среда';
                break;
            case 4:
                return 'Четверг';
                break;
            case 5:
                return 'Пятница';
                break;
            case 6:
                return 'Суббота';
                break;
            case 7:
                return 'Воскресенье';
                break;
            default:
                return '';
        }
    }
}
