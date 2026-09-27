<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Slug\Facades\SlugHelper;
use Illuminate\Support\Arr;

class ProductCategorySeeder extends BaseSeeder
{
    public function run(): void
    {
        $categories = [
            1 => [
                'name' => 'Women',
                'children' => [
                    13 => ['name' => 'Dresses'],
                    14 => ['name' => 'Tops'],
                    15 => ['name' => 'Jackets'],
                ],
            ],
            2 => [
                'name' => 'Men',
                'children' => [
                    16 => ['name' => 'Shirts'],
                    17 => ['name' => 'Hoodies'],
                    18 => ['name' => 'Pants'],
                ],
            ],
            3 => [
                'name' => 'Blazers',
            ],
            4 => [
                'name' => 'Coats',
            ],
            5 => [
                'name' => 'Sweaters',
            ],
            6 => [
                'name' => 'Knitwear',
            ],
            7 => [
                'name' => 'Outerwear',
            ],
            8 => [
                'name' => 'Accessories',
            ],
            9 => [
                'name' => 'Sweatshirts',
            ],
            10 => [
                'name' => 'Scarves',
            ],
            11 => [
                'name' => 'Cardigans',
            ],
            12 => [
                'name' => 'New Arrivals',
            ],
        ];

        ProductCategory::query()->truncate();

        foreach ($categories as $index => $item) {
            $this->createCategoryItem($index, $item);
        }
    }

    protected function createCategoryItem(int $index, array $category, int $parentId = 0): void
    {
        $category['is_featured'] = $index <= 12;
        $category['parent_id'] = $parentId;
        $category['order'] = $index;
        $category['description'] = 'Curated fashion pieces designed with purpose, blending modern aesthetics with timeless craftsmanship.';

        if (Arr::has($category, 'children')) {
            $children = $category['children'];
            unset($category['children']);
        } else {
            $children = [];
        }

        $createdCategory = ProductCategory::query()->create(Arr::except($category, ['icon']));

        SlugHelper::createSlug($createdCategory);

        if (isset($category['icon'])) {
            MetaBox::saveMetaBoxData($createdCategory, 'icon', $category['icon']);
        }

        if ($children) {
            foreach ($children as $childIndex => $child) {
                $this->createCategoryItem($childIndex, $child, $createdCategory->id);
            }
        }
    }
}
