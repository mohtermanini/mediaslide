<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Enums\RolesEnum;
use App\Enums\UserStatusesEnum;
use App\Helpers\ArrayHelpers;
use App\Http\Resources\FashionModel\FashionModelCollection;
use App\Http\Resources\FashionModel\FashionModelResource;
use App\Models\Category;
use App\Models\FashionModel;
use App\Models\FashionModelImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FashionModelControllerTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->createRandomUser(RolesEnum::ADMIN, UserStatusesEnum::ACTIVE);
    }

    public function test_can_get_all_fashion_models(): void
    {
        Sanctum::actingAs($this->admin);
        Category::factory()->has(FashionModel::factory()->count(3))->create();
        Category::factory()->has(FashionModel::factory()->count(2))->create();
        $fashionModels = FashionModel::all();

        $response = $this->getJson(route('fashion-models.index'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($fashionModels->count(), 'data')
            ->assertJson((new FashionModelCollection($fashionModels))->response()->getData(true));
    }

    public function test_can_get_fashion_models(): void
    {
        Sanctum::actingAs($this->admin);
        FashionModel::factory()->has(Category::factory())->create();
        $fashionModel = FashionModel::factory()->has(Category::factory())->create();

        $response = $this->getJson(route('fashion-models.show', ['id' => $fashionModel->id]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson((new FashionModelResource($fashionModel))->response()->getData(true));
    }

    public function test_can_create_a_fashion_model()
    {
        Sanctum::actingAs($this->admin);
        $fashionModelData = FashionModel::factory()->make();
        $fashionModelData = ArrayHelpers::snakeToCamelKeys(
            FashionModel::factory()->make()->toArray()
        );

        $fashionModelData['categoryId'] = Category::factory()->create()->id;

        $response = $this->postJson(route('fashion-models.store', $fashionModelData));

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas(FashionModel::class, [
            'name' => $fashionModelData['name'],
            'description' => $fashionModelData['description'],
            'date_of_birth' => $fashionModelData['dateOfBirth'],
            'shoe_size' => $fashionModelData['shoeSize'],
            'category_id' => $fashionModelData['categoryId'],
        ]);
    }

    public function test_can_update_a_fashion_model()
    {
        Sanctum::actingAs($this->admin);

        $fashionModel = FashionModel::factory()->has(Category::factory())->create();
        $newCategory = Category::factory()->create();
        $updatedData = ArrayHelpers::snakeToCamelKeys(
            FashionModel::factory()->make()->toArray()
        );
        $updatedData['categoryId'] = $newCategory->id;

        $response = $this->putJson(route('fashion-models.update', $fashionModel->id), $updatedData);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('fashion_models', [
            'id' => $fashionModel->id,
            'name' => $updatedData['name'],
            'description' => $updatedData['description'],
            'date_of_birth' => $updatedData['dateOfBirth'],
            'shoe_size' => $updatedData['shoeSize'],
            'category_id' => $updatedData['categoryId'],
        ]);
    }

    public function test_can_delete_a_fashion_model_with_images()
    {
        Sanctum::actingAs($this->admin);

        $fashionModel = FashionModel::factory()
            ->for(Category::factory())
            ->has(FashionModelImage::factory()->count(3))
            ->create();

        $response = $this->deleteJson(route('fashion-models.destroy', $fashionModel->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertSoftDeleted('fashion_models', [
            'id' => $fashionModel->id,
        ]);

        foreach ($fashionModel->fashionModelImages as $image) {
            $this->assertSoftDeleted('fashion_model_images', [
                'id' => $image->id,
            ]);
        }
    }
}
