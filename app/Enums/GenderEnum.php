<?php

namespace App\Enums;

enum GenderEnum: string
{
    case male = 'male';
    case female = 'female';

    public static function select(): array
    {
        return self::names();
    }

    public static function names(): array
    {
        return [
            self::male->value => 'Male',
            self::female->value => 'Female',
        ];
    }

    public function name(): string
    {
        return match ($this) {
            self::male => 'Male',
            self::female => 'Female',
        };
    }
}
