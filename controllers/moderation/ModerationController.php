<?php

namespace app\controllers\moderation;

use app\base\App;
use app\controllers\Controller;
use app\Models\Partner;
use app\Models\program\Program;
use app\Models\User;
use DateTime;

/**
 * Class ModerationController
 * @package app\controllers\moderation
 */
class ModerationController extends Controller
{
    /**
     * Задаем действия, которые должны быть выполнены до начала обработки всех экшенов.
     */
    protected function behavior()
    {
        parent::behavior();
        // Если пользователь НЕ имеет прав доступа к странице, то выводим соответствующее сообщение.
        if ($this->auth->getRole() != User::ROLE_MODERATOR) {
            echo $this->render('not-access');
            exit;
        }
    }

    /**
     * URL: /moderation
     */
    public function actionIndex()
    {
        echo $this->render('moderation/index');
    }

    /**
     * URL: /moderation/programs
     */
    public function actionPrograms()
    {
        // Получаем список всех программ.
        $arrPrograms = (new Program())->getAll();
        /** @var array $programs */
        $programs = [];

        // Если в списке есть программы, то сортируем их по статусу.
        if ($arrPrograms) {
            // Перебираем массив и помещаем элементы в массивы по статусам.
            foreach ($arrPrograms as $item) {
                if ($item['status'] == Program::STATUS_IN_MODERATION) {
                    $programs[Program::STATUS_IN_MODERATION][] = $item;
                } elseif ($item['status'] == Program::STATUS_REJECTED) {
                    $programs[Program::STATUS_REJECTED][] = $item;
                } elseif ($item['status'] == Program::STATUS_PUBLISHED) {
                    $programs[Program::STATUS_PUBLISHED][] = $item;
                } elseif ($item['status'] == Program::STATUS_UNPUBLISHED) {
                    $programs[Program::STATUS_UNPUBLISHED][] = $item;
                } elseif ($item['status'] == Program::STATUS_COMPLETED) {
                    $programs[Program::STATUS_COMPLETED][] = $item;
                } elseif ($item['status'] == Program::STATUS_DRAFT) {
                    $programs[Program::STATUS_DRAFT][] = $item;
                } elseif ($item['status'] == Program::STATUS_ARCHIVED) {
                    $programs[Program::STATUS_ARCHIVED][] = $item;
                }
            }
        }

        echo $this->render('moderation/programs', ['programs' => $programs]);
    }

    /**
     * URL: /moderation/programs/<id>
     */
    public function actionProgramsPreview()
    {
        // Получаем из url ID программы
        $program_id = App::get()->request->getUrlParams()['id'];
        $program = (new Program())->getOne($program_id);
        /** @var Partner $partner */
        $partner = (new Partner())->getOne($program->partner_id);

        echo $this->render('moderation/preview', ['program' => $program, 'partner' => $partner]);
    }

    /**
     * URL: /moderation/partners
     */
    public function actionPartners()
    {
        // Получаем всех партнеров.
        // Получаем список всех программ.
        $arrPartners = (new Partner())->getAll();
        /** @var array $partners */
        $partners = [];

        // Если в списке есть партнеры, то сортируем их по статусу.
        if ($arrPartners) {
            // Перебираем массив и помещаем элементы в массивы по статусам.
            foreach ($arrPartners as $item) {
                if ($item['status'] == Partner::STATUS_IN_MODERATION) {
                    $partners[Partner::STATUS_IN_MODERATION][] = $item;
                } elseif ($item['status'] == Partner::STATUS_REJECTED) {
                    $partners[Partner::STATUS_REJECTED][] = $item;
                } elseif ($item['status'] == Partner::STATUS_CONFIRM) {
                    $partners[Partner::STATUS_CONFIRM][] = $item;
                } elseif ($item['status'] == Partner::STATUS_BLOCKED) {
                    $partners[Partner::STATUS_BLOCKED][] = $item;
                } elseif ($item['status'] == Partner::STATUS_NOT_CONFIRM) {
                    $partners[Partner::STATUS_NOT_CONFIRM][] = $item;
                }
            }
        }

        echo $this->render('moderation/partners', ['partners' => $partners]);
    }

    /**
     * URL: /moderation/partners/<id>
     */
    public function actionPartnersPreview()
    {
        // Получаем из url ID программы
        $partner_id = App::get()->request->getUrlParams()['id'];

        /** @var Partner $partner */
        $partner = (new Partner())->getOne($partner_id);
        /** @var User $user */
        $user = (new User())->getOne(['partner_id' => $partner->id]);
        // Пользовател на сайте с 'd-m-Y'.
        $dateInSite = DateTime::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d-m-Y');
        // Получаем тип партнера.
        $typePartner = $partner->partner_entity_id;

        echo $this->render('moderation/partner-preview', [
            'partner' => $partner,
            'user' => $user,
            'dateInSite' => $dateInSite,
            'typePartner' => $typePartner,
        ]);
    }
}
