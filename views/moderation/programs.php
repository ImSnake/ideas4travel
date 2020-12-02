<?php

use app\services\renderer\TemplateRenderer;
use app\Models\program\Program;

/* @var $errors */
/* @var $programs array */
/* @var $this TemplateRenderer */

$this->title = "Список программ доступных для модератора";
$this->description = "";

$this->cssFiles = ['organizer/moderator.css'];

?>

<div class="container back-n-wrap">
    <a href="/moderation" class="link">на главную страницу</a>
</div>

<section class="container moderation">

<!--    <h1 class="block-title">Список программ доступных для модератора</h1>-->

    <?php if ($programs[Program::STATUS_IN_MODERATION]): ?>
        <h2 class="table__title orange"><?= Program::STATUS_NAMES[Program::STATUS_IN_MODERATION] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID</div>
        </div>
        <?php foreach ($programs[Program::STATUS_IN_MODERATION] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_REJECTED]): ?>
        <h2 class="table__title red"><?= Program::STATUS_NAMES[Program::STATUS_REJECTED] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID</div>
        </div>
        <?php foreach ($programs[Program::STATUS_REJECTED] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_PUBLISHED]): ?>
        <h2 class="table__title blue"><?= Program::STATUS_NAMES[Program::STATUS_PUBLISHED] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID</div>
        </div>
        <?php foreach ($programs[Program::STATUS_PUBLISHED] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_UNPUBLISHED]): ?>
        <h2 class="table__title blue"><?= Program::STATUS_NAMES[Program::STATUS_UNPUBLISHED] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID</div>
        </div>
        <?php foreach ($programs[Program::STATUS_UNPUBLISHED] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_COMPLETED]): ?>
        <h2 class="table__title green"><?= Program::STATUS_NAMES[Program::STATUS_COMPLETED] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID:</div>
        </div>
        <?php foreach ($programs[Program::STATUS_COMPLETED] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_DRAFT]): ?>
        <h2 class="table__title grey"><?= Program::STATUS_NAMES[Program::STATUS_DRAFT] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID:</div>
        </div>
        <?php foreach ($programs[Program::STATUS_DRAFT] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($programs[Program::STATUS_ARCHIVED]): ?>
        <h2 class="table__title light-grey"><?= Program::STATUS_NAMES[Program::STATUS_ARCHIVED] ?></h2>
    <div class="table">
        <div class="table__heading">
            <div class="table__name">Программа</div>
            <div class="table__data">Дата создания программы</div>
            <div class="table__data">Дата изменеия статуса</div>
            <div class="table__id">Program ID</div>
            <div class="table__id">Partner ID:</div>
        </div>
        <?php foreach ($programs[Program::STATUS_ARCHIVED] as $program): ?>
            <div class="table__row">
                <div class="table__name">
                    <a href="/moderation/programs/<?= $program['id'] ?>" class="link"><?= $program['name'] ?></a>
                </div>
                <div class="table__data"><?= $program['create_at'] ?></div>
                <div class="table__data"><?= $program['status_at'] ?></div>
                <div class="table__id"><?= $program['id'] ?></div>
                <div class="table__id"><?= $program['partner_id'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</section>

