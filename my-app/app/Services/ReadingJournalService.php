<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BooksListStatus;
use App\Models\Book;
use App\Models\ReadingJournal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReadingJournalService
{
    public function checkActiveJournal(int $bookId): ?ReadingJournal
    {
        $activeJournal = ReadingJournal::where('book_id', $bookId)->where('is_finished', false)->first();

        return $activeJournal;
    }

    public function findOrCreateReadingJournal(int $bookId): int
    {
        $readingJournal = ReadingJournal::where('book_id', $bookId)->where('is_finished', false)->first();
        if ($readingJournal) {
            return $readingJournal->id;
        } else {
            $readingJournal = $this->createReadingJournal([
                'book_id' => $bookId,
                'start_date' => Carbon::today(),
            ]);

            return $readingJournal->id;
        }
    }

    public function finishReadingJournal(ReadingJournal $readingJournal, $finishDate): void
    {
        DB::transaction(function () use ($readingJournal, $finishDate) {
            $readingJournal->update(['finish_date' => $finishDate, 'is_finished' => true]);
            $book = Book::findOrFail($readingJournal->book_id);
            $book->update([
                'count_finished_pages' => 0,
                'read_count' => $book->read_count + 1,
                'books_list_id' => BooksListStatus::FINISHED,
            ]);
        });
    }

    public function deleteReadingJournal(ReadingJournal $readingJournal): void
    {
        DB::transaction(function () use ($readingJournal) {
            $book = Book::findOrFail($readingJournal->book_id);
            if ($readingJournal->is_finished === true) {
                $book->update([
                    'read_count' => $book->read_count - 1,
                ]);
            } else {
                $book->update([
                    'count_finished_pages' => 0,
                ]);
            }
            $readingJournal->delete();
        });
    }

    public function createReadingJournal(array $readingJournalData): ReadingJournal
    {
        DB::transaction(function () use ($readingJournalData) {
            $readingJournalData['user_id'] = request()->user()->id;
            $readingJournalData['is_finished'] = false;

            $bookReadingHistoryService = new BookReadingHistoryService;
            $bookReadingHistoryService->addBookToProgressList($readingJournalData['book_id']);

            return ReadingJournal::create($readingJournalData);
        });

        abort(400, 'Произошла ошибка при создании журнала');
    }
}
