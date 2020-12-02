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
     * @param $template
     * @param array $params
     * @return mixed
     */
    public function render($template, $params = []);
}
