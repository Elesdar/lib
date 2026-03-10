<?php

namespace App\Http\Controllers;

use App\Http\Requests\Collections\BookCollectionRequest;
use App\Http\Requests\Collections\CollectionStoreRequest;
use App\Http\Requests\Collections\CollectionUpdateRequest;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function store(CollectionStoreRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request): void {
                $collectionData = $request->validated();
                $collectionData['user_id'] = $request->user()->id;

                $collection = Collection::create($collectionData);

                if (array_key_exists('cover_id', $collectionData) && $collectionData['cover_id']) {
                    $collection->attachments()->sync($collectionData['cover_id']);
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Коллекция создана успешно',
        ]);
    }

    public function update(CollectionUpdateRequest $request, Collection $collection): JsonResponse
    {
        try {
            DB::transaction(function () use ($request, $collection) {
                $collectionData = $request->validated();

                $collection->update($request->validated());

                if (array_key_exists('cover_id', $collectionData)
                    && $collectionData['cover_id'] !== $collection->attachments->first()->id) {   // TODO ПОМЕНЯТЬ НА СЛУЧАЙ нескольких картинок у сущности
                    $collection->attachments()->sync($collectionData['cover_id']);
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Коллекция успешно обновлена',
        ]);
    }

    public function destroy(Collection $collection): JsonResponse
    {
        try {
            $collection->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Коллекция успешно удалена',
        ]);
    }

    public function show(Collection $collection): JsonResource
    {
        try {
            return $collection->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index(): JsonResource
    {
        try {
            $user = request()->user();
            $collections = Collection::where('user_id', $user->id)->get();

            return CollectionResource::collection($collections);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Добавляет связь между книгой и коллекцией.
     **/
    public function addBook(BookCollectionRequest $request): JsonResponse
    {
        try {
            $collection = Collection::findOrFail($request['collection_id']);

            if (! in_array($request['book_id'], $collection->books->pluck('id')->toArray())) {
                $collection->books()->attach($request['book_id']);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Книга уже была добавлена',
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Книга добавлена успешна',
        ]);
    }

    /**
     * Удаляет связь между книгой и коллекцией.
     **/
    public function removeBook(BookCollectionRequest $request): JsonResponse
    {
        try {
            $collection = Collection::findOrFail($request['collection_id']);
            if (in_array($request['book_id'], $collection->books->pluck('id')->toArray())) {
                $collection->books()->detach($request['book_id']);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Книга уже была удалена',
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Книга успешно удалена из библиотеки',
        ]);
    }
}
