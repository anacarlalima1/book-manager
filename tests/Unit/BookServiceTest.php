<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use App\Services\BookService;
use PHPUnit\Framework\TestCase;

class BookServiceTest extends TestCase
{
    private $bookRepositoryMock;
    private $bookService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bookRepositoryMock = $this->createMock(BookRepositoryInterface::class);

        $this->bookService = new BookService($this->bookRepositoryMock);
    }

    public function test_can_create_book()
    {
        $data = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'description' => 'A test description',
            'publication_year' => 2024,
        ];

        $book = new Book($data);

        $this->bookRepositoryMock->expects($this->once())
            ->method('create')
            ->with($data)
            ->willReturn($book);

        $result = $this->bookService->createBook($data);

        $this->assertInstanceOf(Book::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['author'], $result->author);
    }

    public function test_can_update_book()
    {
        $bookId = 1;
        $updatedData = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'description' => 'Updated Description',
            'publication_year' => 2025,
        ];

        $this->bookRepositoryMock->expects($this->once())
            ->method('update')
            ->with($bookId, $updatedData);

        $this->bookService->updateBook($bookId, $updatedData);

        $this->assertTrue(true);
    }

    public function test_can_delete_book()
    {
        $bookId = 1;

        $this->bookRepositoryMock->expects($this->once())
            ->method('delete')
            ->with($bookId);

        $this->bookService->deleteBook($bookId);

        $this->assertTrue(true);
    }

    public function test_can_get_all_books()
    {
        $books = [
            new Book(['title' => 'Book 1', 'author' => 'Author 1']),
            new Book(['title' => 'Book 2', 'author' => 'Author 2']),
        ];

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $books, // Itens
            count($books), // Total
            10, // Por página
            1 // Página atual
        );

        // Mockando o método getAll para retornar um paginador
        $this->bookRepositoryMock->expects($this->once())
            ->method('getAll')
            ->with(10)
            ->willReturn($paginator);

        $result = $this->bookService->getAllBooks(10);

        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);
        $this->assertCount(2, $result->items());
        $this->assertEquals('Book 1', $result->items()[0]->title);
        $this->assertEquals('Book 2', $result->items()[1]->title);
    }
}
