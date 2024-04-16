<?php

declare(strict_types=1);

namespace application\site\services;

use application\common\forms\SlugPhotoAlbumForm;
use application\common\groups\PhotoAlbumItemGroup;
use application\common\groups\PhotoAlbumListGroup;
use application\common\repositories\PhotoAlbumRepository;
use yii\web\NotFoundHttpException;

final class PhotoAlbumService
{
    public function __construct(
        private readonly PhotoAlbumRepository $photoAlbumRepository,
    ) {

    }

    /**
     * @throws NotFoundHttpException
     */
    public function item(SlugPhotoAlbumForm $form): array
    {
        $item = $this->photoAlbumRepository->findBySlug($form->slug);
        if (!$item) {
            throw new NotFoundHttpException('Не найден фотоальбом');
        }

        return [
            'item' => PhotoAlbumItemGroup::toArray($item)
        ];
    }

    public function list(): array
    {
        return [
            'list' => PhotoAlbumListGroup::toArray($this->photoAlbumRepository->findAll())
        ];
    }
}
