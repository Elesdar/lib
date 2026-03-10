<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $booksList = $this->resource;

        $booksListData = [
            'id' => $booksList->id,
            'status' => $booksList->status->value,
            'label' => $booksList->status->label(),
            'books_count' => $booksList->loadCount('books')->books_count,
            'items' => BookResource::collection($booksList->books),
        ];

        return $booksListData;
    }
}
