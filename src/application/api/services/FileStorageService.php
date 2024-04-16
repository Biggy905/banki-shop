<?php

declare(strict_types=1);

namespace application\api\services;

use application\common\repositories\FileStorageRepository;

final class FileStorageService
{
    public function __construct(
        private readonly FileStorageRepository $fileStorageRepository,
    ) {

    }

    public function save()
    {

    }

    public function delete()
    {

    }
}
