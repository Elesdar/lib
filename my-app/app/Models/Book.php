<?php

namespace App\Models;

use App\Enums\BookType;
use App\Traits\Attachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use PharIo\Manifest\Library;

/**
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property BookType $type
 * @property int $books_list_id
 * @property string|null $description
 * @property int $read_count
 * @property int|null $count_pages
 * @property int|null $count_finished_pages
 * @property string|null $author
 * @property \Illuminate\Support\Carbon|null $publishing_date
 * @property int|null $rating
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attachment> $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\BooksList $booksList
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Collection> $collections
 * @property-read int|null $collections_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReadingJournal> $readingJournals
 * @property-read int|null $reading_journals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReadingRecord> $readingRecords
 * @property-read int|null $reading_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereBooksListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCountFinishedPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCountPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book wherePublishingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereReadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Book whereUserId($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use Attachable,
        HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'type',
        'books_list_id',
        'description',
        'count_pages',
        'read_count',
        'count_finished_pages',
        'author',
        'publishing_date',
        'rating',
        'note',  // TODO ВЫНЕСТИ ЗАМЕТКИ ОТДЕЛЬНО
    ];

    protected $casts = [
        'publishing_date' => 'datetime',
        'type' => BookType::class,
    ];

    public function booksList(): BelongsTo
    {
        return $this->belongsTo(BooksList::class);
    }

    public function attachments(): MorphToMany
    {
        return $this->morphToMany(Attachment::class, 'attachmentable', 'attachmentable');
    }

    public function libraries(): BelongsToMany
    {
        return $this->belongsToMany(Library::class);
    }

    public function readingRecords(): HasMany
    {
        return $this->hasMany(ReadingRecord::class);
    }

    public function readingJournals(): HasMany
    {
        return $this->hasMany(ReadingJournal::class);
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
