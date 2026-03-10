<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUnusedAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unused-attachments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused attachments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $attachments = Attachment::query()->whereDoesntHave('attachmentable')->get();

        foreach ($attachments as $attachment) {
            if (Attachment::query()->where('path', $attachment->path)->count() > 1) {
                $attachment->delete();
            } else {
                Storage::delete($attachment->path);
                $attachment->delete();
            }
        }

        $this->info('Проверка неиспользуемых файлов завершена.');
    }
}
