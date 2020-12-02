<?php

namespace app\services;

use app\base\App;
use app\controllers\Error404Controller;

/**
 * Class Request для работы с глобальным массивом REQUEST, POST, GET.
 * @package app\services
 */
class Request
{
    /** @var array Конфигурация сисетмы */
    private $config = [];
    /** @var array */
    private $params = [];
    /** @var array параметры url */
    private $urlParams = [];

    /**
     * Request constructor инициализирует свойства класса.
     */
    public function __construct()
    {
        $this->config = App::get()->config;
        $this->params['get'] = $_GET;
        $this->params['post'] = $_POST;
        $this->params['request_uri'] = $_SERVER['REQUEST_URI'];
        $this->urlParams = $this->parseUrlParams();
    }

    /**
     * @return null|string Возвращает имя контроллера, если его нет, то null.
     */
    public function getControllerClass()
    {
        return $this->urlParams['controller'] ?? null;
    }

    /**
     * @return null|string Возвращает имя экшена, если его нет, то null.
     */
    public function getActionName()
    {
        return $this->urlParams['action'] ?? null;
    }

    /**
     * @return null|string Взвращает $_SERVER['REQUEST_URI'];
     */
    public function getRequestUri()
    {
        return $this->params['request_uri'] ?? null;
    }

    /**
     * @return array Взвращает массив с ключами get и post, а так же их значениями.
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $name - Имя свойства $_GET.
     * @return mixed Возвращаефт значение свойства $name в массиве $_GET.
     */
    public function get($name)
    {
        if (isset($this->params['get'][$name])) {
            return $this->params['get'][$name];
        }
        return null;
    }

    /**
     * @param $name - Имя свойства $_POST.
     * @return mixed Возвращаефт значение свойства $name в массиве $_POST.
     */
    public function post($name)
    {
        if (isset($this->params['post'][$name])) {
            return $this->params['post'][$name];
        }
        return null;
    }

    /**
     * @return string Возвращает название метода, которым были переданы значения: get, post или both.
     */
    public function getMethod()
    {
        if (!empty($this->params['get']) && empty($this->params['post'])) {
            return 'get';
        }
        if (empty($this->params['get']) && !empty($this->params['post'])) {
            return 'post';
        }
        return 'both';
    }

    /**
     * Метод сопоставляет текующий url с правилами роутинга записанных в конфигурации,
     * и формирует массив параметров url, такие как controller, action и другие.
     * @return array
     */
    private function parseUrlParams(): array
    {
        foreach ($this->config['urlManager'] as $item) {
            if (preg_match($item['pattern'], $this->params['request_uri'], $match) === 1) {
                if (isset($item['params']['define'])) {
                    for ($i = 1; $i < count($match); $i++) {
                        foreach ($item['params']['define'] as $defineItem) {
                            $item['params'][$defineItem] = $match[$i];
                        }
                    }
                }
                unset($item['params']['define']);
                return $item['params'];
            }
        }

        // Если совпадений нет, то в параметры добавляем контролер 404 ошибки.
        $item['params']['controller'] = Error404Controller::class;
        $item['params']['action'] = 'index';

        return $item['params'];
    }

    public function getUrlParams(){
        return $this->urlParams;
    }
}
