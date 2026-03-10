<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRecords\ReadingRecordRequest;
use App\Http\Requests\ReadingRecords\ReadingRecordUpdateRequest;
use App\Http\Resources\ReadingRecordResource;
use App\Models\Book;
use App\Models\ReadingJournal;
use App\Models\ReadingRecord;
use App\Services\BookReadingHistoryService;
use App\Services\ReadingJournalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ReadingRecordController extends Controller
{
    public function store(
        ReadingRecordRequest $request,
        ReadingJournalService $readingJournalService,
    ): JsonResponse {
        try {
            $readingRecordData = $request->validated();
            $readingRecordData['user_id'] = $request->user()->id;
            DB::transaction(function () use ($readingRecordData, $readingJournalService): void {
                if (! $readingRecordData['reading_journal_id']) {
                    $readingRecordData['reading_journal_id'] = $readingJournalService->findOrCreateReadingJournal($readingRecordData['book_id']);
                }

                ReadingRecord::create($readingRecordData);
                $book = Book::findOrFail($readingRecordData['book_id']);
                $book->update([
                    'count_finished_pages' => $readingRecordData['last_finished_page'],
                ]);
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно добавлена',
        ]);
    }

    public function update(
        ReadingRecordUpdateRequest $request,
        ReadingRecord $readingRecord,
        BookReadingHistoryService $bookReadingHistoryService
    ): JsonResponse {
        try {
            DB::transaction(function () use ($request, $readingRecord, $bookReadingHistoryService): void {
                $readingRecord->update($request->validated());
                $bookReadingHistoryService->changeCountFinishedPages($readingRecord);
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно обновлена',
        ]);
    }

    public function destroy(ReadingRecord $readingRecord, BookReadingHistoryService $bookReadingHistoryService): JsonResponse
    {
        try {
            DB::transaction(function () use ($readingRecord, $bookReadingHistoryService): void {
                $bookReadingHistoryService->changeCountFinishedPagesAfterDeletingRecord($readingRecord);
                $readingRecord->delete();
            });
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно удалена',
        ]);
    }

    public function show(ReadingRecord $readingRecord): JsonResource
    {
        try {
            return $readingRecord->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index(ReadingJournal $readingJournal): JsonResource
    {
        try {
            $readingRecords = ReadingRecord::where('reading_journal_id', $readingJournal->id)->get();

            return ReadingRecordResource::collection($readingRecords);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
