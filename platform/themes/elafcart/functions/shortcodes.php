<?php

use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Theme\Facades\Theme;
use Theme\Elafcart\Forms\ShortcodeForm;

app()->booted(function () {
    if (!function_exists('shortcode')) {
        return;
    }

    // Hero
    Shortcode::register('hero', 'Hero Section', 'Portfolio hero banner', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.hero.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('hero', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Hi, I\'m Rakib'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle / Typed Text')->defaultValue('Full Stack Developer'))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label('Description'))
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label('Hero Image'))
            ->add('button_text_1', TextField::class, TextFieldOption::make()->label('Button 1 Text')->defaultValue('View My Work'))
            ->add('button_link_1', TextField::class, TextFieldOption::make()->label('Button 1 Link')->defaultValue('#projects'))
            ->add('button_text_2', TextField::class, TextFieldOption::make()->label('Button 2 Text')->defaultValue('Download CV'))
            ->add('button_link_2', TextField::class, TextFieldOption::make()->label('Button 2 Link'));
    });

    // About
    Shortcode::register('about', 'About Section', 'About me section', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.about.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('about', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('About Me'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle'))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label('Description'))
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label('Image'))
            ->add('name', TextField::class, TextFieldOption::make()->label('Name'))
            ->add('email', TextField::class, TextFieldOption::make()->label('Email'))
            ->add('location', TextField::class, TextFieldOption::make()->label('Location'));
    });

    // Services
    Shortcode::register('services', 'Services', 'Services list', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.services.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('services', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('What I Do'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Services'))
            ->add('description', TextareaField::class, TextFieldOption::make()->label('Description'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(6));
    });

    // Projects
    Shortcode::register('projects', 'Projects', 'Portfolio projects', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.projects.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('projects', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Selected Works'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Portfolio'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(6));
    });

    // Skills
    Shortcode::register('skills', 'Skills', 'My skills', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.skills.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('skills', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('My Skills'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Expertise'));
    });

    // Experience
    Shortcode::register('experience', 'Experience', 'Work experience timeline', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.experience.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('experience', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Experience'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Work History'));
    });

    // Testimonials
    Shortcode::register('testimonials', 'Testimonials', 'Client testimonials', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.testimonials.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('testimonials', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('What Clients Say'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Testimonials'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(3));
    });

    // Blog Posts
    Shortcode::register('blog-posts', 'Blog Posts', 'Latest blog posts', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.blog.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('blog-posts', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Latest Articles'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Blog'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(3));
    });

    // Contact
    Shortcode::register('contact', 'Contact', 'Contact section', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.contact.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('contact', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue("Let's Work Together"))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Contact'))
            ->add('description', TextareaField::class, TextFieldOption::make()->label('Description'));
    });

    // Products - All / Digital / Physical
    Shortcode::register('products', 'Products (Ecommerce)', 'Show ecommerce products', function (ShortcodeCompiler $shortcode) {
        return Theme::partial('shortcodes.products.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('products', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('My Products'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Shop'))
            ->add('description', TextareaField::class, TextFieldOption::make()->label('Description'))
            ->add('product_type', SelectField::class, SelectFieldOption::make()->label('Product Type')->choices([
                'all' => 'All Products',
                'digital' => 'Digital Products Only',
                'physical' => 'Physical Products Only',
            ])->defaultValue('all'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(8));
    });

    // Digital Products
    Shortcode::register('digital-products', 'Digital Products', 'Show digital products only', function (ShortcodeCompiler $shortcode) {
        $shortcode->product_type = 'digital';
        return Theme::partial('shortcodes.products.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('digital-products', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Digital Products'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Instant Download'))
            ->add('description', TextareaField::class, TextFieldOption::make()->label('Description')->defaultValue('Templates, boilerplates, UI kits, and more - instant download after purchase'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(8));
    });

    // Physical Products
    Shortcode::register('physical-products', 'Physical Products', 'Show physical products only', function (ShortcodeCompiler $shortcode) {
        $shortcode->product_type = 'physical';
        return Theme::partial('shortcodes.products.index', compact('shortcode'));
    });
    Shortcode::setAdminConfig('physical-products', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label('Title')->defaultValue('Physical Products'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label('Subtitle')->defaultValue('Merch & Accessories'))
            ->add('description', TextareaField::class, TextFieldOption::make()->label('Description')->defaultValue('T-shirts, hoodies, desk accessories and more'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label('Limit')->defaultValue(8));
    });
});
