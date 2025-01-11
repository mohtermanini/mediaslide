<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FashionModel;
use App\Models\FashionModelImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FashionModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FashionModel::factory()
            ->for(Category::inRandomOrder()->firstOrFail())
            ->has(FashionModelImage::factory()->count(3))
            ->create();

        FashionModel::factory()
            ->for(Category::inRandomOrder()->firstOrFail())
            ->has(FashionModelImage::factory()->count(2))
            ->create();

        FashionModel::factory()
            ->for(Category::inRandomOrder()->firstOrFail())
            ->has(FashionModelImage::factory()->count(1))
            ->create();
    }
}
