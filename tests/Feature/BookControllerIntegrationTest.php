<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;


    public function test_index_displays_books()
    {
        Book::factory(10)->create();

        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertViewIs('books.index');
        $response->assertViewHas('books');
    }

    public function test_can_create_book()
    {
        $data = [
            'title' => 'Test Book',
            'author' => 'Author Test',
            'description' => 'Test description',
            'publication_year' => 2022,
        ];

        $response = $this->post(route('books.store'), $data);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', $data);
    }

    public function test_can_update_book()
    {
        $book = Book::factory()->create();

        $updatedData = [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'description' => $book->description,
            'publication_year' => $book->publication_year,
        ];

        $response = $this->put(route('books.update', $book->id), $updatedData);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', $updatedData);
    }

    public function test_can_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_show_displays_book_details()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('books.show', $book->id));

        $response->assertStatus(200);
        $response->assertViewIs('books.show');
        $response->assertViewHas('book', $book);
    }
}
