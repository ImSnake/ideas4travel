<?php

namespace app\controllers\organizer;

use app\controllers\Controller;

class AjaxOrganizerController extends Controller
{
    /** Подтверждение профиля партнера. */
    public function actionPartnerModeration()
    {
        echo $this->render('ajax/organizer/partner-moderation', [], false);
    }
}
