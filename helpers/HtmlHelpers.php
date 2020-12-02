<?php

namespace app\helpers;

use app\base\App;

/**
 * Class HtmlHelpers содержит статические методы для преобразования и представления различных html данных.
 * @package app\helpers
 */
class HtmlHelpers
{
    /**
     * Метод проверяет входящую строку, удаляя HTML и PHP теги и преобразуя специальные символы в HTML-сущности.
     * @param $string - Исходная строка.
     * @return string
     */
    public static function cleanText($string)
    {
        if ($string) {
            // Удаляем лишние пробелы.
            $string = trim($string);

            // Удаляет теги HTML и PHP из строки за исключением выбранных тегов.
            $string = strip_tags($string);

            // Преобразует специальные символы в HTML-сущности.
            htmlspecialchars($string, ENT_QUOTES);
        }

        return $string;
    }

    function checkTextRedactor($string)
    {
        if ($string) {
            // Удаляем лишние пробелы.
            $string = trim($string);

            // Действия js, которые нужно удалить.
            $eventJSforDelete = [
                'onabort',
                'onactivate',
                'onafterprint',
                'onafterupdate',
                'onbeforeactivate',
                'onbeforecopy',
                'onbeforecut',
                'onbeforedeactivate',
                'onbeforeeditfocus',
                'onbeforepaste',
                'onbeforeprint',
                'onbeforeunload',
                'onbeforeupdate',
                'onblur',
                'onbounce',
                'oncellchange',
                'onchange',
                'onclick',
                'oncontextmenu',
                'oncontrolselect',
                'oncopy',
                'oncut',
                'ondataavaible',
                'ondatasetchanged',
                'ondatasetcomplete',
                'ondblclick',
                'ondeactivate',
                'ondrag',
                'ondragdrop',
                'ondragend',
                'ondragenter',
                'ondragleave',
                'ondragover',
                'ondragstart',
                'ondrop',
                'onerror',
                'onerrorupdate',
                'onfilterupdate',
                'onfinish',
                'onfocus',
                'onfocusin',
                'onfocusout',
                'onhelp',
                'onkeydown',
                'onkeypress',
                'onkeyup',
                'onlayoutcomplete',
                'onload',
                'onlosecapture',
                'onmousedown',
                'onmouseenter',
                'onmouseleave',
                'onmousemove',
                'onmoveout',
                'onmouseover',
                'onmouseup',
                'onmousewheel',
                'onmove',
                'onmoveend',
                'onmovestart',
                'onpaste',
                'onpropertychange',
                'onreadystatechange',
                'onreset',
                'onresize',
                'onresizeend',
                'onresizestart',
                'onrowexit',
                'onrowsdelete',
                'onrowsinserted',
                'onscroll',
                'onselect',
                'onselectionchange',
                'onselectstart',
                'onstart',
                'onstop',
                'onsubmit',
                'onunload'
            ];

            // Регулярное выражение, для поиска js.
            $regex = [
                '/javascript:[^\"\']*/i',
                '/(' . implode('|', $eventJSforDelete) . ')[ \\t\\n]*=[ \\t\\n]*(?|(\'|\"))[^\"\']*\g{2}/i'
            ];

            // Выполняем поиск в строке по подготовленному регулярному выражению.
            $string = preg_replace_callback($regex, function ($match) { return ''; }, $string);

            // Теги, которые не нужно удалять.
            $tags = '<p><br>';

            // Удаляет теги HTML и PHP из строки за исключением выбранных тегов.
            $string = strip_tags($string, $tags);
        }

        return $string;
    }

    /**
     * Функция принимает числительное и массив из слова в трех вариантах склонения,
     * и возвращает слово в нужном склонении для использования с заданным числительным.
     * @param int $num - Числительное для которого будет выбираться слово с нужным склонением.
     * @param array $arrWords - Массив из трех элементов. Слово в трех склонениях для использования с числительными.
     * Напримерм: ['рубль', 'рубля', 'рублей'], ['кошка', 'кошки', 'кошек'] или ['год', 'года', 'лет'].
     * @return string Возвращается искомое слово.
     */
    public static function getDeclination($num, array $arrWords)
    {
        // Если передается не число, то возвращаем пустую строку.
        if (!is_numeric($num)) {
            return '';
        }

        // Получаем последнюю цифру числа.
        $lastNum = $num % 10;
        // Получаем вторую с конца цифру у заданного числа.
        $lastNum2 = floor($num / 10) % 10;

        if ($lastNum != 1 && $lastNum != 2 && $lastNum != 3 && $lastNum != 4) {
            return $arrWords[2];
        } else {
            if ($lastNum == 1) {
                if ($lastNum2 != 1) {
                    return $arrWords[0];
                }
                return $arrWords[2];
            } else {
                if ($lastNum2 != 1) {
                    return $arrWords[1];
                }
                return $arrWords[2];
            }
        }
    }

