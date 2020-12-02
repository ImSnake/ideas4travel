<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\Models\organizer\Contact;
use app\Models\Partner;
use app\Models\program\Program;

/** @var null|string $error */
$error = null;

// Получаем id программы из запроса.
$program_id = $_POST['program_id'];

/** @var Program $program */
$program = (new Program())->getOne($program_id);
/** @var Partner $partner */
$partner = (new Partner())->getOne($program->partner_id);
/** @var Contact $contact */
$contact = $partner->getContact();

?>
<?php if ($contact->website): ?>
    <a href="<?= $contact->website ?>" target="_blank"><span class="website"></span></a>
<?php endif; ?>
<?php if ($contact->facebook): ?>
    <a href="<?= $contact->facebook ?>" target="_blank"><span class="facebook"></span></a>
<?php endif; ?>
<?php if ($contact->instagram): ?>
    <a href="<?= $contact->instagram ?>" target="_blank"><span class="instagram"></span></a>
<?php endif; ?>
<?php if ($contact->vkontacte): ?>
    <a href="<?= $contact->vkontacte ?>" target="_blank"><span class="vkontacte"></span></a>
<?php endif; ?>
<?php if ($contact->youtube): ?>
    <a href="<?= $contact->youtube ?>" target="_blank"><span class="youtube"></span></a>
<?php endif; ?>
<?php if ($contact->telegram): ?>
    <a href="tg://resolve?domain=<?= $contact->telegram ?>" target="_blank"><span class="telegram"></span></a>
<?php endif; ?>
<?php if ($contact->whatsapp): ?>
    <a href="https://wa.me/<?= $contact->whatsapp ?>" target="_blank"><span class="whatsapp"></span></a>
<?php endif; ?>
<?php if ($contact->viber): ?>
    <a href="viber://chat?number=<?= $contact->viber ?>" target="_blank"><span class="viber"></span></a>
<?php endif; ?>
<?php if ($contact->skype): ?>
    <a href="skype:<?= $contact->skype ?>" target="_blank"><span class="skype"></span></a>
<?php endif; ?>
<?php if ($contact->phone): ?>
    <a href="tel:<?= $contact->phone ?>" target="_blank"><span class="phone"></span></a>
<?php endif; ?>