<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LastFinishedPageLessThanMaxRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $book = Book::findOrFail(request(['book_id']))->first();
        if (! $book->count_pages) {
            $fail('У книги не задано количество страниц');

            return;
        }

        if ($value > $book->count_pages) {
            $fail(':attribute не должно быть больше, чем количество страниц в книге');
        }
    }
}
