<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Ecommerce\Models\ProductTag;
use Botble\Slug\Facades\SlugHelper;

class ProductTagSeeder extends BaseSeeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Fashion'],
            ['name' => 'Casual'],
            ['name' => 'Formal'],
            ['name' => 'Winter'],
            ['name' => 'Streetwear'],
            ['name' => 'Essentials'],
        ];

        ProductTag::query()->truncate();

        foreach ($tags as $item) {
            $tag = ProductTag::query()->create($item);

            SlugHelper::createSlug($tag);
        }
    }
}
