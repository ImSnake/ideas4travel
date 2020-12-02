<?php

namespace app\services;

use app\base\App;
use NumberFormatter;

class Currency
{
    /** @var Db */
    private $db;
    /** @var array Используемые валюты */
    const ARR_CURRENCY = ['RUB', 'USD', 'EUR'];
    /** @var string Таблица валют */
    const TABLE_NAME = '_currency';
    /** @var string Название куки для хранения выбранной пользвателем валюты (ID валюты) */
    const CURRENCY_COOKIE_NAME = 'currency';
    /** @var string ID валюты по умолчанию */
    const CURRENCY_DEFAULT = 'RUB';
    /** @var string ID валюты выбранной пользователем для отображения */
    private $userCurrencyID;
    /** @var NumberFormatter объект форматирования чисел */
    private $numberFormatter;

    /**
     * Currency constructor.
     * @param Db|null $db
     */
    public function __construct(?Db $db = null)
    {
        if (is_null($db)) {
            $this->db = App::get()->db;
        } else {
            $this->db = $db;
        }

        $this->userCurrencyID = $this->getCookieCurrency();
        $this->numberFormatter = new NumberFormatter('ru_RU', NumberFormatter::DECIMAL);
    }

    /**
     * Метод возвращает массив данных для каждой валюты, ID которых явлюятся ключами.
     * @return array
     */
    public function getCurrency()
    {
        // Инициализируем массив для хранения валют.
        $arr = [];

        // Обходим все валюты и формируем новый массив с ключами из ID валют.
        foreach ($this->getCurrencyFromTable() as $item) {
            $arr[$item['id']] = $item;
        }

        return $arr;
    }

    /**
     * Методо возвращает ID валюты выбранной пользователем для отображения.
     * @return mixed|string
     */
    public function getUserCurrencyID()
    {
        return $this->userCurrencyID;
    }

    public function convert(int $price, string $from, string $to)
    {
        if (!in_array($from, self::ARR_CURRENCY) || !in_array($to, self::ARR_CURRENCY)) {
            return null;
        }

        if ($from == $to) {
            // Возрващаем округленное значение.
            return self::round($price, $to);
        }

        // Получаем массив данных по валюте с которой будем конвертировать.
        $currencyFrom = $this->$from;
        // Получаем массив данных по валюте на которую будем конвертировать.
        $currencyTo = $this->$to;

        // Конвертируем валюту.
        $toPrice = ($price * $currencyFrom['value'] * $currencyTo['nominal']) / ($currencyFrom['nominal'] * $currencyTo['value']);

        // Возрващаем округленное значение.
        return self::round($toPrice, $to);
    }

    public static function round($price, $currency)
    {
        if (!in_array($currency, self::ARR_CURRENCY)) {
            return null;
        }

        /** @var int $precision - точность округления, по умолчанию 0 */
        $precision = 0;

        // Для рубля округляем до десятых в лево, например: 12345 -> 12350
        if ($currency == 'RUB') {
            $precision = -1;
        }

        return round($price, $precision);
    }

    public function format($price)
    {
        return $this->numberFormatter->format($price);
    }

    public function convertFormat(int $price, string $from, string $to)
    {
        $priceConverted = $this->convert($price, $from, $to);

        return $this->numberFormatter->format($priceConverted);
    }

    /**
     * Магический метод возвращает массив данных для выбранной валюты из списка (ARR_CURRENCY),
     * если такой валюты нет в списке, то возвращается null.
     * @param $id - ID валюты, например USD, EUR и т.д.
     * @return mixed|null
     */
    public function __get($id)
    {
        if (!in_array($id, self::ARR_CURRENCY)) {
            return null;
        }

        $currency = $this->getCurrency();
        return $currency[$id];
    }

    /**
     * Метод возвращает все значения из таблицы валют.
     * @return array
     */
    private function getCurrencyFromTable()
    {
        return $this->db->queryAll("SELECT * FROM " . self::TABLE_NAME);
    }

    /**
     * Метод получает из куки ID валюты выбранной пользователем для отображения,
     * если такой куки нет, то создаем ее с ID валюты по умолчани.
     * @return mixed|string
     */
    private function getCookieCurrency()
    {
        if ($cookieCurrency = $_COOKIE[self::CURRENCY_COOKIE_NAME]) {
            return $cookieCurrency;
        } else {
            $this->setCookieCurrency($this->getCookieCurrencyDefault());
            return $this->getCookieCurrencyDefault();
        }
    }

    /**
     * Метод возврщает CurrencyID по умолчанию. Метод создан для того, что возможно в будущем ID будет храниться
     * не в виде константы, а в виде настроек пользователя (скажем в базе данных).
     * @return string
     */
    private function getCookieCurrencyDefault()
    {
        return self::CURRENCY_DEFAULT;
    }

    /**
     * Метод формирует куку с ID валюты выбранной пользвателем
     * @param $currency_id
     */
    private function setCookieCurrency($currency_id)
    {
        // создаем куку идентификатора пользователя.
        setcookie(self::CURRENCY_COOKIE_NAME, $currency_id,
            time() + 60 * 60 * 24 * 30 * 12,
            '/', $_SERVER['HTTP_HOST'],
            true
        );
    }
}
