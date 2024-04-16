<?php

return [
    // Services
    \application\api\services\PhotoAlbumService::class => \application\api\services\PhotoAlbumService::class,

    // Repositories
    \application\common\repositories\interfaces\PhotoAlbumRepositoryInterface::class =>
        \application\common\repositories\PhotoAlbumRepository::class,

    \application\common\repositories\interfaces\FileStorageRepositoryInterface::class =>
        \application\common\repositories\FileStorageRepository::class,
];
