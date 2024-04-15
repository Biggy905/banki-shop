<?php

namespace site\controllers;

use common\components\AbstractController;

final class IndexController extends AbstractController
{
    public function actionViewIndex(): string
    {

    }

    public function actionCreatePhoto(): array
    {
        return [];
    }

    public function actionCreateAlbum(): array
    {
        return [];
    }

    public function actionError(): string
    {
        return '';
    }
}
