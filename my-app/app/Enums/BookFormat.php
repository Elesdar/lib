<?php

declare(strict_types=1);

namespace App\Enums;

enum BookFormat: int
{
    case PAPER = 1;
    case EBOOK = 2;
    case AUDIO = 3;
}
