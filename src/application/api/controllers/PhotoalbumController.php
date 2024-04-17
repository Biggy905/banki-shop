<?php

declare(strict_types=1);

namespace application\api\controllers;

use application\common\components\AbstractController;
use application\common\forms\CreatePhotoalbumForm;
use application\common\forms\SlugPhotoAlbumForm;
use application\api\services\PhotoAlbumService;
use application\common\forms\UpdatePhotoalbumForm;
use Yii;

final class PhotoalbumController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly SlugPhotoAlbumForm $slugPhotoAlbumForm,
        private readonly CreatePhotoalbumForm $createPhotoalbumForm,
        private readonly UpdatePhotoalbumForm $updatePhotoalbumForm,
        private readonly PhotoAlbumService  $photoAlbumService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionCreate(): array
    {
        $postPayload = json_decode(Yii::$app->request->getRawBody(), true) ?? [];
        $form = $this->createPhotoalbumForm;
        $data = match ($form->runValidate($postPayload)) {
            true => $this->photoAlbumService->save($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    public function actionUpdate(string $slug): array
    {
        $patchPayload = json_decode(Yii::$app->request->getRawBody(), true) ?? [];

        $form = $this->updatePhotoalbumForm;
        $data = match (
            $form->runValidate(
                array_merge($patchPayload, ['old_slug' => $slug])
            )
        ) {
            true => $this->photoAlbumService->update($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }

    public function actionDelete(string $slug): array
    {
        $form = $this->slugPhotoAlbumForm;
        $data = match ($form->runValidate(['slug' => $slug])) {
            true => $this->photoAlbumService->delete($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }
}
