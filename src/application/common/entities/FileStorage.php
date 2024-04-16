<?php

declare(strict_types=1);

namespace application\common\entities;

use application\common\components\AbstractModel;
use application\common\queries\FileStorageQuery;

/**
 * @property integer $id
 * @property integer $entity_id
 * @property string $type
 * @property string $format
 * @property string $name
 * @property string $dir
 * @property string $entity
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class FileStorage extends AbstractModel
{
    public static function tableName(): string
    {
        return '{{%file_storage}}';
    }

    public static function find(): FileStorageQuery
    {
        return (new FileStorageQuery(get_called_class()));
    }
}
