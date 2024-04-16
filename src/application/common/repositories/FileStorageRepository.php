<?php

declare(strict_types=1);

namespace application\common\repositories;

use application\common\entities\FileStorage;
use application\common\repositories\interfaces\FileStorageRepositoryInterface;
use DomainException;

final class FileStorageRepository implements FileStorageRepositoryInterface
{
    public function save(FileStorage $photoAlbum): void
    {
        if (!$photoAlbum->save()) {
            throw new DomainException('Не удалось сохранить!');
        }
    }
}
