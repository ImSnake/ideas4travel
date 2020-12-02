<?php

namespace app\widgets\organizer;

use app\base\Widget;
use app\Models\Partner;

class AboutWidget extends Widget
{
    public function run()
    {
        $partner = (new Partner())->getOne($this->partner->id);
        $about = $partner->about;
        echo $this->render('organizer/views/about', ['about' => $about]);
    }
}