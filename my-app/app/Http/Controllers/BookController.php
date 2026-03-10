<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Books\BookStoreRequest;
use App\Http\Requests\Books\BookTagRequest;
use App\Http\Requests\Books\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function store(BookStoreRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request): void {
                $bookData = $request->validated();
                $bookData['user_id'] = $request->user()->id;
                $bookData['read_count'] = 0;
                $bookData['count_finished_pages'] = 0;
                $bookData['books_list_id'] = request()->user()->booksLists()->where('status', $bookData['books_list_status'])->first()->id;

                $book = Book::create($bookData);

                if (array_key_exists('cover_id', $bookData) && $bookData['cover_id']) {
                    $book->attachments()->sync($bookData['cover_id']);
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Book created successfully',
        ]);
    }

    public function update(BookUpdateRequest $request, Book $book): JsonResponse
    {
        try {
            DB::transaction(function () use ($request, $book) {
                $bookData = $request->validated();

                $book->update($bookData);

                if (array_key_exists('cover_id', $bookData)
                    && $bookData['cover_id'] !== $book->attachments->first()->id) {
                    $book->attachments()->sync($bookData['cover_id']);
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Book updated successfully',
        ]);
    }

    public function destroy(Book $book): JsonResponse
    {
        try {
            $book->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Book deleted successfully',
        ]);
    }

    public function show(Book $book): JsonResource
    {
        try {
            return $book->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index(): JsonResource
    {
        try {
            $user = request()->user();
            $books = Book::where('user_id', $user->id)->get();

            return BookResource::collection($books);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addTag(BookTagRequest $request, Book $book): JsonResponse
    {
        try {
            $bookTag = $book->tags()->where('tag_id', $request->get('tag_id'))->first();

            if ($bookTag) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Тег уже был добавлен',
                ]);
            }

            $book->tags()->attach($request->get('tag_id'));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Тег добавлен успешно',
        ]);
    }
}
