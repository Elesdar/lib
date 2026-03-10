<?php

namespace App\Models;

use App\Enums\BooksListStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property BooksListStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @property-read int|null $books_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BooksList whereUserId($value)
 * @mixin \Eloquent
 */
class BooksList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => BooksListStatus::class,
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
