<?php

namespace app\controllers\program;

use app\controllers\Controller;

class AjaxProgramEditController extends Controller
{
    /** Создание новой программы. */
    public function actionProgramCreate()
    {
        echo $this->render('ajax/program/program-create', [], false);
    }

    /** Создание дупликата программы. */
    public function actionProgramDuplicate()
    {
        echo $this->render('ajax/program/program-duplicate', [], false);
    }

    /** Удаление программы. */
    public function actionProgramDelete()
    {
        echo $this->render('ajax/program/program-delete', [], false);
    }

    /** Архивирование программы. */
    public function actionProgramArchive()
    {
        echo $this->render('ajax/program/program-archive', [], false);
    }

    public function actionProgramEditDescription()
    {
        echo $this->render('ajax/program/program-edit-description', [], false);
    }

    public function actionProgramEditPlanByDays()
    {
        echo $this->render('ajax/program/program-edit-plan-by-days', [], false);
    }

    public function actionProgramEditAdditional()
    {
        echo $this->render('ajax/program/program-edit-additional', [], false);
    }

    public function actionUploadGalleryPhoto()
    {
        echo $this->render('ajax/program/upload-gallery-photo', [], false);
    }

    public function actionProgramGallery()
    {
        echo $this->render('ajax/program/program-gallery', [], false);
    }

    public function actionProgramDeletePhoto()
    {
        echo $this->render('ajax/program/program-delete-photo', [], false);
    }

    public function actionProgramEditGallery()
    {
        echo $this->render('ajax/program/program-edit-gallery', [], false);
    }

    public function actionProgramNameUnique()
    {
        echo $this->render('ajax/program/program-name-unique', [], false);
    }

    public function actionRotateImg()
    {
        echo $this->render('ajax/program/rotate-img', [], false);
    }

    public function actionProgramModerationRepeat()
    {
        echo $this->render('ajax/program/program-moderation-repeat', [], false);
    }
}