<?php

namespace app\console\base;

use app\services\Currency;
use app\services\Db;
use app\services\DbGeo;
use app\services\Geo;
use app\traits\TSingleton;
use Exception;
use ReflectionClass;
use ReflectionException;

/**
 * Class AppConsole
 * @package app\console\base
 * @property Db $db;
 * @property DbGeo $db_geo;
 * @property Geo $geo;
 * @property Currency $currency;
 */
class AppConsole
{
    // Подключаем Singleton.
    use TSingleton;

    /** @var array Конфигурация приложения. */
    public $config;

    /** @var ComponentsStorage array Массив объектов компонентов. */
    private $components = [];

    /** @return AppConsole Возвращает экземпляр нашего приложения. */
    public static function get()
    {
        return static::getInstance();
    }

    /**
     * Метод запускает наше консольное приложение.
     * @param $config - Конфигурация приложения.
     */
    public function run($config)
    {
        // Инициализируем данные конфигурации
        $this->config = $config;
        // Инициализиурем классы хранения.
        $this->components = new ComponentsStorage();
    }

    /**
     * Метод создает объект заданного компонента и возвращает его.
     * @param string $name - Название компонента.
     * @return object Возвращает объект заданного компонента.
     * @throws ReflectionException
     * @throws Exception
     */
    public function createComponent($name)
    {
        // Получаем название компонента.
        $params = $this->config['components'][$name];
        if (isset($params)) {
            // Получаем класс компонента.
            $class = $params['class'];
            if (class_exists($class)) {
                // Удаляем параметр class, так как его не нужно передавать.
                unset($params['class']);
                // Получаем объект заданног класса с переданными в него значения, и возвращаем его.
                return $this->getObject($class, $params);
            } else {
                throw new Exception("Не определен класс компонента.");
            }
        } else {
            throw new Exception("Компонент {$name} не найден.");
        }
    }

    /**
     * Получаем объект заданног класса с переданными в него значения, и возвращаем его.
     * @param string $class - Создаваемы класс.
     * @param array $params - Параметры необходимые для создания объекта класс.
     * @return object Возвращает объект заданного компонента или репозитория.
     * @throws ReflectionException
     */
    private function getObject($class, $params)
    {
        $reflection = new ReflectionClass($class);
        return $reflection->newInstanceArgs($params);
    }

    /**
     * Метод возвращает объект запрашиваемого компонента.
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        // Если запрашиваемый параметр есть в списке компонентов, то возвращаем объект этого компонента.
        if (isset($this->config['components'][$name])) {
            return $this->components->get($name);
        }

        throw new Exception("Компонент {$name} не найден.");
    }
}