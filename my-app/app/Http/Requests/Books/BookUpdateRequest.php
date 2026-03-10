<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use App\Enums\BooksListStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:2047'],
            'type' => ['required', 'integer'],
            'books_list_status' => ['required', 'integer', Rule::in(BooksListStatus::cases())],
            'description' => ['nullable', 'string'],
            'cover_id' => ['nullable', 'integer', 'exists:attachments,id'],
            'old_cover_id' => ['nullable', 'integer', 'exists:attachments,id'],
            'count_pages' => ['nullable', 'integer', 'min:1'],
            'author' => ['nullable', 'string'],
            'publishing_date' => ['nullable', 'date'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:10'],
            'note' => ['nullable', 'string'],
        ];
    }
}
