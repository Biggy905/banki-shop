<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\entities\PhotoAlbum;
use application\common\enums\DateTimeFormatEnums;
use application\common\helpers\DateTimeHelper;
use application\common\repositories\interfaces\PhotoAlbumRepositoryInterface;
use DomainException;

final class PhotoAlbumRepository implements PhotoAlbumRepositoryInterface
{
    public function findAll(): array
    {
        return PhotoAlbum::find()
            ->byDeletedAtNull()
            ->joinWith('fileStorage')
            ->all();
    }

    public function findBySlug(string $slug): PhotoAlbum
    {
        return PhotoAlbum::find()
            ->byDeletedAtNull()
            ->bySlug($slug)
            ->joinWith('fileStorage')
            ->one();
    }

    public function save(PhotoAlbum $photoAlbum): void
    {
        if (!$photoAlbum->save()) {
            throw new DomainException('Не удалось сохранить!');
        }
    }

    public function softDelete(PhotoAlbum $photoAlbum): void
    {
        $photoAlbum->deleted_at = (DateTimeHelper::getDateTime())
            ->format(DateTimeFormatEnums::FORMAT_DATABASE_DATETIME->value);

        if (!$photoAlbum->save()) {
            throw new DomainException('Не удалось удалить!');
        }
    }
}
