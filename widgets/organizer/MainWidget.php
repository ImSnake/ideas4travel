<?php

namespace app\widgets\organizer;

use app\base\Widget;
use DateTime;

class MainWidget extends Widget
{
    public function run()
    {
        // Получаем данные о пользователе и партнере.
        $model['partner'] = $this->partner;
        $model['user'] = $this->user;
        $model['dateInSite'] = DateTime::createFromFormat('Y-m-d H:i:s', $this->user->created_at)->format('d-m-Y');

        echo $this->render('organizer/views/main', ['model' => $model]);
    }
}