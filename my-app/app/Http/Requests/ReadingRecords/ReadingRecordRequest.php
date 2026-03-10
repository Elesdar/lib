<?php

declare(strict_types=1);

namespace App\Http\Requests\ReadingRecords;

use App\Rules\LastFinishedPageLessThanMaxRule;
use Illuminate\Foundation\Http\FormRequest;

class ReadingRecordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => ['required', 'integer', 'exists:books,id'],
            'reading_journal_id' => ['nullable', 'integer', 'exists:reading_journals,id'],
            'last_finished_page' => ['required', 'integer', 'min:1', new LastFinishedPageLessThanMaxRule],
            'date' => ['required', 'date'],
        ];
    }
}
