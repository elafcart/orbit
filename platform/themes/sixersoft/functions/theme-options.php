<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\ThemeOption\Fields\ColorField;
use Botble\Theme\ThemeOption\Fields\TextField;
use Botble\Theme\ThemeOption\Fields\TextareaField;
use Botble\Theme\ThemeOption\Fields\ToggleField;

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    theme_option()
        ->setSection([
            'title' => __('Sixersoft'),
            'id' => 'opt-text-subsection-sixersoft',
            'subsection' => true,
            'icon' => 'ti ti-brush',
            'fields' => [
                ColorField::make()
                    ->name('primary_color')
                    ->label(__('Primary Color'))
                    ->helperText(__('Brand color used across buttons, links and accents.'))
                    ->defaultValue('#4f46e5'),
                TextField::make()
                    ->name('hero_title')
                    ->label(__('Fallback Homepage: Hero Title'))
                    ->helperText(__('Shown on the built-in homepage only (before a page is set as homepage).'))
                    ->defaultValue('Build something extraordinary'),
                TextareaField::make()
                    ->name('hero_subtitle')
                    ->label(__('Fallback Homepage: Hero Subtitle'))
                    ->defaultValue('Sixersoft is a basic Botble CMS starter theme powered by Tailwind CSS, GSAP and Vite.'),
                ToggleField::make()
                    ->name('animations_enabled')
                    ->label(__('Enable scroll animations (GSAP)'))
                    ->helperText(__('Disable for absolute maximum performance or a fully static experience. Menus, dark mode and other UI keep working.'))
                    ->defaultValue(true),
            ],
        ]);
});
