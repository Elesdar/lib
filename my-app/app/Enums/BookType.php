<?php

declare(strict_types=1);

namespace App\Enums;

enum BookType: int
{
    case BOOK = 1;
    case MAGAZINE = 2;
    case COMICS = 3;
    case MANGA = 4;

    public function label(): string
    {
        return match ($this) {
            self::BOOK => trans('book.types.book'),
            self::MAGAZINE => trans('book.types.magazine'),
            self::COMICS => trans('book.types.comics'),
            self::MANGA => trans('book.types.manga'),
        };
    }
}
