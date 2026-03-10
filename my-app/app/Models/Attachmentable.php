<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $attachment_id
 * @property int $attachmentable_id
 * @property string $attachmentable_type
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable whereAttachmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable whereAttachmentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable whereAttachmentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachmentable whereId($value)
 * @mixin \Eloquent
 */
class Attachmentable extends Model
{
    public $timestamps = false;

    protected $table = 'attachmentable';
}
