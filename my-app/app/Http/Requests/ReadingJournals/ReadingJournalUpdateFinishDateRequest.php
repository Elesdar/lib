<?php

declare(strict_types=1);

namespace App\Http\Requests\ReadingJournals;

use App\Rules\FinishAfterOrEqualStartRule;
use Illuminate\Foundation\Http\FormRequest;

class ReadingJournalUpdateFinishDateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'finish_date' => ['required', 'date', new FinishAfterOrEqualStartRule],
            'reading_journal_id' => ['required', 'integer', 'exists:reading_journals,id'],
        ];
    }
}
