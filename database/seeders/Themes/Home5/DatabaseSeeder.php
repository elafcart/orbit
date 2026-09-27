<?php

namespace Database\Seeders\Themes\Home5;

use Database\Seeders\TranslationSeeder;

class DatabaseSeeder extends \Database\Seeders\Themes\Main\DatabaseSeeder
{
    public function getSeeders(): array
    {
        $parentSeeders = array_filter(
            parent::getSeeders(),
            fn ($s) => $s !== TranslationSeeder::class
        );

        return [
            ...$parentSeeders,
            PageSeeder::class,
            ThemeOptionSeeder::class,
            WidgetSeeder::class,
            TranslationSeeder::class,
        ];
    }
}
