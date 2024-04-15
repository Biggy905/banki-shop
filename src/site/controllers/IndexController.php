<?php

declare(strict_types=1);

namespace site\controllers;

use common\components\AbstractController;

final class IndexController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionItem(int $id): string
    {
        return $this->render('index');
    }

    public function actionList(): string
    {
        return $this->render('index');
    }

    public function actionCreate(): string
    {
        return $this->render('index');
    }

    public function actionUpdate(): string
    {
        return $this->render('index');
    }
}
