<?php

$rootDir = dirname(dirname(dirname(__DIR__)));
$applicationDir = dirname(dirname(__DIR__));

Yii::setAlias('app', $rootDir);
Yii::setAlias('root', $rootDir . '/../');
Yii::setAlias('vendor', $rootDir . '/vendor');

Yii::setAlias('common', $applicationDir . '/common');
Yii::setAlias('site', $applicationDir . '/site');
Yii::setAlias('api', $applicationDir . '/api');
Yii::setAlias('console', $applicationDir . '/console');
Yii::setAlias('FileStorage/tmp_image', $rootDir . '/FileStorage/tmp_image');
