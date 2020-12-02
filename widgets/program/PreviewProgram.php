<?php

namespace app\widgets\program;

use app\base\Widget;

class PreviewProgram extends Widget
{
    public function run()
    {
        echo $this->render('program/views/preview_program');
    }
}
