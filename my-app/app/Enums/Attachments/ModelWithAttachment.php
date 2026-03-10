<?php

declare(strict_types=1);

namespace App\Enums\Attachments;

enum ModelWithAttachment: string
{
    case BOOK = 'Book';
    case COLLECTION = 'Collection';

    public function getFileDirectoryByModelName(): string
    {
        return match ($this) {
            self::BOOK => 'books',
            self::COLLECTION => 'collections',
        };
    }
}
