<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBookNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function handle()
    {
        Mail::raw("Um novo livro '{$this->book->title}' acabou de ser criado.", function ($message) {
            $message->to('anacarlan07@gmail.com')->subject('Novo Livro Criado');
        });
    }
}
