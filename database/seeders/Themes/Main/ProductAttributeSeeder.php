<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\ProductAttribute;
use Botble\Ecommerce\Models\ProductAttributeSet;

class ProductAttributeSeeder extends BaseSeeder
{
    public function run(): void
    {
        ProductAttributeSet::query()->truncate();

        ProductAttributeSet::query()->create([
            'title' => 'Color',
            'slug' => 'color',
            'display_layout' => 'visual',
            'is_searchable' => true,
            'is_use_in_product_listing' => true,
            'order' => 0,
        ]);

        ProductAttributeSet::query()->create([
            'title' => 'Size',
            'slug' => 'size',
            'display_layout' => 'text',
            'is_searchable' => true,
            'is_use_in_product_listing' => true,
            'order' => 1,
        ]);

        ProductAttribute::query()->truncate();

        $productAttributes = [
            [
                'attribute_set_id' => 1,
                'title' => 'Brown',
                'slug' => 'brown',
                'color' => '#6c4d38',
                'is_default' => true,
                'order' => 1,
            ],
            [
                'attribute_set_id' => 1,
                'title' => 'Cream',
                'slug' => 'cream',
                'color' => '#f2f1f0',
                'is_default' => false,
                'order' => 2,
            ],
            [
                'attribute_set_id' => 1,
                'title' => 'Sage',
                'slug' => 'sage',
                'color' => '#9eb095',
                'is_default' => false,
                'order' => 3,
            ],
            [
                'attribute_set_id' => 1,
                'title' => 'Navy',
                'slug' => 'navy',
                'color' => '#37415f',
                'is_default' => false,
                'order' => 4,
            ],
            [
                'attribute_set_id' => 1,
                'title' => 'Beige',
                'slug' => 'beige',
                'color' => '#d0c89f',
                'is_default' => false,
                'order' => 5,
            ],
            [
                'attribute_set_id' => 2,
                'title' => 'S',
                'slug' => 's',
                'is_default' => true,
                'order' => 1,
            ],
            [
                'attribute_set_id' => 2,
                'title' => 'M',
                'slug' => 'm',
                'is_default' => false,
                'order' => 2,
            ],
            [
                'attribute_set_id' => 2,
                'title' => 'L',
                'slug' => 'l',
                'is_default' => false,
                'order' => 3,
            ],
            [
                'attribute_set_id' => 2,
                'title' => 'XL',
                'slug' => 'xl',
                'is_default' => false,
                'order' => 4,
            ],
            [
                'attribute_set_id' => 2,
                'title' => 'XXL',
                'slug' => 'xxl',
                'is_default' => false,
                'order' => 5,
            ],
        ];

        foreach ($productAttributes as $item) {
            ProductAttribute::query()->create($item);
        }
    }
}
