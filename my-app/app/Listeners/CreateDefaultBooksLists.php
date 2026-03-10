<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\BooksListStatus;
use App\Events\UserCreatedEvent;
use App\Models\BooksList;

class CreateDefaultBooksLists
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $userId = $event->user->id;

        try {
            foreach (BooksListStatus::cases() as $case) {
                BooksList::create(
                    [
                        'user_id' => $userId,
                        'status' => $case->value,
                    ]
                );
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
