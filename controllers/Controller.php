<?php

namespace app\controllers;

use app\base\App;
use app\services\Auth;
use app\services\renderer\IRenderer;
use Exception;

/**
 * Class Controller реализует свойства и методы общие для всех контроллеров.
 * @package app\controllers
 * @property Auth $auth
 */
abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    protected $layout = "main";
    private $renderer = null;
    protected $auth = null;

    /**
     * Controller constructor.
     * @param IRenderer $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->auth = App::get()->auth;
        $this->behavior();
    }

    /**
     * Метод запускает контроллер.
     * @param null $action
     * @throws Exception
     */
    public function run($action = null)
    {
        // Определяем action.
        $this->action = $action ?? $this->defaultAction;
        // Получаем полное имя action.
        $arrItemsAction = explode('-', $this->action);
        $action = '';
        foreach ($arrItemsAction as $item) {
            $action .= ucfirst($item);
        }
        $method = 'action' . $action;

        // Проверяем существование action, и если существует вызываем его.
        if (!method_exists($this, $method)) {
            $method = 'actionError404';
        }

        $this->$method();
    }

    /**
     * Наследуемый метод в котором можно переопределять поведение конструктора.
     */
    protected function behavior() { }

    /**
     * Метод обертка возвращает шаблон в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @param bool $userLayout - Если true, то будет рендеринг в layout.
     * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
     */
    protected function render($template, $params = [], $userLayout = true)
    {
        // Получаем содержимое подшаблона в виде строки.
        $content = $this->renderTemplate($template, $params);

        // Проверяем нужно ли использовать шаблон layout.
        if ($userLayout) {
            // Добавляем в параметры полученное содержимое подшаблона.
            $params['content'] = $content;
            // Получаем содержимое шабона в виде строки.
            $content = $this->renderTemplate("layout/{$this->layout}", $params);
        }

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
        return $this->renderer->render($template, $params);
    }

    /**
     * Данный action срабатывает тогда, когда переданный action в контроллере не существует.
     */
    public function actionError404()
    {
        echo $this->render('404');
    }

    protected function go($path = '')
    {
        header('Location: /' . $path);
    }
}
