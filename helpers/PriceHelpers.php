<?php

namespace app\helpers;

use app\Models\tour\Tour;

/**
 * Class PriceHelpers содержит методы для работы с ценами.
 * @package app\helpers
 */
class PriceHelpers
{
    /**
     * Получаем величину скидки.
     * @param int|null $price - изначальная цена.
     * @param int|null $discount - скидка в процентах.
     * @return float|int|null
     */
    public static function getDiscount(?int $price, ?int $discount)
    {
        if (is_null($price)) {
            return null;
        }

        if (is_null($discount)) {
            return $price;
        }

        return $price - ($price / 100 * $discount);
    }

    /**
     * Получаем цену с учетом скидки.
     * @param Tour $tour
     * @return float|int|null
     */
    public static function getPriceWithDiscount(Tour $tour)
    {
        if (is_null($tour->price)) {
            return null;
        }

        if (is_null($tour->discount)) {
            return $tour->price;
        }

        if (strtotime($tour->discount_at) < strtotime(date('Y-m-d', time()))){
            return $tour->price;
        }

        return $tour->price - ($tour->price / 100 * $tour->discount);
    }
}
