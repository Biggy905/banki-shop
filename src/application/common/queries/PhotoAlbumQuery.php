<?php

declare(strict_types=1);

namespace application\common\queries;

use application\common\entities\PhotoAlbum;
use yii\db\ActiveQuery;

final class PhotoAlbumQuery extends ActiveQuery
{
    public function byDeletedAtNull(): self
    {
        return $this->andWhere(
            [
                PhotoAlbum::tableName() . '.deleted_at' => null,
            ]
        );
    }

    public function bySlug(string $slug): self
    {
        return $this->andWhere(
            [
                PhotoAlbum::tableName() . '.slug' => $slug,
            ]
        );
    }
}
