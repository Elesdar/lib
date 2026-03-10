<?php

declare(strict_types=1);

namespace App\Http\Requests\ReadingJournals;

use Illuminate\Foundation\Http\FormRequest;

class ReadingJournalStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => ['required', 'int'],
            'start_date' => ['required', 'date'],
        ];
    }
}
