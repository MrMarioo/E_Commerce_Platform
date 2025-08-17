<?php

namespace App\Enum;

enum StatuseEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DISCONTINUED = 'discontinued';
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
