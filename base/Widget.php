<?php

namespace app\base;

use app\Models\User;
use app\services\Auth;
use app\services\Db;
use app\services\renderer\IRenderer;
use app\Models\Partner;

/**
 * Class Widget
 * @package app\base
 */
abstract class Widget
{
    /** @var array */
    public $params;
    /** @var Auth|null */
    protected $auth = null;
    /** @var User|null */
    protected $user = null;
    /** @var Partner|null  */
    protected $partner = null;
    /** @var IRenderer */
    private $renderer;
    /** @var string */
    protected $pathToViews = VIEWS_WIDGETS_DIR;
    /** @var Db */
    protected $db;

    /**
     * Widget constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->db = App::get()->db;
        $this->auth = App::get()->auth;
        $this->user = $this->auth->getUser();
        $this->partner = $this->auth->getPartner();
        $this->params = $params;
        $this->renderer = App::get()->renderer;
        $this->run();
    }

    /** Метод для вывода содержимого виджета */
    protected function run() { }

    /**
     * Метод обертка возвращает шаблон в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
     */
    protected function render($template, $params = [])
    {
        // Получаем содержимое подшаблона в виде строки.
        $content = $this->renderTemplate($template, $params);

        return $content;
    }

    /**
     * Метод возвращает сгенерированный шаблон в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @return false|string Возвращаем сгенерированный шаблон в виде строки.
     */
    private function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $this->pathToViews, $params);
    }
}
