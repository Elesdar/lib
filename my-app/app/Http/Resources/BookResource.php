<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\Attachments\AttachmentGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $bookData = parent::toArray($request);

        $cover = $this->attachments->where('group', AttachmentGroup::COVER)->first();

        if ($cover) {
            $bookData['cover_url'] = Storage::url($cover->path);
        } else {
            $bookData['cover_url'] = null;
        }

        unset($bookData['books_list_id']);

        $bookData['books_list'] = [
            'id' => $this->booksList->id,
            'status' => $this->booksList->status->value,
            'label' => $this->booksList->status->label(),
        ];

        $bookData['type'] = [
            'type' => $bookData['type'],
            'label' => $this->type->label(),
        ];

        $bookData['reading_journals'] = ReadingJournalResource::collection($this->readingJournals);

        return $bookData;
    }
}
