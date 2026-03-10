<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Attachable
{
    public function attachment(?string $group = null): MorphToMany
    {
        $query = $this->morphToMany(
            Attachment::class,
            'attachmentable',
            'attachmentable',
            'attachmentable_id',
            'attachment_id',
        );

        if ($group !== null) {
            $query->where($group, $group);
        }

        return $query->orderBy('sort');
    }
}
