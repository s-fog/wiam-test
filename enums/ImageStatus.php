<?php

namespace app\enums;

enum ImageStatus: string
{
    case created = 'created';
    case denied = 'denied';
    case accepted = 'accepted';

    public static function canChangeStatuses(): array
    {
        return [self::accepted->value, self::denied->value];
    }

    public static function label(string $case): string
    {
        return match ($case) {
            'denied' => 'Deny',
            'accepted' => 'Accept'
        };
    }
}
