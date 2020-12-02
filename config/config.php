<?php

use app\services\Db;
use app\services\renderer\TemplateRenderer;
use app\services\Request;
use app\services\Auth;

return [
    'components' => [
        'db' => [
            'class' => Db::class
        ],
        'request' => [
            'class' => Request::class
        ],
        'renderer' => [
            'class' => TemplateRenderer::class
        ],
        'auth' => [
            'class' => Auth::class,
            'sessionName' => 'p_sid',
            'userSessionName' => 'p_userId',
            'authKeyName' => 'p_authKey'
        ],
    ],
    'urlManager' => require __DIR__ . '/../config/urlManager.php',
];
