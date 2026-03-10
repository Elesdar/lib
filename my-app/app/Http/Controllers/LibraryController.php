<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Libraries\LibraryRequest;
use App\Http\Resources\LibraryResource;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryController extends Controller
{
    public function show(): JsonResource
    {
        try {
            $user = request()->user();
            return $user->library->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index(): JsonResource
    {
        try {
            $user = request()->user();
            $libraries = Library::where('user_id', $user->id)->get();

            return LibraryResource::collection($libraries);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
