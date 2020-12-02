<?php

namespace app\widgets\organizer;

use app\base\Widget;
use app\Models\organizer\Contact;

class ContactWidget extends Widget
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        $contact = (new Contact())->getOne($this->partner->id);

        echo $this->render('organizer/views/contact', ['contact' => $contact]);
    }
}