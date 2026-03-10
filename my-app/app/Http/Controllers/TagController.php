<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TagController extends Controller
{
    public function store(TagRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $data['user_id'] = $user->id;
            Tag::create($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Tag created successfully',
        ]);
    }

    public function update(TagRequest $request, Tag $tag): JsonResponse
    {
        try {
            $tag->update($request->validated());
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Tag updated successfully',
        ]);
    }

    public function destroy(Tag $tag): JsonResponse
    {
        try {
            $tag->delete();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Tag deleted successfully',
        ]);
    }

    public function show(Tag $tag): JsonResource
    {
        try {
            return $tag->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index(): JsonResource
    {
        try {
            $user = request()->user();
            $tags = Tag::where('user_id', $user->id)->get();

            return TagResource::collection($tags);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
