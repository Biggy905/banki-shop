<?php

declare(strict_types=1);

namespace application\common\repositories\interfaces;

use application\common\entities\PhotoAlbum;

interface PhotoAlbumRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): PhotoAlbum;

    public function findBySlug(string $slug): PhotoAlbum;

    public function save(PhotoAlbum $photoAlbum): void;

    public function softDelete(PhotoAlbum $photoAlbum): void;
}
