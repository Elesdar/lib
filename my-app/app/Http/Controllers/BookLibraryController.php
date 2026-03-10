<?php

namespace App\Http\Controllers;

use App\Http\Requests\Libraries\BookLibraryRequest;
use App\Models\BookLibrary;
use Illuminate\Http\JsonResponse;

class BookLibraryController extends Controller
{
    public function addBook(BookLibraryRequest $request): JsonResponse
    {
        try {
            BookLibrary::create($request->validated());
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Книга добавлена успешна',
        ]);
    }

    /**
     * Удаляет связь между книгой и библиотекой.
     **/
    public function removeBook(BookLibrary $bookLibrary): JsonResponse
    {
        try {
            $bookLibrary->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Книга успешно удалена из библиотеки',
        ]);
    }

    public function updateBook(BookLibraryRequest $request, BookLibrary $bookLibrary): JsonResponse
    {
        try {
            $bookLibrary->update($request->validated());
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Книга успешно обновлена',
        ]);
    }
}
