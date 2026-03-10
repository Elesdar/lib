<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BooksListStatus;
use App\Models\Book;
use App\Models\ReadingRecord;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BookReadingHistoryService
{
    public function addBookToProgressList(int $bookId): void
    {
        $book = Book::findOrFail($bookId);
        if ($book->books_list_id === BooksListStatus::IN_PROGRESS) {
            return;
        } else {
            $book->update(['books_list_id' => BooksListStatus::IN_PROGRESS]);
        }
    }

    // страницы книги обновляются, только тогда, когда журнал не закончен и запись последняя
    public function changeCountFinishedPages(ReadingRecord $readingRecord): void
    {
        $book = $readingRecord->book;
        $readingJournal = $readingRecord->readingJournal;

        if ($readingJournal->is_finished === true) {
            return;
        }

        $lastRecord = $book->readingRecords()->orderByDesc('date')->first();
        if ($lastRecord->id === $readingRecord->id) {
            $book->update([
                'count_finished_pages' => $readingRecord->last_finished_page,
            ]);
        }
    }

    public function changeCountFinishedPagesAfterDeletingRecord(ReadingRecord $readingRecord): void
    {
        $book = $readingRecord->book()->with(['readingRecords' => function (Builder $query) {
            $query->orderByDesc('date');
        }])->first();
        $readingJournal = $readingRecord->readingJournal;

        if ($readingJournal->is_finished === true) {
            return;
        }

        $lastRecord = $book->readingRecords->first();

        $preLastRecord = $book->readingRecords->get(1);

        if (! $preLastRecord) {
            $book->update([
                'count_finished_pages' => 0,
            ]);

            return;
        }

        if ($lastRecord->id === $readingRecord->id) {
            $book->update([
                'count_finished_pages' => $preLastRecord->last_finished_page,
            ]);
        }
    }
}
