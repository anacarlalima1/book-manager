<?php

namespace App\Listeners;

use App\Events\BookCreated;
use App\Jobs\SendBookNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BookCreated  $event
     * @return void
     */
    public function handle(BookCreated $event)
    {
        Log::info('Livro criado: ', ['Título' => $event->book->title]);
        SendBookNotification::dispatch($event->book);
    }
}
