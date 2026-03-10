<?php

declare(strict_types=1);

namespace App\Services\Attachments;

use App\Enums\Attachments\ModelWithAttachment;
use App\Models\Attachment;
use Exception;
use Illuminate\Http\UploadedFile;

class AttachmentUploadService
{
    public function store(array $attachmentData, UploadedFile $uploadedFile, int $userId): ?int
    {
        try {
            $hash = hash_file('sha256', $uploadedFile->path());
            $file = Attachment::where('hash', $hash)->first();
            $fileFolder = ModelWithAttachment::from($attachmentData['model'])->getFileDirectoryByModelName();

            if (! $file) {
                $filePath = $uploadedFile->store($fileFolder);
            } else {
                $filePath = $file->path;
            }

            $attachment = Attachment::create([
                'name' => $file ? $file->name : $uploadedFile->hashName(),
                'extension' => $file ? $file->extension : $uploadedFile->getClientOriginalExtension(),
                'original_name' => $uploadedFile->getClientOriginalName(),
                'path' => $filePath,
                'hash' => $hash,
                'size' => $uploadedFile->getSize(),
                'mime' => $uploadedFile->getMimeType(),
                'user_id' => $userId,
                'group' => $attachmentData['group'],
            ]);
        } catch (Exception $exception) {
            report($exception);
            throw $exception;
        }

        return $attachment->id;
    }
}
