<?php

declare(strict_types=1);

namespace application\common\groups;

final class FileStorageListGroup
{
    public static function toArray(array $fileStorages): array
    {
        $data = [];

        foreach ($fileStorages as $fileStorage) {
            $data[] = FileStorageItemGroup::toArray($fileStorage);
        }

        return $data;
    }
}
