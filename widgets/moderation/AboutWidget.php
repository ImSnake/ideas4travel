<?php

namespace app\widgets\moderation;

use app\base\Widget;
use app\Models\Partner;

class AboutWidget extends Widget
{
    public function run()
    {
        /** @var Partner $partner */
        $partner = $this->params['partner'];

        $about = $partner->about;

        echo $this->render('moderation/views/about', ['about' => $about]);
    }
}