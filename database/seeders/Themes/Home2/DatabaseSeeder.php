<?php

namespace Database\Seeders\Themes\Home2;

use Database\Seeders\TranslationSeeder;

class DatabaseSeeder extends \Database\Seeders\Themes\Main\DatabaseSeeder
{
    public function getSeeders(): array
    {
        // Filter out TranslationSeeder from parent so it runs LAST after Home2 overrides
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
