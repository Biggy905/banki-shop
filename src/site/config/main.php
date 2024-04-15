<?php

$db = require '../../common/config/db.php';
$routes = require 'routes.php';
$containers = require 'containers.php';
$params = require 'params.php';

return [
    'id' => 'site',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'site\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@resoursesMain' => '@site/resourses/main',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => $containers,
        'definitions' => [],
    ],
];
