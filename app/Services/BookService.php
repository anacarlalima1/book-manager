<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks(int $perPage):  ?LengthAwarePaginator
    {
        return $this->bookRepository->getAll($perPage);
    }
    public function getBookById(int $id): ?Book
    {
        return $this->bookRepository->find($id);
    }
    public function createBook(array $data): Book
    {
        return $this->bookRepository->create($data);
    }

    public function updateBook(int $id, array $data): void
    {
        $this->bookRepository->update($id, $data);
    }

    public function deleteBook(int $id): void
    {
        $this->bookRepository->delete($id);
    }

}
