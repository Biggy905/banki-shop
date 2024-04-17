<?php

declare(strict_types=1);

namespace application\api\controllers;

use application\api\services\FileStorageService;
use application\common\components\AbstractController;
use application\common\forms\UploadImageForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

final class ImageFileController extends AbstractController
{
    public function __construct(
        $id,
        $module,
        private readonly UploadImageForm $uploadImageForm,
        private readonly FileStorageService $fileStorageService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionUpload(string $slug): array
    {
        $payload = [
            'images' => UploadedFile::getInstancesByName('images'),
            'slug' => $slug,
        ];

        $form = $this->uploadImageForm;
        $data = match ($form->runValidate($payload)) {
            true => $this->fileStorageService->uploadImage($form),
            false => $form->getFirstErrors(),
        };

        return $this->response($data);
    }
}
