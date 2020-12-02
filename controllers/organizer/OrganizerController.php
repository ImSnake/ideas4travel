<?php

namespace app\controllers\organizer;

use app\controllers\Controller;

class OrganizerController extends Controller
{
   protected function behavior()
   {
       parent::behavior();
       // Если пользователь НЕ авторизован перенаправляем его на главную страницу.
       if (!$this->auth->getUserId()) {
           $this->go();
       }
   }

    /**
     * URL: /organizer
     */
    public function actionIndex()
    {
        echo $this->render('organizer/index');
    }
}
