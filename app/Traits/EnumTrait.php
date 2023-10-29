<?php

namespace App\Traits;

trait EnumTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function list(): array
    {
        return array_map(fn ($item, $id) => ['id' => $id, 'text' => $item], self::labels(), self::values());
    }
}
