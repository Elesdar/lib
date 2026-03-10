<?php

declare(strict_types=1);

namespace App\Enums;

enum BooksListStatus: int
{
    case PLANNED = 1;
    case IN_PROGRESS = 2;
    case REREAD = 3;
    case FINISHED = 4;
    case DEFERRED = 5;
    case ABANDONED = 6;

    public function label(): string
    {
        return match ($this) {
            self::PLANNED => trans('books_list.status.planned'),
            self::IN_PROGRESS => trans('books_list.status.in_progress'),
            self::REREAD => trans('books_list.status.reread'),
            self::FINISHED => trans('books_list.status.finished'),
            self::DEFERRED => trans('books_list.status.deferred'),
            self::ABANDONED => trans('books_list.status.abandoned'),
        };
    }
}
