<?php

namespace app\services;

use DateTime;
use DOMDocument;

/**
 * Метод получает курсы валют на любую дату используя API сайта Центрального банка РФ.
 * Class CBRAgent
 * @package app\services
 */
class CBRAgent
{
    /** @var array  */
    private $list = [];
    /** @var string  */
    private $date;

    /**
     * CBRAgent constructor.
     * @param DateTime|null $date
     */
    public function __construct(DateTime $date = null)
    {
        if (is_null($date)) {
            $this->date = date('d.m.Y');
        } else {
            $this->date = $date->format('d.m.Y');
        }

        $this->load();
    }

    /**
     * Метод парсит курс валют с сайта банка россии на заданную дату.
     * @return bool
     */
    private function load()
    {
        $xml = new DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->date;

        if (@$xml->load($url)) {
            $this->list = [];

            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');

            foreach ($items as $item) {
                /** @var DOMDocument $item */
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->list[$code] = floatval(str_replace(',', '.', $curs));
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * Метод возвращает курс валюты по CharCode.
     * @param string $cur - CharCode валюты, например: USD, EUR и т.д.
     * @return int|mixed - Возвращается курс валюты по CharCode, если по заданному коду нет информации - возвращается 0.
     */
    public function get(string $cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }
}
