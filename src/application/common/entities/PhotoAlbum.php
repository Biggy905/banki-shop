<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\PhotoAlbumQuery;
use yii\db\ActiveQuery;

/**
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property array $fileStorage
 */
final class PhotoAlbum extends AbstractModel
{
    public static function tableName(): string
    {
        return '{{%photoalbum}}';
    }

    public static function find(): PhotoAlbumQuery
    {
        return (new PhotoAlbumQuery(get_called_class()));
    }

    public function getFileStorage(): ActiveQuery
    {
        return $this->hasMany(
            FileStorage::class,
            [
                'id_entity' => 'id',
            ]
        );
    }
}
