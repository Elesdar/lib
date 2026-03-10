<?php

namespace App\Http\Requests\Libraries;

use App\Enums\BookCoverFormat;
use App\Enums\BookFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookLibraryRequest extends FormRequest
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
            'library_id' => ['required', 'integer', 'exists:libraries,id'],
            'format' => ['required', 'integer', Rule::in(BookFormat::cases())],
            'isbn' => ['nullable', 'string'],
            'year' => ['nullable', 'date_format:Y'],
            'publisher' => ['nullable', 'string'],
            'cover_format' => ['nullable', 'integer', Rule::in(BookCoverFormat::cases())],
            'purchase_price' => ['nullable', 'decimal:2'],
            'purchase_date' => ['nullable', 'date'],
            'purchase_place' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }
}
