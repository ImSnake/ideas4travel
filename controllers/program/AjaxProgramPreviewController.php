<?php

namespace app\controllers\program;

use app\controllers\Controller;

class AjaxProgramPreviewController extends Controller
{
    /** Получение контактной информации для превью. */
    public function actionShowContactInPreview()
    {
        echo $this->render('ajax/program/show-contact-in-preview', [], false);
    }
}
