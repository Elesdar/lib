<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentUploadRequest;
use App\Services\Attachments\AttachmentUploadService;

class AttachmentController extends Controller
{
    public function upload(AttachmentUploadRequest $request, AttachmentUploadService $service): ?int
    {
        try {
            if ($request->hasFile('file')) {
                return $service->store($request->validated(), $request->file('file'), $request->user()->id);
            }
        } catch (\Exception $e) {
            report($e);
            throw $e;
        }

        return null;
    }
}
