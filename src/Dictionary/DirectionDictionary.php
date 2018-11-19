<?php
declare(strict_types=1);

namespace App\Dictionary;

class DirectionDictionary
{
    public const DIRECTION_IN = 1;
    public const DIRECTION_OUT = 2;

    public const DIRECTIONS = [
        self::DIRECTION_IN => 'dictionary.direction.direction_in',
        self::DIRECTION_OUT => 'dictionary.direction.direction_out'
    ];
}
