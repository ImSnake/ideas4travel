<?php

namespace app\widgets\moderation;

use app\base\Widget;
use app\Models\organizer\Contact;
use app\Models\Partner;

class ContactWidget extends Widget
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        /** @var Partner $partner */
        $partner = $this->params['partner'];

        $contact = (new Contact())->getOne($partner->id);

        echo $this->render('moderation/views/contact', ['contact' => $contact]);
    }
}
