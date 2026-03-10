<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReadingJournals\ReadingJournalStoreRequest;
use App\Http\Requests\ReadingJournals\ReadingJournalUpdateCommentRequest;
use App\Http\Requests\ReadingJournals\ReadingJournalUpdateFinishDateRequest;
use App\Http\Requests\ReadingJournals\ReadingJournalUpdateStartDateRequest;
use App\Http\Resources\ReadingJournalResource;
use App\Models\Book;
use App\Models\ReadingJournal;
use App\Services\ReadingJournalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingJournalController extends Controller
{
    public function store(
        ReadingJournalStoreRequest $request,
        ReadingJournalService $readingJournalService,
    ): JsonResponse {
        try {
            $readingJournalData = $request->validated();

            if ($readingJournalService->checkActiveJournal($readingJournalData['book_id'])) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Для этой книги уже создан журнал чтения',
                ]);
            }

            $readingJournalService->createReadingJournal($readingJournalData);

        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Журнал успешно добавлен',
        ]);
    }

    // если журнал закончен, то уменьшается количество прочтений,
    // если не закончен, то обнуляется количество прочитанных страниц в книге
    public function destroy(ReadingJournal $readingJournal, ReadingJournalService $readingJournalService): JsonResponse
    {
        try {
            $readingJournalService->deleteReadingJournal($readingJournal);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно удалена',
        ]);
    }

    public function show(ReadingJournal $readingJournal): JsonResource
    {
        try {
            return $readingJournal->toResource();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function listByBook(Book $book): JsonResource
    {
        try {
            return ReadingJournalResource::collection($book->readingJournals);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // Возможность оставлять комментарий появляется, только если журнал чтения окончен
    public function updateComment(ReadingJournalUpdateCommentRequest $request, ReadingJournal $readingJournal): JsonResponse
    {
        try {
            if ($readingJournal->is_finished === true) {
                $readingJournal->update($request->validated());
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Условия не соблюдены',
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно обновлена',
        ]);
    }

    public function updateStartDate(ReadingJournalUpdateStartDateRequest $request, ReadingJournal $readingJournal): JsonResponse
    {
        try {
            $readingJournal->update($request->validated());
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно обновлена',
        ]);
    }

    public function updateFinishDate(
        ReadingJournalUpdateFinishDateRequest $request,
        ReadingJournal $readingJournal,
    ): JsonResponse {
        try {
            $readingJournal->update(['finish_date' => $request->get('finish_date')]);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно обновлена',
        ]);
    }

    // по завершении книга должна меняет статус, кол-во прочитанных страниц на 0, и количество прочтений на +1
    public function finishReadingJournal(
        ReadingJournalUpdateFinishDateRequest $request,
        ReadingJournal $readingJournal,
        ReadingJournalService $readingJournalService
    ): JsonResponse {
        try {
            $readingJournalService->finishReadingJournal($readingJournal, $request->get('finish_date'));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'status' => 200,
            'message' => 'Запись успешно обновлена',
        ]);
    }
}
