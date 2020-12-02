<?php

namespace app\controllers\moderation;

use app\controllers\Controller;

class AjaxModerationController extends Controller
{
    /** Одобрение программы. */
    public function actionProgramApprove()
    {
        echo $this->render('ajax/moderation/program-approve', [], false);
    }

    /** Отклонение программы. */
    public function actionProgramReject()
    {
        echo $this->render('ajax/moderation/program-reject', [], false);
    }

    /** Одобрение профиля партнера. */
    public function actionPartnerApprove()
    {
        echo $this->render('ajax/moderation/partner-approve', [], false);
    }

    /** Отклонение профиля партнера. */
    public function actionPartnerReject()
    {
        echo $this->render('ajax/moderation/partner-reject', [], false);
    }
}
