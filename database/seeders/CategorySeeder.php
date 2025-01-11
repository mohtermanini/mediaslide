<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Runway',
                'children' => [
                    [
                        'name' => 'High Fashion',
                        'children' => [
                            ['name' => 'Seasonal Shows'],
                            ['name' => 'Designer Collections'],
                        ],
                    ],
                    [
                        'name' => 'Couture',
                        'children' => [
                            ['name' => 'Paris Fashion Week'],
                            ['name' => 'Milan Couture'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Editorial',
                'children' => [
                    [
                        'name' => 'Magazine',
                        'children' => [
                            ['name' => 'Vogue'],
                            ['name' => 'Harper’s Bazaar'],
                        ],
                    ],
                    [
                        'name' => 'Artistic',
                        'children' => [
                            ['name' => 'Concept Shoots'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Commercial',
                'children' => [
                    [
                        'name' => 'Advertising',
                        'children' => [
                            ['name' => 'TV Commercials'],
                            ['name' => 'Billboards'],
                        ],
                    ],
                    ['name' => 'Catalog'],
                ],
            ],
        ];

        foreach ($categories as $category) {
            $this->createCategory($category, null);
        }
    }

    private function createCategory(array $category, $parentId): void
    {
        $parent = Category::create([
            'name' => $category['name'],
            'category_id' => $parentId,
        ]);

        if (!empty($category['children'])) {
            foreach ($category['children'] as $child) {
                $this->createCategory($child, $parent->id);
            }
        }
    }
}
