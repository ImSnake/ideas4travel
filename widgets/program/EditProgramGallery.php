<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\PrImg;
use app\Models\program\Program;

class EditProgramGallery extends Widget
{
    public function run()
    {
        // Получаем ID партнера.
        $partner_id = App::get()->auth->getPartner()->id;
        // Получаем из url ID программы
        $program_id = App::get()->request->getUrlParams()['id'];
        $program = (new Program())->getOne($program_id);

        // Получаем заглавное фото.
        $mainImg = (new PrImg())->getOne([
            'partner_id' => $partner_id,
            'program_id' => $program_id,
            'type' => 'main',
            'deleted' => 0
        ]);

        // Получаем фото карты.
        $mapImg = (new PrImg())->getOne([
            'partner_id' => $partner_id,
            'program_id' => $program_id,
            'type' => 'map',
            'deleted' => 0
        ]);

        // Получаем все остальные фото.
        $allImg = (new PrImg())->getAllWhere([
            'partner_id' => $partner_id,
            'program_id' => $program_id,
            'type' => 0,
            'deleted' => 0
        ]);

        // Получаем список видео для программы.
        $arrVideos = Program::getVideos($program_id);

        echo $this->render('program/views/form_gallery', [
            'program' => $program,
            'mainImg' => $mainImg,
            'mapImg' => $mapImg,
            'allImg' => $allImg,
            'arrVideos' => $arrVideos
        ]);
    }
}
