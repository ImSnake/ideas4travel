<?php

namespace app\controllers;

use app\base\App;
use app\Models\Partner;
use app\Models\program\Program;
use app\Models\User;
use app\services\Auth;
use app\services\Db;
use app\services\renderer\IRenderer;
use Exception;

/**
 * Class Controller реализует свойства и методы общие для всех контроллеров.
 * @package app\controllers
 * @property Auth $auth
 */
abstract class Controller
{
    /** @var string|null */
    private $action;
    /** @var string */
    private $defaultAction = 'index';
    /** @var string */
    protected $layout = "main";
    /** @var IRenderer|null */
    private $renderer = null;
    /** @var Auth|null */
    protected $auth = null;
    /** @var User|null */
    protected $user = null;
    /** @var Partner|null */
    protected $partner = null;
    /** @var string */
    protected $pathToViews = VIEWS_DIR;
    /** @var Db|null */
    protected $db = null;

    /**
     * Controller constructor.
     * @param IRenderer $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->db = App::get()->db;
        $this->auth = App::get()->auth;
        $this->user = $this->auth->getUser();
        $this->partner = $this->auth->getPartner();
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
    protected function behavior()
    {
        if (isset($this->user)) {
            // Если профиль пользователя не выбран, то переводим его на страницу выбора.
            if (!$this->partner && $_SERVER['REQUEST_URI'] != '/organizer/choose-type') {
                $this->go('organizer/choose-type');
            }
        }
    }

    /**
     * Метод обертка возвращает шаблон в виде строки.
     * @param string $template - Имя подлключаемой страницы.
     * @param array $params - Список параметров, которые мы получаем в функции.
     * @param bool $userLayout - Если true, то будет рендеринг в layout.
     * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
     */
    protected function render($template, $params = [], $userLayout = true)
    {
        // TODO продумать полный механизм прав доступа.
        // Проверяем права доступа.
//        if (!$this->checkOfAccess()) {
//            return $this->renderTemplate("not-access", []);
//        }

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
        return $this->renderer->render($template, $this->pathToViews, $params);
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

    private function checkOfAccess()
    {
        // Получаем из url ID программы
        $programId = App::get()->request->getUrlParams()['id'];

        // Если есть if программы, проверяем совпадает ли текущий пользователь,
        // с пользователем, которому принадлежит программа.
        if (isset($programId)) {
            /** @var Program $program */
            $program = (new Program())->getOne($programId);

//            var_dump($programId);
//            var_dump($this->partner->id);
//            var_dump($program);

            // Если данная программа не принадлежит партеру, то выводим соответсвующее сообщение.
            if ($this->partner->id !== $program->partner_id) {
//                var_dump('Такой страницы не существует или вы не имеете прав доступа к ней');
                return false;
            }

            return true;
        }

        return true;
    }
}
