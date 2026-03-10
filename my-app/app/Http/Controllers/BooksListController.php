<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\BooksListResource;
use App\Models\BooksList;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksListController extends Controller
{
    public function show(BooksList $booksList): JsonResource
    {
        try {
            return $booksList->toResource();
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function index(): JsonResource
    {
        try {
            $user = request()->user();

            return BooksListResource::collection($user->booksLists);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
