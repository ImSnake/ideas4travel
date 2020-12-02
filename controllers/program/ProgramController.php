<?php

namespace app\controllers\program;

use app\base\App;
use app\controllers\Controller;
use app\Models\Partner;
use app\Models\program\Program;
use app\services\Geo;

class ProgramController extends Controller
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
     * URL: /programs
     */
    public function actionIndex()
    {
//        $programs = (new Program())->getAll();
        $programs = Program::getAllProgramsSortByStatus();
        echo $this->render('program/index', ['programs' => $programs]);
    }

    /**
     * URL: /programs/create
     */
    public function actionCreate()
    {
        echo $this->render('program/create');
    }

    /**
     * URL: /programs/edit/<id>
     */
    public function actionEdit()
    {
        /** @var Geo $geo */
        $geo = App::get()->geo;
        // Получаем из url ID программы
        $program_id = App::get()->request->getUrlParams()['id'];
        /** @var Program $program */
        $program = (new Program())->getOne($program_id);

        if (in_array($program->status, [Program::STATUS_IN_MODERATION, Program::STATUS_ARCHIVED])) {
            echo $this->render('not-access');
        } else {
            echo $this->render('program/edit',
                [
                    'program' => $program,
                    'geo' => $geo
                ]
            );
        }
    }

    /**
     * URL: /programs/preview/<id>
     */
    public function actionPreview()
    {
        // Получаем из url ID программы
        $program_id = App::get()->request->getUrlParams()['id'];
        $program = (new Program())->getOne($program_id);
        /** @var Partner $partner */
        $partner = (new Partner())->getOne($program->partner_id);

        echo $this->render('program/preview', ['program' => $program, 'partner' => $partner]);
    }

    /**
     * URL: /programs/archive
     */
    public function actionArchive()
    {
        $partner_id = App::get()->auth->getPartner()->id;

        // Получаем все программы со статусом ARCHIVE.
        $programs = (new Program())->getAllWhere(['partner_id' => $partner_id, 'status' => Program::STATUS_ARCHIVED], 'object');

        echo $this->render('program/archive', ['programs' => $programs]);
    }
}
