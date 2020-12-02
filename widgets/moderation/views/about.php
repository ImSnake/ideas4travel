<?php

use app\helpers\HtmlHelpers;

/** @var $about */

?>

<h2>Об организаторе:</h2>

<?php if ($about): ?>

    <?= HtmlHelpers::wrapTextInTag($about, 'p') ?>

<?php else: ?>

    <p>Нет информации</p>

<?php endif; ?>
