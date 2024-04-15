<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/aliases.php';

use yii\console\Application;
use Dotenv\Dotenv;

(Dotenv::createUnsafeImmutable(
    Yii::getAlias('@root') . '/../',
    ['.env'],
    false
))->load();

$config = require __DIR__ . '/../../site/config/main.php';

(new Application($config))->run();