<?php

declare(strict_types=1);

namespace application\site\controllers;

use application\common\components\AbstractController;

final class AboutController extends AbstractController
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
