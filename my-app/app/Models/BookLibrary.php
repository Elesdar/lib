<?php

namespace App\Models;

use App\Enums\BookCoverFormat;
use App\Enums\BookFormat;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $book_id
 * @property int $library_id
 * @property BookFormat $format
 * @property string|null $isbn
 * @property string|null $purchase_price
 * @property \Illuminate\Support\Carbon|null $purchase_date
 * @property string|null $purchase_place
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary wherePurchasePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookLibrary whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookLibrary extends Model
{
    /**
     * Указывает, что идентификаторы модели являются автоинкрементными.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'book_library';

    protected $fillable = [
        'book_id',
        'library_id',
        'format',
        'isbn',
        'year',
        'publisher',
        'cover_format',
        'purchase_price',
        'purchase_date',
        'purchase_place',
        'note',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'format' => BookFormat::class,
        'year' => 'datetime',
        'cover_format' => BookCoverFormat::class,
    ];
}
