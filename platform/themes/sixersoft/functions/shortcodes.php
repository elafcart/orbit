<?php

use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffCheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;

// Loaded automatically by Helper::autoload() on every file in functions/.
app()->booted(function (): void {
    if (! function_exists('shortcode')) {
        return;
    }

    /* ── Portfolio projects ─────────────────────────────────────────────── */
    Shortcode::register(
        'sixersoft-portfolio',
        __('Portfolio Grid'),
        __('Grid of the latest projects from the Portfolio plugin.'),
        fn (ShortcodeCompiler $shortcode) => Theme::partial('shortcodes.portfolio.index', compact('shortcode'))
    );

    Shortcode::setAdminConfig('sixersoft-portfolio', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Selected Works'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('Portfolio'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of projects'))->defaultValue(6));
    });

    if (! is_plugin_active('portfolio')) {
        return;
    }

    /* ── Services (with client-side category filter) ────────────────────── */
    Shortcode::register(
        'sixersoft-services',
        __('Services Grid'),
        __('Services from the Portfolio plugin with optional category filter chips.'),
        function (ShortcodeCompiler $shortcode) {
            $services = \Botble\Portfolio\Models\Service::query()
                ->wherePublished()
                ->with(['category', 'slugable'])
                ->oldest('order')
                ->latest()
                ->limit((int) ($shortcode->limit ?: 9))
                ->get();

            if ($services->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.services.index', compact('shortcode', 'services'));
        }
    );

    Shortcode::setAdminConfig('sixersoft-services', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('What We Do'))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('Services'))
            ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of services'))->defaultValue(9))
            ->add('show_filter', OnOffCheckboxField::class, OnOffCheckboxFieldOption::make()->label(__('Show category filter chips'))->defaultValue(true));
    });
});

/* ── Remaining shortcodes depend on their own plugins ───────────────────── */

app()->booted(function (): void {
    if (! function_exists('shortcode')) {
        return;
    }

    /* ── Testimonials ───────────────────────────────────────────────────── */
    if (is_plugin_active('testimonial')) {
        Shortcode::register(
            'sixersoft-testimonials',
            __('Testimonials Grid'),
            __('Client testimonials from the Testimonial plugin.'),
            function (ShortcodeCompiler $shortcode) {
                $testimonials = \Botble\Testimonial\Models\Testimonial::query()
                    ->wherePublished()
                    ->latest()
                    ->limit((int) ($shortcode->limit ?: 6))
                    ->get();

                if ($testimonials->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.testimonials.index', compact('shortcode', 'testimonials'));
            }
        );

        Shortcode::setAdminConfig('sixersoft-testimonials', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('What Clients Say'))
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('Testimonials'))
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of testimonials'))->defaultValue(6));
        });
    }

    /* ── Team ──────────────────────────────────────────────────────────── */
    if (is_plugin_active('team')) {
        Shortcode::register(
            'sixersoft-team',
            __('Team Grid'),
            __('Team members from the Team plugin.'),
            function (ShortcodeCompiler $shortcode) {
                $members = \Botble\Team\Models\Team::query()
                    ->wherePublished()
                    ->latest()
                    ->limit((int) ($shortcode->limit ?: 4))
                    ->get();

                if ($members->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.team.index', compact('shortcode', 'members'));
            }
        );

        Shortcode::setAdminConfig('sixersoft-team', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Meet The Team'))
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('Our People'))
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of members'))->defaultValue(4));
        });
    }

    /* ── FAQ accordion ──────────────────────────────────────────────────── */
    if (is_plugin_active('faq')) {
        Shortcode::register(
            'sixersoft-faq',
            __('FAQ Accordion'),
            __('Frequently asked questions from the FAQ plugin.'),
            function (ShortcodeCompiler $shortcode) {
                $faqs = \Botble\Faq\Models\Faq::query()
                    ->wherePublished()
                    ->limit((int) ($shortcode->limit ?: 8))
                    ->get();

                if ($faqs->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.faq.index', compact('shortcode', 'faqs'));
            }
        );

        Shortcode::setAdminConfig('sixersoft-faq', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Frequently Asked Questions'))
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('FAQ'))
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of questions'))->defaultValue(8));
        });
    }

    /* ── Gallery ────────────────────────────────────────────────────────── */
    if (is_plugin_active('gallery')) {
        Shortcode::register(
            'sixersoft-gallery',
            __('Gallery Grid'),
            __('Galleries from the Gallery plugin.'),
            function (ShortcodeCompiler $shortcode) {
                $galleries = \Botble\Gallery\Models\Gallery::query()
                    ->wherePublished()
                    ->limit((int) ($shortcode->limit ?: 6))
                    ->get();

                if ($galleries->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.gallery.index', compact('shortcode', 'galleries'));
            }
        );

        Shortcode::setAdminConfig('sixersoft-gallery', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Gallery'))
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('Moments'))
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of galleries'))->defaultValue(6));
        });
    }

    /* ── Latest blog posts ──────────────────────────────────────────────── */
    if (is_plugin_active('blog')) {
        Shortcode::register(
            'sixersoft-blog',
            __('Blog Posts Grid'),
            __('Latest posts from the Blog plugin.'),
            function (ShortcodeCompiler $shortcode) {
                $posts = \Botble\Blog\Models\Post::wherePublished()->latest()->limit((int) ($shortcode->limit ?: 3))->get();

                if ($posts->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.blog.index', compact('shortcode', 'posts'));
            }
        );

        Shortcode::setAdminConfig('sixersoft-blog', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Latest Articles'))
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('From the blog'))
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Number of posts'))->defaultValue(3));
        });
    }

    /* ── About (content-only, no plugin) ────────────────────────────────── */
    Shortcode::register(
        'sixersoft-about',
        __('About Block'),
        __('Two-column about section: text + image.'),
        fn (ShortcodeCompiler $shortcode) => Theme::partial('shortcodes.about.index', compact('shortcode'))
    );

    Shortcode::setAdminConfig('sixersoft-about', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->defaultValue('About Us'))
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Who We Are'))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label(__('Description')))
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Image')));
    });

    /* ── Call to action ─────────────────────────────────────────────────── */
    Shortcode::register(
        'sixersoft-cta',
        __('Call To Action'),
        __('Full-width call-to-action banner.'),
        fn (ShortcodeCompiler $shortcode) => Theme::partial('shortcodes.cta.index', compact('shortcode'))
    );

    Shortcode::setAdminConfig('sixersoft-cta', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->defaultValue('Have an idea? Let’s build it together.'))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label(__('Description')))
            ->add('button_text', TextField::class, TextFieldOption::make()->label(__('Button text'))->defaultValue('Get In Touch'))
            ->add('button_url', TextField::class, TextFieldOption::make()->label(__('Button URL'))->defaultValue('/contact'));
    });
});
