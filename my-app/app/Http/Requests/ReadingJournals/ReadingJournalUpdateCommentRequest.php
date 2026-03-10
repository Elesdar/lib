<?php

declare(strict_types=1);

namespace App\Http\Requests\ReadingJournals;

use Illuminate\Foundation\Http\FormRequest;

class ReadingJournalUpdateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => ['nullable', 'integer', 'between:1, 10'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
