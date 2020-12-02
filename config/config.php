<?php

use app\services\Auth;
use app\services\Currency;
use app\services\Db;
use app\services\DbGeo;
use app\services\Geo;
use app\services\renderer\TemplateRenderer;
use app\services\Request;

return [
    'components' => [
        'db' => [
            'class' => Db::class
        ],
        'db_geo' => [
            'class' => DbGeo::class
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
        'geo' => [
            'class' => Geo::class
        ],
        'currency' => [
            'class' => Currency::class
        ],
    ],
    'urlManager' => require __DIR__ . '/../config/urlManager.php',
];
