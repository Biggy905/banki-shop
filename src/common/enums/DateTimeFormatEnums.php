<?php

namespace common\enums;

enum DateTimeFormatEnums: string
{
    case FORMAT_DATABASE_DATE = 'Y-m-d';
    case FORMAT_DATABASE_DATETIME = 'Y-m-d H:i:s';
    case FORMAT_DATABASE_TIME_WITH_SECOND = 'H:i:s';
    case FORMAT_DATABASE_TIME_WITHOUT_SECOND = 'H:i';

    case FORMAT_HOUR = 'H';
    case FORMAT_MINUTE = 'i';
    case FORMAT_SECOND = 's';
    case FORMAT_WEEK_DIGITAL = 'N';
}
