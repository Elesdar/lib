<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Attachments\AttachmentGroup;
use App\Enums\Attachments\ModelWithAttachment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttachmentUploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:jpeg,jpg,png,svg', 'size:92160'],
            'model' => ['required', 'string', Rule::in(ModelWithAttachment::cases())],
            'group' => ['required', 'string', Rule::in(AttachmentGroup::cases())],
        ];
    }
}
