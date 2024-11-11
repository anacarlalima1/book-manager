<?php

namespace App\Http\Controllers;

use App\Events\BookCreated;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks(10);
        return view('books.index', compact('books'));
    }
    public function show(int $id)
    {

        $book = $this->bookService->getBookById($id);

        if (!$book) {
            abort(404, 'Livro não encontrado.');
        }

        return view('books.show', compact('book'));
    }
    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $validated = $request->validated();

        // Cria o livro e retorna a instância
        $book = $this->bookService->createBook($validated);

        // Dispara o evento
        event(new BookCreated($book));

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, int $id)
    {
        $this->bookService->updateBook($id, $request->validated());

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy(int $id)
    {
        $this->bookService->deleteBook($id);

        return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso.');
    }
}
