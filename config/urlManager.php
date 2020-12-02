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

return [
    [
        'pattern' => '#^[/]?$#',
        'params' => [
            'controller' => SiteController::class,
            'action' => 'index'
        ]
    ],

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

    [
        'pattern' => '#^[/]?(?:organizer)[/]?$#',
        'params' => [
            'controller' => OrganizerController::class,
            'action' => 'index'
        ]
    ],

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
        'pattern' => '#^[/]?(?:tours)[/]?$#',
        'params' => [
            'controller' => TourController::class,
            'action' => 'index'
        ]
    ],

    [
        'pattern' => '#^[/]?(?:guides)[/]?$#',
        'params' => [
            'controller' => GuidController::class,
            'action' => 'index'
        ]
    ],

    [
        'pattern' => '#^[/]?(?:requests)[/]?$#',
        'params' => [
            'controller' => RequestsController::class,
            'action' => 'index'
        ]
    ],

    [
        'pattern' => '#^[/]?(?:ajax)[/]?$#',
        'params' => [
            'controller' => AjaxController::class,
            'action' => 'index'
        ]
    ],
];
