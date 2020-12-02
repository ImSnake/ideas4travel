<?php

use app\services\Db;
use app\services\DbGeo;
use app\services\Geo;
use app\services\Currency;

return [
    'components' => [
        'db' => [
            'class' => Db::class
        ],
        'db_geo' => [
            'class' => DbGeo::class
        ],
        'geo' => [
            'class' => Geo::class
        ],
        'currency' => [
            'class' => Currency::class
        ],
    ],
];
