<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    public function getAll(int $perPage): ?LengthAwarePaginator;
    public function find(int $id): ?Book;

    public function create(array $book): Book;

    public function update(int $id, array $book): void;

    public function delete(int $id): void;
}
