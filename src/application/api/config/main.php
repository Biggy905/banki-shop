<?php

use application\common\helpers\SiteUrl\SiteUrl;
use yii\web\Response;

$db = require __DIR__ . '/../../common/config/db.php';
$routes = require __DIR__ . '/routes.php';
$siteRoutes = require __DIR__ . '/../../site/config/routes.php';
$containers = require __DIR__ . '/containers.php';
$params = require __DIR__ . '/params.php';

return [
    'id' => 'api',
    'name' => 'API сайта',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'application\api\controllers',
    'components' => [
        'errorHandler' => [
            'class' => \application\common\components\ErrorHandler::class,
        ],
        'request' => [
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ],
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'response' => [
            'class' => Response::class,
            'format' => Response::FORMAT_JSON,
        ],
        'db' => $db,
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => $routes,
        ],
        SiteUrl::$componentName => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'baseUrl' => '/',
            'hostInfo' => sprintf('%s://%s:%s', 'http', 'localhost', '7000'),
            'rules' => $siteRoutes,
        ],

    ],
    'container' => [
        'singletons' => $containers,
        'definitions' => [],
    ],
    'params' => $params,
];
