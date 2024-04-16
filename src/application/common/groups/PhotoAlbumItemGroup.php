<?php

declare(strict_types=1);

namespace application\common\groups;

use application\common\entities\PhotoAlbum;

final class PhotoAlbumItemGroup
{
    public static function toArray(PhotoAlbum $photoAlbum): array
    {
        return [
            'id' => $photoAlbum->id,
            'slug' => $photoAlbum->slug,
            'title' => $photoAlbum->title,
            'file_storages' => FileStorageListGroup::toArray($photoAlbum->fileStorage ?? []),
            'created_at' => $photoAlbum->created_at,
            'updated_at' => $photoAlbum->updated_at ?? null,
            'deleted_at' => $photoAlbum->deleted_at ?? null,
        ];
    }
}
