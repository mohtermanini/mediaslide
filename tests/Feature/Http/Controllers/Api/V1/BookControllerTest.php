<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Http\Resources\Book\BookCollection;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    //execute each test within a database transaction and rollback after each test
    use RefreshDatabase;
    private $alice;

    protected function setUp(): void
    {
        parent::setUp();
        $this->alice = $this->createRandomUser();
    }

    public function test_can_get_all_books(): void
    {
        Sanctum::actingAs($this->alice);
        Category::factory()->has(Book::factory()->count(3))->create();
        Category::factory()->has(Book::factory()->count(2))->create();
        Book::factory()->state(['title' => 'Test Book'])->for(Category::factory())->has(Author::factory())->create();
        $books = Book::all();

        //add [Accept: application/json] header
        $response = $this->getJson(route('books.index'));

        $response->assertStatus(Response::HTTP_OK)
            //true if value at given [key] is array and its items count are [count]
            ->assertJsonCount($books->count(), 'data')
            //true if given json [subarray] is a subarray of response
            //singular and collection api resources response is automatically wrapped with [data] key
            ->assertJson((new BookCollection($books))->response()->getData(true));
    }

    public function test_can_create_a_book()
    {
        Sanctum::actingAs($this->alice);
        $book_data = Book::factory()->make();
        $book_data['categoryId'] = Category::factory()->create()->id;
        $book_data['authorIds'] = Author::factory()->count(3)->create()->pluck('id')->toArray();

        //add [Accept: application/json] header
        $response = $this->postJson(route('books.store', $book_data->toArray()));

        $response->assertStatus(Response::HTTP_CREATED);
        //assert table has record match the given [array]
        $this->assertDatabaseHas(
            Book::class,
            $book_data->only(['title', 'description']) + ['category_id' => $book_data['categoryId']]
        );
        foreach ($book_data->authorIds as $authorId) {
            $this->assertDatabaseHas('author_book', ['author_id' => $authorId]);
        }
    }
}
