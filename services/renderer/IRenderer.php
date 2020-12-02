<?php

namespace app\services\renderer;

/**
 * Interface IRenderer
 * @package app\services\renderers
 */
interface IRenderer
{
    /**
     * Метод генерирует шаблон и возвращает его в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param string $path - Путь к папке с представлениями.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @return false|string Возвращаем сгенерированный шаблон в виде строки.
     */
    public function render($template, $path, $params = []);
}
