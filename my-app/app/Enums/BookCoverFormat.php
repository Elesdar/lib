<?php

namespace App\Enums;

enum BookCoverFormat: int
{
    case HARD = 1;
    case SOFT = 2;
    case DUST_JACKET = 3;

    public function label(): string
    {
        return match ($this) {
            self::HARD => trans('book.types.book'),  //TODO СМЕНИТЬ ПЕРЕВОД
            self::SOFT => trans('book.types.magazine'),
            self::DUST_JACKET => trans('book.types.comics'),
        };
    }
}
