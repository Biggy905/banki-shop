<?php

declare(strict_types=1);

namespace application\api\services;

use application\common\components\AbstractModel;
use application\common\entities\FileStorage;
use application\common\entities\PhotoAlbum;
use application\common\enums\DateTimeFormatEnums;
use application\common\enums\FileStorageEntityEnums;
use application\common\enums\FileStorageTypeEnums;
use application\common\forms\UploadImageForm;
use application\common\helpers\DateTimeHelper;
use application\common\helpers\SiteUrl\SiteUrl;
use application\common\repositories\FileStorageRepository;
use application\common\repositories\PhotoAlbumRepository;
use Yii;
use Exception;
use LogicException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

final class FileStorageService
{
    public function __construct(
        private readonly FileStorageRepository $fileStorageRepository,
        private readonly PhotoAlbumRepository $photoAlbumRepository,
    ) {

    }

    /**
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function uploadImage(UploadImageForm $form): array
    {
        $data = [];

        try {
            if ($form->validate()) {
                $photoalbum = $this->photoAlbumRepository->findBySlug($form->slug);
                if (!$photoalbum) {
                    throw new NotFoundHttpException('Запись не найдена!');
                }

                $this->takeFiles($form->images, $photoalbum->id);

                $data = [
                    'status' => 'success',
                    'url' => SiteUrl::to(['index/item', 'slug' => $photoalbum->slug], true),
                ];
            }
        } catch (Exception $e) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    private function takeFiles(array $images, int $entityId): void
    {
        $date = (DateTimeHelper::getDateTime());

        $storagePath = Yii::getAlias('@ImageFileStorage');

        foreach ($images as $image) {
            $fileName = $this->saveFile(
                $image,
                $storagePath,
                $date->format((DateTimeFormatEnums::DATE_TO_NAME_FILE)->value)
            );

            $this->saveDb(
                $image,
                new PhotoAlbum(),
                $entityId,
                $date->format((DateTimeFormatEnums::FORMAT_DATABASE_DATETIME)->value),
                $fileName,
                $storagePath
            );
        }
    }

    /**
     * @throws Exception
     */
    private function saveFile(
        UploadedFile $file,
        string $storagePath,
        string $date,
    ): string {
        $name = $this->generateName();

        $generatePathStorage = $storagePath . '/' . $name . '_' . $date . '.' . $file->getExtension();

        if (!$generatePathStorage) {
            throw new LogicException();
        }

        $file->saveAs($generatePathStorage);

        return $name;
    }

    public function saveDb(
        UploadedFile $file,
        AbstractModel $abstractModel,
        int $idEntity,
        string $dateTime,
        string $fileName,
        string $path
    ): FileStorage {
        $fileStorage = new FileStorage();
        $fileStorage->type = FileStorageTypeEnums::TYPE_IMAGE->value;
        $fileStorage->format = $file->getExtension();
        $fileStorage->name = $fileName;
        $fileStorage->dir = $path;
        $fileStorage->entity = FileStorageEntityEnums::toEntity($abstractModel);
        $fileStorage->entity_id = $idEntity;
        $fileStorage->created_at = $dateTime;

        $this->fileStorageRepository->save($fileStorage);

        return $fileStorage;
    }

    /**
     * @throws Exception
     */
    private function generateName(): string
    {
        return Yii::$app->security->generateRandomString(16);
    }
}
