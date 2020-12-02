<?php

namespace app\widgets\header;

use app\base\Widget;
use app\Models\Partner;
use app\base\App;

class HeaderRightWidget extends Widget
{
    public function run()
    {
        echo $this->render('header/views/header_right',
            ['user' => $this->user, 'partner' => App::get()->auth->getPartner()]);
    }
}