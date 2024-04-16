<?php

declare(strict_types=1);

namespace application\common\groups;

final class PhotoAlbumListGroup
{
    public static function toArray(array $photoAlbums): array
    {
        $data = [];

        foreach ($photoAlbums as $photoAlbum) {
            $data[] = PhotoAlbumItemGroup::toArray($photoAlbum);
        }

        return $data;
    }
}
