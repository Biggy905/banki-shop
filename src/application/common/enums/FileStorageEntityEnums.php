<?php

namespace application\common\enums;

use application\common\components\AbstractModel;

enum FileStorageEntityEnums
{
    public static function toEntity(AbstractModel $abstractModel): string
    {
        return $abstractModel::class;
    }
}
