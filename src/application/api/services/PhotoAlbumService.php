<?php

declare(strict_types=1);

namespace application\api\services;

use application\common\entities\PhotoAlbum;
use application\common\enums\DateTimeFormatEnums;
use application\common\forms\CreatePhotoalbumForm;
use application\common\forms\SlugPhotoAlbumForm;
use application\common\forms\UpdatePhotoalbumForm;
use application\common\helpers\DateTimeHelper;
use application\common\helpers\SiteUrl\SiteUrl;
use application\common\repositories\PhotoAlbumRepository;
use Exception;
use yii\web\NotFoundHttpException;

final class PhotoAlbumService
{
    public function __construct(
        private readonly PhotoAlbumRepository $photoAlbumRepository,
    ) {

    }

    public function save(CreatePhotoalbumForm $form): array
    {
        try {
            $photoalbum = new PhotoAlbum();
            $photoalbum->title = $form->title;
            $photoalbum->slug = $form->slug;
            $photoalbum->created_at = (DateTimeHelper::getDateTime())
                ->format(DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value);

            $this->photoAlbumRepository->save($photoalbum);

            $data = [
                'status' => 'success',
                'url' => SiteUrl::to(['index/item', 'slug' => $photoalbum->slug], true),
            ];
        } catch (Exception $e) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return $data;
    }

    public function update(UpdatePhotoalbumForm $form): array
    {
        try {
            $photoalbum = $this->photoAlbumRepository->findBySlug($form->old_slug);
            $photoalbum->title = $form->title;
            if ($form->old_slug !== $form->slug) {
                $photoalbum->slug = $form->slug;
            }
            $photoalbum->updated_at = (DateTimeHelper::getDateTime())
                ->format(DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value);

            $this->photoAlbumRepository->save($photoalbum);

            $data = [
                'status' => 'success',
                'url' => SiteUrl::to(['index/item', 'slug' => $photoalbum->slug], true)
            ];
        } catch (Exception $e) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return $data;
    }

    public function delete(SlugPhotoAlbumForm $form): array
    {
        try {
            $photoalbum = $this->photoAlbumRepository->findBySlug($form->slug);
            if (!$photoalbum) {
                throw new NotFoundHttpException('Запись не найдена');
            }

            $this->photoAlbumRepository->softDelete($photoalbum);

            $data = [
                'status' => 'success',
                'url' => SiteUrl::to(['index/list'], true)
            ];
        } catch (Exception $e) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }

        return $data;
    }
}
