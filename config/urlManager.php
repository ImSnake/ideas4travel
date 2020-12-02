<?php

use app\controllers\AuthController;
use app\controllers\SignupController;
use app\controllers\AjaxController;
use app\controllers\SiteController;
use app\controllers\organizer\OrganizerController;
use app\controllers\program\ProgramController;
use app\controllers\tour\TourController;
use app\controllers\guid\GuidController;
use app\controllers\request\RequestsController;
use app\controllers\program\AjaxProgramEditController;
use app\controllers\SupportController;
use app\controllers\OfferController;
use app\controllers\program\AjaxProgramPreviewController;
use app\controllers\ForgetPasswordController;
use app\controllers\tour\AjaxTourEditController;
use app\controllers\moderation\ModerationController;
use app\controllers\moderation\AjaxModerationController;
use app\controllers\organizer\AjaxOrganizerController;

return [
    // ГЛАВНАЯ
    [
        'pattern' => '#^[/]?(?:test)[/]?$#',
        'params' => [
            'controller' => SiteController::class,
            'action' => 'test'
        ]
    ],
    [
        'pattern' => '#^[/]?$#',
        'params' => [
            'controller' => SiteController::class,
            'action' => 'index'
        ]
    ],

    // РЕГИСТРАЦИЯ
    [
        'pattern' => '#^[/]?(?:signup)[/]?$#',
        'params' => [
            'controller' => SignupController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:signup)/([a-z0-9-]+)[/]?$#',
        'params' => [
            'controller' => SignupController::class,
            'action' => 'verification',
            'define' => ['key']
        ]
    ],

    // АВТОРИЗАЦИЯ
    [
        'pattern' => '#^[/]?(?:auth)[/]?$#',
        'params' => [
            'controller' => AuthController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:auth)/(?:auth-signup)[/]?$#',
        'params' => [
            'controller' => AuthController::class,
            'action' => 'auth-signup'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:auth)/(?:logout)[/]?$#',
        'params' => [
            'controller' => AuthController::class,
            'action' => 'logout'
        ]
    ],

    // ВОССТАНОВЛЕНИЕ ПАРОЛЯ
    [
        'pattern' => '#^[/]?(?:forget)[/]?$#',
        'params' => [
            'controller' => ForgetPasswordController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:forget)/([a-z0-9-]+)[/]?$#',
        'params' => [
            'controller' => ForgetPasswordController::class,
            'action' => 'verification',
            'define' => ['key']
        ]
    ],

    // ПРОФИЛЬ
    [
        'pattern' => '#^[/]?(?:organizer)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:choose-type)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'choose-type'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:about-edit)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'about-edit'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:contact-edit)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'contact-edit'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:company-edit)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'company-edit'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:person-edit)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'person-edit'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:organizer)/(?:new-password)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'new-password'
        ]
    ],

    // ПРОГРАММЫ
    [
        'pattern' => '#^[/]?(?:programs)[/]?$#',
        'params' => [
            'controller' => ProgramController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:programs)/(?:create)[/]?$#',
        'params' => [
            'controller' => ProgramController::class,
            'action' => 'create'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:programs)/(?:edit)/([0-9]+)[/]?$#',
        'params' => [
            'controller' => ProgramController::class,
            'action' => 'edit',
            'define' => ['id']
        ]
    ],
    [
        'pattern' => '#^[/]?(?:programs)/(?:preview)/([0-9]+)[/]?$#',
        'params' => [
            'controller' => ProgramController::class,
            'action' => 'preview',
            'define' => ['id']
        ]
    ],
    [
        'pattern' => '#^[/]?(?:programs)/(?:archive)[/]?$#',
        'params' => [
            'controller' => ProgramController::class,
            'action' => 'archive'
        ]
    ],

    // ТУРЫ
    [
        'pattern' => '#^[/]?(?:tours)[/]?$#',
        'params' => [
            'controller' => TourController::class,
            'action' => 'index'
        ]

    ],
    [
        'pattern' => '#^[/]?(?:tours)/(?:edit)/([0-9]+)[/]?$#',
        'params' => [
            'controller' => TourController::class,
            'action' => 'edit',
            'define' => ['id']
        ]
    ],

    // ГИДЫ
    [
        'pattern' => '#^[/]?(?:guides)[/]?$#',
        'params' => [
            'controller' => GuidController::class,
            'action' => 'index'
        ]
    ],

    // ЗАЯВКИ
    [
        'pattern' => '#^[/]?(?:requests)[/]?$#',
        'params' => [
            'controller' => RequestsController::class,
            'action' => 'index'
        ]
    ],

    // ПОДДЕРЖКА
    [
        'pattern' => '#^[/]?(?:support)[/]?$#',
        'params' => [
            'controller' => SupportController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:support)/(?:knowledge-base)[/]?$#',
        'params' => [
            'controller' => SupportController::class,
            'action' => 'knowledge-base'
        ]
    ],

    // ПОДДЕРЖКА
    [
        'pattern' => '#^[/]?(?:offer)[/]?$#',
        'params' => [
            'controller' => OfferController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:offer)/(?:rules)[/]?$#',
        'params' => [
            'controller' => OfferController::class,
            'action' => 'rules'
        ]
    ],

    // МОДЕРИРОВАНИЕ
    [
        'pattern' => '#^[/]?(?:moderation)[/]?$#',
        'params' => [
            'controller' => ModerationController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:moderation)/(?:programs)[/]?$#',
        'params' => [
            'controller' => ModerationController::class,
            'action' => 'programs'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:moderation)/(?:programs)/([0-9]+)[/]?$#',
        'params' => [
            'controller' => ModerationController::class,
            'action' => 'programs-preview',
            'define' => ['id']
        ]
    ],
    [
        'pattern' => '#^[/]?(?:moderation)/(?:partners)[/]?$#',
        'params' => [
            'controller' => ModerationController::class,
            'action' => 'partners'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:moderation)/(?:partners)/([0-9]+)[/]?$#',
        'params' => [
            'controller' => ModerationController::class,
            'action' => 'partners-preview',
            'define' => ['id']
        ]
    ],

    // AJAX
    [
        'pattern' => '#^[/]?(?:ajax)[/]?$#',
        'params' => [
            'controller' => AjaxController::class,
            'action' => 'index'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:autocomplete-reg-fact)[/]?$#',
        'params' => [
            'controller' => AjaxController::class,
            'action' => 'autocomplete-reg-fact'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:new-password)[/]?$#',
        'params' => [
            'controller' => AjaxController::class,
            'action' => 'new-password'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-create)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-create'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-duplicate)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-duplicate'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-delete)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-delete'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-archive)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-archive'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-edit-description)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-edit-description'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-edit-plan-by-days)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-edit-plan-by-days'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-edit-additional)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-edit-additional'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:upload-gallery-photo)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'upload-gallery-photo'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-gallery)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-gallery'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-delete-photo)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-delete-photo'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-edit-gallery)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-edit-gallery'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-name-unique)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-name-unique'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:show-contact-in-preview)[/]?$#',
        'params' => [
            'controller' => AjaxProgramPreviewController::class,
            'action' => 'show-contact-in-preview'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:tour-create)[/]?$#',
        'params' => [
            'controller' => AjaxTourEditController::class,
            'action' => 'tour-create'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:tour-edit)[/]?$#',
        'params' => [
            'controller' => AjaxTourEditController::class,
            'action' => 'tour-edit'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:tour-delete)[/]?$#',
        'params' => [
            'controller' => AjaxTourEditController::class,
            'action' => 'tour-delete'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:tour-publish)[/]?$#',
        'params' => [
            'controller' => AjaxTourEditController::class,
            'action' => 'tour-publish'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:rotate-avatar)[/]?$#',
        'params' => [
            'controller' => AjaxController::class,
            'action' => 'rotate-avatar'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:rotate-img)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'rotate-img'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-approve)[/]?$#',
        'params' => [
            'controller' => AjaxModerationController::class,
            'action' => 'program-approve'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-reject)[/]?$#',
        'params' => [
            'controller' => AjaxModerationController::class,
            'action' => 'program-reject'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:program-moderation-repeat)[/]?$#',
        'params' => [
            'controller' => AjaxProgramEditController::class,
            'action' => 'program-moderation-repeat'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:tour-unpublish)[/]?$#',
        'params' => [
            'controller' => AjaxTourEditController::class,
            'action' => 'tour-unpublish'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:partner-moderation)[/]?$#',
        'params' => [
            'controller' => AjaxOrganizerController::class,
            'action' => 'partner-moderation'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:partner-approve)[/]?$#',
        'params' => [
            'controller' => AjaxModerationController::class,
            'action' => 'partner-approve'
        ]
    ],
    [
        'pattern' => '#^[/]?(?:ajax)/(?:partner-reject)[/]?$#',
        'params' => [
            'controller' => AjaxModerationController::class,
            'action' => 'partner-reject'
        ]
    ],

];
