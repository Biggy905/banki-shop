<?php

declare(strict_types=1);

namespace application\common\repositories\interfaces;

interface FileStorageRepositoryInterface
{
    public function save(FileStorage $fileStorage): void;
}
