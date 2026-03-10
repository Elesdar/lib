<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $finish_date
 * @property int|null $rating
 * @property string|null $comment
 * @property bool $is_finished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReadingRecord> $readingRecords
 * @property-read int|null $reading_records_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingJournal whereUserId($value)
 * @mixin \Eloquent
 */
class ReadingJournal extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'start_date',
        'finish_date',
        'rating',
        'comment',
        'is_finished',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
        'is_finished' => 'boolean',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function readingRecords(): HasMany
    {
        return $this->hasMany(ReadingRecord::class);
    }
}
