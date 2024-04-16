<?php

declare(strict_types=1);

namespace application\site\controllers;

use application\common\components\AbstractController;
use application\common\forms\SlugPhotoAlbumForm;
use application\site\services\PhotoAlbumService;
use yii\web\NotFoundHttpException;

final class IndexController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly SlugPhotoAlbumForm $slugPhotoAlbumForm,
        private readonly PhotoAlbumService  $photoAlbumService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionItem(string $slug): string
    {
        $form = $this->slugPhotoAlbumForm;
        if (!$form->runValidate(['slug' => $slug])) {
            throw new NotFoundHttpException($form->getFirstError('slug'));
        }

        return $this->render(
            'item',
            $this->photoAlbumService->item($form)
        );
    }

    public function actionList(): string
    {
        return $this->render('list',
            $this->photoAlbumService->list()
        );
    }
}
