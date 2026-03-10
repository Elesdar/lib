<?php

namespace App\Http\Resources;

use App\Enums\Attachments\AttachmentGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $collection = $this->resource;
        $books = BookResource::collection($collection->books);

        $cover = $this->attachments->where('group', AttachmentGroup::COVER)->first();

        if ($cover) {
            $coverUrl = Storage::url($cover->path);
        } else {
            $coverUrl = null;
        }

        $collection = $collection->toArray();

        $collection['cover'] = $coverUrl;
        $collection['books'] = $books;

        return $collection;
    }
}
