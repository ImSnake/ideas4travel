<?php

use app\Models\organizer\Contact;

/** @var $contact Contact */

?>

<h2>Контакты</h2>

<p>
    <span style="font-weight: bold">website:</span>
    <a href="<?= $contact->website ?>" target="_blank"><?= $contact->website ?></a>
</p>

<p>
    <span style="font-weight: bold">facebook:</span>
    <a href="<?= $contact->facebook ?>" target="_blank"><?= $contact->facebook ?></a>
</p>

<p>
    <span style="font-weight: bold">instagram:</span>
    <a href="<?= $contact->instagram ?>" target="_blank"><?= $contact->instagram ?></a>
</p>

<p>
    <span style="font-weight: bold">vkontacte:</span>
    <a href="<?= $contact->vkontacte ?>" target="_blank"><?= $contact->vkontacte ?></a>
</p>

<p>
    <span style="font-weight: bold">youtube:</span>
    <a href="<?= $contact->youtube ?>" target="_blank"><?= $contact->youtube ?></a>
</p>

<p>
    <span style="font-weight: bold">telegram:</span>
    <span><?= $contact->telegram ?></span>
</p>

<p>
    <span style="font-weight: bold">whatsapp:</span>
    <span><?= $contact->whatsapp ?></span>
</p>

<p>
    <span style="font-weight: bold">viber:</span>
    <span><?= $contact->viber ?></span>
</p>

<p>
    <span style="font-weight: bold">skype</span>
    <span><?= $contact->skype ?></span>
</p>

<p>
    <span style="font-weight: bold">phone</span>
    <span><?= $contact->phone ?></span>
</p>