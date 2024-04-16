<?php

declare(strict_types=1);

namespace application\common\groups;

use application\common\entities\FileStorage;

final class FileStorageItemGroup
{
    public static function toArray(FileStorage $fileStorage): array
    {
        $path = (new FileStorageItemGroup())
            ->convertToPathFile(
                $fileStorage->dir,
                $fileStorage->name,
                $fileStorage->format
            );

        return [
            'id' => $fileStorage->id,
            'type' => $fileStorage->type,
            'format' => $fileStorage->format,
            'name' => $fileStorage->name,
            'dir' => $fileStorage->dir,
            'path' => $path,
            'created_at' => $fileStorage->created_at,
            'updated_at' => $fileStorage->updated_at,
            'deleted_at' => $fileStorage->deleted_at,
        ];
    }

    private function convertToPathFile(
        string $dir,
        string $name,
        string $format
    ): string {
        return $dir . '/' . $name . '.' . $format;
    }
}
