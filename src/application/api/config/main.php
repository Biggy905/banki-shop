<?php

use application\common\helpers\SiteUrl\SiteUrl;

$db = require __DIR__ . '/../../common/config/db.php';
$routes = require __DIR__ . '/routes.php';
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
            'rules' => $routes,
        ],
        'request' => [
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ],
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
    ],
    'container' => [
        'singletons' => $containers,
        'definitions' => [],
    ],
    'params' => $params,
];
