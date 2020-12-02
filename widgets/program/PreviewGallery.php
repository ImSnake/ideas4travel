<?php

namespace app\widgets\program;

use app\base\Widget;

class PreviewGallery extends Widget
{
    public function run()
    {
        echo $this->render('program/views/preview_gallery');
    }
}
