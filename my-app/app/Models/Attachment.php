<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $original_name
 * @property string|null $mime
 * @property string $extension
 * @property string|null $size
 * @property string $path
 * @property string $group
 * @property int $user_id
 * @property string|null $hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attachmentable> $attachmentable
 * @property-read int|null $attachmentable_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @property-read int|null $books_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $collections
 * @property-read int|null $collections_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attachment whereUserId($value)
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    protected $fillable = [
        'name',
        'original_name',
        'mime',
        'extension',
        'size',
        'path',
        'user_id',
        'hash',
        'group',
    ];

    public function books(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'attachmentable');
    }

    public function collections(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'attachmentable');
    }

    public function attachmentable(): HasMany
    {
        return $this->hasMany(Attachmentable::class);
    }
}
