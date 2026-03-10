<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\ReadingJournal;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StartBeforeOrEqualFinishRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $readingJournal = ReadingJournal::findOrFail(request()->get('reading_journal_id'));

        if ($readingJournal && $readingJournal->finish_date !== null) {
            $startDate = Carbon::parse($value);
            if ($startDate->greaterThan($readingJournal->finish_date)) {
                $fail(':attribute не должна быть позже даты окончания');
            }
        }
    }
}
