<?php

namespace app\services\renderer;

/**
 * Class TemplateRenderer
 * @package app\services\renderer
 */
class TemplateRenderer implements IRenderer
{
    /**
     * @var string the page title
     */
    public $title;
    /**
     * @var string the page description
     */
    public $description;
    /**
     * @var array the registered CSS files.
     * @see registerCssFile()
     */
    public $cssFiles = [];
    /**
     * @var array the registered JS files.
     * @see registerJsFile()
     */
    public $jsFiles = [];

    /**
     * Метод генерирует шаблон и возвращает его в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @return false|string Возвращаем сгенерированный шаблон в виде строки.
     */
    public function render($template, $params = [])
    {
        // Извлекаем переменные из массива.
        extract($params);
        // Включаем буферизацию вывода.
        ob_start();
        // Подключаем шаблон.
        require VIEWS_DIR . $template . ".php";
        // Возвращаем полученное содержимое текущего буфера, бефер очищаем.
        return ob_get_clean();
    }
}
