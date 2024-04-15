<?php

declare(strict_types=1);

namespace common\entities;

use common\components\AbstractModel;
use common\queries\FileStorageQuery;

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
