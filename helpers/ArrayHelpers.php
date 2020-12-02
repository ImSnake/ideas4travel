<?php

namespace app\helpers;

/**
 * Class ArrayHelpers
 * @package app\helpers
 */
class ArrayHelpers
{
    /**
     * Метод получает массив и сортирует его согласно статусам.
     * @param $array array - Исходный массив.
     * @param $sort bool - Якорь сортировки массива по имени.
     * @return array - отсортированный массив согласно статусам в последовательности start, active, end.
     */
    public static function sortByStatus(?array $array, bool $sort = true): ?array
    {
        if (is_null($array)) {
            return null;
        }

        // Инициализируем массивы по статусам.
        $start = [];
        $active = [];
        $end = [];

        // Перебираем массив и помещаем элементы в массивы по статусам.
        foreach ($array as $item) {
            if (mb_strtolower($item['status']) == 'start') {
                $start[] = $item;
            } elseif (mb_strtolower($item['status']) == 'active') {
                $active[] = $item;
            } elseif (mb_strtolower($item['status']) == 'end') {
                $end[] = $item;
            }
        }

        // Сортируем массив $active по возрастанию.
        if ($sort) {
            usort($active, function ($a, $b){
                return strcmp($a["name"], $b["name"]);
            });
        }

        // Объединяем массивы в последовательности start, active, end и возвращаем полученный массив.
        return array_merge($start, $active, $end);
    }
}
