<?php

namespace App\Enum;

enum Genre: string
{
    case RAP = 'Rap';
    case TRAP = 'Trap';
    case FUNK = 'Funk';
    case POP = 'Pop';
    case ROCK = 'Rock';
    case RNB = 'R&B';
    case MPB = 'MPB';
    case GOSPEL = 'Gospel';
    case ELETRONICA = 'Eletrônica';
    case SERTANEJO = 'Sertanejo';
    case OUTRO = 'Outro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
