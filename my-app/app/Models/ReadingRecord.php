<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property int $reading_journal_id
 * @property int $last_finished_page
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\ReadingJournal $readingJournal
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereLastFinishedPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereReadingJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReadingRecord whereUserId($value)
 * @mixin \Eloquent
 */
class ReadingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'count_pages',
        'last_finished_page',
        'date',
        'user_id',
        'reading_journal_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function readingJournal(): BelongsTo
    {
        return $this->belongsTo(ReadingJournal::class);
    }
}
