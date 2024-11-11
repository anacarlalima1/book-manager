<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    public function getAll(int $perPage): ?LengthAwarePaginator
    {
        return Book::paginate($perPage);
    }
    public function find(int $id): ?Book
    {
        return Book::find($id);
    }

    public function create(array $book): Book
    {
       return Book::create($book);
    }

    public function update(int $id, array $book): void
    {
         Book::findOrFail($id)->update($book);
    }

    public function delete(int $id): void
    {
        Book::findOrFail($id)->delete();
    }
}
