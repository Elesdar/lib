<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\Library;

class CreateDefaultLibrary
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
        $title = trans('library.default.title');

        try {
            Library::create([
                'user_id' => $userId,
                'title' => $title,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
