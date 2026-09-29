<?php

use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\TextField;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;

register_page_template([
    'default' => __('Default'),
    'homepage' => __('Homepage'),
    'full-width' => __('Full Width'),
]);

app()->booted(function () {
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerSocialSharing();
    ThemeSupport::registerSiteCopyright();

    register_sidebar([
        'id' => 'main_sidebar',
        'name' => __('Main Sidebar'),
        'description' => __('Blog sidebar'),
    ]);

    // Add custom theme options
    add_filter('theme_options_general', function ($form) {
        $form
            ->add('hero_name', TextField::class, TextFieldOption::make()->label(__('Hero Name'))->value(theme_option('hero_name', 'Rakib')))
            ->add('hero_typed', TextField::class, TextFieldOption::make()->label(__('Hero Typed Text'))->value(theme_option('hero_typed', 'Full Stack Developer')))
            ->add('social_github', TextField::class, TextFieldOption::make()->label(__('GitHub URL'))->value(theme_option('social_github')))
            ->add('social_linkedin', TextField::class, TextFieldOption::make()->label(__('LinkedIn URL'))->value(theme_option('social_linkedin')))
            ->add('social_twitter', TextField::class, TextFieldOption::make()->label(__('Twitter URL'))->value(theme_option('social_twitter')))
            ->add('social_dribbble', TextField::class, TextFieldOption::make()->label(__('Dribbble URL'))->value(theme_option('social_dribbble')))
            ->add('phone', TextField::class, TextFieldOption::make()->label(__('Phone'))->value(theme_option('phone')))
            ->add('address', TextField::class, TextFieldOption::make()->label(__('Address'))->value(theme_option('address', 'Dhaka, Bangladesh')));

        return $form;
    }, 120);
});

// Include shortcodes
require_once __DIR__ . '/shortcodes.php';
