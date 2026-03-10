<?php

declare(strict_types=1);

namespace App\Http\Requests\ReadingJournals;

use App\Rules\StartBeforeOrEqualFinishRule;
use Illuminate\Foundation\Http\FormRequest;

class ReadingJournalUpdateStartDateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date', new StartBeforeOrEqualFinishRule],
            'reading_journal_id' => ['required', 'integer', 'exists:reading_journals,id'],
        ];
    }
}