    /**
     * Функция получает год и возвращает его в нужном формате использую функцию getDeclination() для правильного
     * склонения слова "год".
     * @param int|null $year - Количество лет для которого будет выбираться слово с нужным склонением.
     * @return string Возвращает год в нужном склонении.
     */
    public static function yearDeclination(?int $year)
    {
        if (is_null($year)) {
            return '';
        }

        return static::getDeclination($year, ['год', 'года', 'лет']);
    }

    /**
     * Функция получает день и возвращает его в нужном формате использую функцию getDeclination() для правильного
     * склонения слова "день".
     * @param int|null $day - Количество дней для которого будет выбираться слово с нужным склонением.
     * @return string Возвращает день в нужном склонении.
     */
    public static function dayDeclination(?int $day)
    {
        if (is_null($day)) {
            return '';
        }

        return static::getDeclination($day, ['день', 'дня', 'дней']);
    }

    /**
     * Функция вычисляет текущее время и возвращает его в нужном формате использую функцию getDeclination() для
     * правильного склонения слов: часы и минуты.
     * @return string Возвращает текущее время в формате 22 часа 15 минут.
     */
    public static function currentTime()
    {
        $hour = date("G");
        $minute = date("i");

        return $hour . " " . static::getDeclination((int)$hour, ['час', 'часа', 'часов']) . " " . $minute . " " .
            static::getDeclination((int)$minute, ['минута', 'минуты', 'минут']);
    }

    /**
     * Метод позволяет преобразовать текст в котором перевод строки обозначен \r\n таким образом, чтобы
     * каждая строка была обернута в заданный тег.
     * @param string|null $text - Исходный текст
     * @param string $tag - Тег в который необходимо обернуть текст.
     * @return string Возвращает текст обернутый в заданный тег.
     */
    public static function wrapTextInTag(?string $text, string $tag)
    {
        if ($text == null) {
            return '';
        }

        // Преобразуем все переводы строки в PHP_EOL.
        // Обрабатывает сначала \r\n для избежания их повторной замены.
        $order = array("\r\n", "\n", "\r");
        $replace = PHP_EOL;
        $text = str_replace($order, $replace, $text);

        $newText = '';

        // Разбиваем текст по разделителю PHP_EOL.
        $arr = explode(PHP_EOL, $text);

        // Каждый не пустой элемент массива обертываем в заданный тег предварительно убрав лишние пробелы.
        foreach ($arr as $value) {
            if (!empty($value)) {
                $newText .= "<{$tag}>" . trim($value) . "</{$tag}>";
            }
        }

        return $newText;
    }

    public static function getCityName($city_id)
    {
        $db_geo = App::get()->db_geo;

        $sql = "SELECT name FROM pb_city WHERE id = :id";
        $result = $db_geo->queryOne($sql, [':id' => $city_id]);

        return $result['name'];
    }

    /**
     * Метод преобразует единичное число к виду 01, 03, 12, 37 и т.д.
     * @param int $num
     * @return int|string|null
     */
    public static function doubleNumber(int $num)
    {
        if (!isset($num)) {
            return null;
        }

        if (mb_strlen($num) == 1) {
            return '0' . $num;
        }

        if (mb_strlen($num) > 2) {
            return null;
        }

        return $num;
    }

    public static function getMainDomain()
    {
        list($x1, $x2) = explode('.', strrev($_SERVER['HTTP_HOST']));
        return strrev($x1 . '.' . $x2);
    }

    /**
     * Метод получает число, и если оно положительное, то возвращает его со знаком +,
     * если отрицательно, то со знаком -, если 0, то 0.
     * @param $number
     * @return int|string
     */
    public static function signedNumber($number)
    {
        return ($number > 0) ? '+' . $number : $number;
    }
}
