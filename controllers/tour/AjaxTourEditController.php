<?php

namespace app\controllers\tour;

use app\controllers\Controller;

/**
 * Class AjaxTourEditController
 * @package app\controllers\tour
 */
class AjaxTourEditController extends Controller
{
    /** Создание нового тура. */
    public function actionTourCreate()
    {
        echo $this->render('ajax/tour/tour-create', [], false);
    }

    /** Редактирование тура. */
    public function actionTourEdit()
    {
        echo $this->render('ajax/tour/tour-edit', [], false);
    }

    /** Редактирование тура. */
    public function actionTourDelete()
    {
        echo $this->render('ajax/tour/tour-delete', [], false);
    }

    /** Публикация тура. */
    public function actionTourPublish()
    {
        echo $this->render('ajax/tour/tour-publish', [], false);
    }

    /** Снятие тура с публикации. */
    public function actionTourUnpublish()
    {
        echo $this->render('ajax/tour/tour-unpublish', [], false);
    }
}
