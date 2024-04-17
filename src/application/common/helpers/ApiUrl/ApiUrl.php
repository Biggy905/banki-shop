<?php

declare(strict_types=1);

namespace application\common\helpers\ApiUrl;

use application\common\components\AbstractUrl;
use Yii;

final class ApiUrl extends AbstractUrl
{
    public static $componentName = 'apiUrlManager';

    protected static function getUrlManager(): \yii\web\UrlManager
    {
        $componentName = self::$componentName;

        return Yii::$app->$componentName ?: Yii::$app->getUrlManager();
    }
}
