<?php

namespace console\controllers;

use yii\console\Controller;

final class TestController extends Controller
{
    public function actionTest(): void
    {
        echo "Консоль запущена!";
    }
}
