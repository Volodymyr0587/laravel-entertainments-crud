<?php

namespace App\Enums;

enum EntertainmentStatus: string
{
    case WillWatch = 'will_watch';
    case Watching = 'watching';
    case Watched = 'watched';
    case OnHold = 'on_hold';
    case Abandoned = 'abandoned';

    /**
     * Get a user-friendly label for the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::WillWatch => 'Will Watch',
            self::Watching => 'Watching',
            self::Watched => 'Watched',
            self::OnHold => 'On Hold',
            self::Abandoned => 'Abandoned',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
