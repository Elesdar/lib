<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLibraryController;
use App\Http\Controllers\BooksListController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReadingJournalController;
use App\Http\Controllers\ReadingRecordController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api');
Route::get('/user/check', [AuthController::class, 'isAuthorized']);

Route::post('file', [AttachmentController::class, 'upload'])->name('file.upload')->middleware('auth:api');
Route::prefix('books')->name('books.')->middleware('auth:api')->group(function () {
    Route::post('', [BookController::class, 'store'])->name('store');
    Route::put('/{book}', [BookController::class, 'update'])->name('update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
    Route::post('/{book}/add-tag', [BookController::class, 'addTag'])->name('addTag');
});

Route::prefix('tags')->name('tags.')->middleware('auth:api')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/{tag}', [TagController::class, 'show'])->name('show');
    Route::post('', [TagController::class, 'store'])->name('store');
    Route::put('/{tag}', [TagController::class, 'update'])->name('update');
    Route::delete('/{tag}', [TagController::class, 'destroy'])->name('destroy');
});

Route::prefix('books-list')->name('books-list.')->middleware('auth:api')->group(function () {
    Route::get('/', [BooksListController::class, 'index'])->name('index');
    Route::get('/{booksList}', [BooksListController::class, 'show'])->name('show');
});

Route::prefix('libraries')->name('libraries.')->middleware('auth:api')->group(function () {
    Route::post('', [LibraryController::class, 'store'])->name('store');
    Route::put('/{library}', [LibraryController::class, 'update'])->name('update');
    Route::delete('/{library}', [LibraryController::class, 'destroy'])->name('destroy');
    Route::get('/', [LibraryController::class, 'index'])->name('index');
    Route::get('/{library}', [LibraryController::class, 'show'])->name('show');
});

Route::prefix('book-library')->name('book-library.')->middleware('auth:api')->group(function () {
    Route::post('', [BookLibraryController::class, 'addBook'])->name('add');
    Route::put('/{bookLibrary}', [BookLibraryController::class, 'updateBook'])->name('update');
    Route::delete('/{bookLibrary}', [BookLibraryController::class, 'removeBook'])->name('remove');
});

Route::prefix('reading-journals')->name('reading-journals.')->middleware('auth:api')->group(function () {
    Route::post('', [ReadingJournalController::class, 'store'])->name('store');
    Route::get('/{readingJournal}', [ReadingJournalController::class, 'show'])->name('show');
    Route::delete('/{readingJournal}', [ReadingJournalController::class, 'destroy'])->name('destroy');
    Route::get('/list/{book}', [ReadingJournalController::class, 'listByBook'])->name('list');
    Route::put('/comment/{readingJournal}', [ReadingJournalController::class, 'updateComment'])->name('updateComment');
    Route::put('/finish-date/{readingJournal}/', [ReadingJournalController::class, 'updateFinishDate'])->name('updateFinishDate');
    Route::put('/start-date/{readingJournal}', [ReadingJournalController::class, 'updateStartDate'])->name('updateStartDate');
    Route::put('/finish-reading/{readingJournal}', [ReadingJournalController::class, 'finishReadingJournal'])->name('finishReadingJournal');
});

Route::prefix('reading-records')->name('reading-records.')->middleware('auth:api')->group(function () {
    Route::post('', [ReadingRecordController::class, 'store'])->name('store');
    Route::put('/{readingRecord}', [ReadingRecordController::class, 'update'])->name('update');
    Route::delete('/{readingRecord}', [ReadingRecordController::class, 'destroy'])->name('destroy');
    Route::get('/reading-journal/{readingJournal}', [ReadingRecordController::class, 'index'])->name('index');
    Route::get('/{readingRecord}', [ReadingRecordController::class, 'show'])->name('show');
});

Route::prefix('collections')->name('collections.')->middleware('auth:api')->group(function () {
    Route::post('', [CollectionController::class, 'store'])->name('store');
    Route::put('/{collection}', [CollectionController::class, 'update'])->name('update');
    Route::delete('/{collection}', [CollectionController::class, 'destroy'])->name('destroy');
    Route::get('/', [CollectionController::class, 'index'])->name('index');
    Route::get('/{collection}', [CollectionController::class, 'show'])->name('show');
    Route::post('/add-book', [CollectionController::class, 'addBook'])->name('addBook');
    Route::post('/remove-book', [CollectionController::class, 'removeBook'])->name('removeBook');
});

Route::post('/login', [AuthController::class, 'login'])->middleware(CheckAuth::class);
Route::post('/register', [AuthController::class, 'register'])->middleware(CheckAuth::class);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
