<?php

use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\MediaImagesField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Media\Facades\RvMedia;
use Botble\Menu\Facades\Menu;
use Botble\Newsletter\Facades\Newsletter;
use Botble\Newsletter\Forms\Fronts\NewsletterForm;
use Botble\Page\Forms\PageForm;
use Botble\Portfolio\Forms\ProjectForm;
use Botble\Team\Forms\TeamForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;
use Illuminate\Database\Eloquent\Model;
use Theme\Orisa\Support\ArchivePaginationSeo;

register_page_template([
    'default' => __('Default'),
    'homepage' => __('Homepage'),
    'full-width' => __('Full width'),
    'content-page' => __('Content page'),
    'without-layout' => __('Without layout'),
    'coming-soon' => __('Coming Soon'),
]);

app()->booted(function (): void {
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerSocialSharing();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerLazyLoadImages();
    ThemeSupport::registerDateFormatOption();
    ThemeSupport::registerSiteLogoHeight(37);

    Theme::typography()
        ->registerFontFamilies([
            new TypographyItem('primary', __('Primary (Body)'), 'DM Sans'),
            new TypographyItem('heading', __('Heading'), 'DM Sans'),
        ])
        ->registerFontSizes([
            new TypographyItem('h1', __('Heading 1'), 60),
            new TypographyItem('h2', __('Heading 2'), 48),
            new TypographyItem('h3', __('Heading 3'), 38),
            new TypographyItem('h4', __('Heading 4'), 31),
            new TypographyItem('h5', __('Heading 5'), 25),
            new TypographyItem('h6', __('Heading 6'), 20),
            new TypographyItem('body', __('Body'), 16),
        ]);

    add_filter('cms_custom_fonts', function (array $customFonts) {
        $customFonts[] = 'DM Sans';

        return $customFonts;
    }, 120);

    if (is_plugin_active('newsletter')) {
        Newsletter::registerNewsletterPopup();

        NewsletterForm::extend(function ($form) {
            return $form->formClass('newsletter-form');
        });
    }

    add_filter('theme_preloader_versions', function (): array {
        return [
            'v2' => __('Default'),
            'v1' => __('Simplify'),
        ];
    }, 128);

    add_filter('theme_preloader', function (string $preloader): string {
        if (theme_option('preloader_version', 'v2') === 'v2') {
            return Theme::partial('preloader');
        }

        return $preloader;
    }, 128);

    // Give every page of a paginated blog archive its own SEO title and meta description, matching
    // the H1 that views/loop.blade.php renders, so an audit no longer reports the pagination series
    // as duplicate metadata. Covers every archive that paginates through that template: the blog
    // page, category archives and tag archives.
    //
    // Priority 0 is deliberate. Botble fires actions from the highest priority down (Action::fire()
    // krsorts its listeners), so this has to sit BELOW the SEO meta box at 56 to run after it -
    // otherwise a manually configured SEO title overwrites the suffix instead of receiving it.
    add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $object): void {
        // Every screen handled here belongs to the blog plugin, which also defines the screen-name
        // constants used below, so bail out before touching them when the plugin is inactive.
        if (! $object instanceof Model || ! is_plugin_active('blog')) {
            return;
        }

        $isPaginatedArchive = match ($screen) {
            PAGE_MODULE_SCREEN_NAME => $object->getKey() == get_blog_page_id(),
            CATEGORY_MODULE_SCREEN_NAME, TAG_MODULE_SCREEN_NAME => true,
            default => false,
        };

        if (! $isPaginatedArchive) {
            return;
        }

        // Metadata polish must never be able to take a public archive down, so a malformed site
        // title or an unexpected value is swallowed and the page renders with its original meta.
        rescue(fn () => ArchivePaginationSeo::apply(ArchivePaginationSeo::currentPage()), report: false);
    }, 0, 2);

    // Sidebar registrations
    register_sidebar([
        'id' => 'blog_top_sidebar',
        'name' => __('Blog top sidebar'),
        'description' => __('Add widgets to the top of the blog page.'),
    ]);

    register_sidebar([
        'id' => 'footer_primary_sidebar',
        'name' => __('Footer Primary sidebar'),
        'description' => __('Customize the footer content with this sidebar widget.'),
    ]);

    register_sidebar([
        'id' => 'footer_top_sidebar',
        'name' => __('Footer Top sidebar'),
        'description' => __('Engage visitors before they reach the footer with this widget.'),
    ]);

    register_sidebar([
        'id' => 'footer_bottom_sidebar',
        'name' => __('Footer Bottom sidebar'),
        'description' => __("Display copyright text and partner images in the lower section of your website's footer."),
    ]);

    register_sidebar([
        'id' => 'header_top_start_sidebar',
        'name' => __('Header Top Start Sidebar'),
        'description' => __('Add widgets to the left side of the header top.'),
    ]);

    register_sidebar([
        'id' => 'header_top_end_sidebar',
        'name' => __('Header Top End Sidebar'),
        'description' => __('Add widgets to the right side of the header top.'),
    ]);

    register_sidebar([
        'id' => 'service_sidebar',
        'name' => __('Service Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the service details page.'),
    ]);

    register_sidebar([
        'id' => 'project_sidebar',
        'name' => __('Project Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the project details page.'),
    ]);

    register_sidebar([
        'id' => 'team_sidebar',
        'name' => __('Team Details Sidebar'),
        'description' => __('Add widgets to the sidebar of the team details page.'),
    ]);

    RvMedia::addSize('vertical_thumb', 400, 500)
        ->addSize('horizontal_thumb', 600, 400)
        ->addSize('medium', 1280, 400);

    // Note: automatic <img> width/height injection now lives in core/media
    // (MediaServiceProvider + ImageDimensionsInjector) and applies globally.

    // Header is rendered in base.blade.php via Theme::partial('header')
    // after the preloader and search form (matching original HTML order).

    // Footer and scroll-to-top are rendered in base.blade.php directly
    // via Theme::partial('footer') and Theme::partial('scroll-to-top').

    if (is_plugin_active('portfolio')) {
        $serviceFormClass = 'Botble\Portfolio\Forms\ServiceForm';
        if (class_exists($serviceFormClass)) {
            $serviceFormClass::extend(function ($form): void {
                $form
                    ->add(
                        'icon',
                        CoreIconField::class,
                        CoreIconFieldOption::make()
                            ->label(__('Icon'))
                            ->metadata()
                    )
                    ->add(
                        'icon_image',
                        MediaImageField::class,
                        MediaImageFieldOption::make()
                            ->label(__('Icon image'))
                            ->helperText(__('It will replace above icon if this image is present'))
                            ->metadata()
                    )
                    ->add(
                        'skills',
                        \Botble\Base\Forms\Fields\TextareaField::class,
                        \Botble\Base\Forms\FieldOptions\TextareaFieldOption::make()
                            ->label(__('Service items (Services shortcode, style 2)'))
                            ->rows(5)
                            ->helperText(__('The bullet list shown under this service in the "Services" shortcode (style 2). Separate items with a single pipe "|". To split them into two columns, separate the two groups with a double pipe "||". Example: Research & Insights|Purpose, Mission & Vision|Value Proposition||Brand Positioning|Brand Architecture|Brand Personality Trait'))
                            ->metadata()
                    )
                    ->add(
                        'content_width',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(__('Content width'))
                            ->helperText(__('"Full width" renders the detail page edge-to-edge instead of the centred reading column, matching the Full width template available on Pages.'))
                            ->choices([
                                'boxed' => __('Boxed'),
                                'full-width' => __('Full width'),
                            ])
                            ->metadata()
                    );
            });

            // Make the "skills" service items editable per language. The language-advanced
            // form strips every field whose key is not a registered translatable column, so
            // without this the field would vanish on non-default-locale (e.g. Arabic) Service
            // edit screens. Registering "skills" as a translatable column keeps the field on
            // those forms AND, via the "stored_meta_box_key" filter (applied on both save and
            // read in MetaBox), stores/reads the value under a per-locale key ("ar_skills",
            // etc.) so each language keeps its own list on the front end. "skills" is metadata,
            // not a real pf_services_translations column, which is safe: LanguageAdvancedManager
            // ::save() only writes columns that physically exist, and the translations relation
            // merely gains a harmless extra fillable entry.
            $serviceModel = 'Botble\Portfolio\Models\Service';
            if (class_exists(\Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::class)) {
                $translatableColumns = \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::getTranslatableColumns($serviceModel);
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(
                    $serviceModel,
                    array_values(array_unique([...$translatableColumns, 'skills']))
                );
            }
        }

        // Project form: expose the "link" metadata field that project.blade.php reads
        // to render the "Live Demo" button. Without this field the value (often seeded
        // by demo import) is unmanageable from the admin. Leaving it empty hides the button.
        if (class_exists(ProjectForm::class)) {
            ProjectForm::extend(function (ProjectForm $form): void {
                $form->add(
                    'link',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Project link (Live Demo)'))
                        ->helperText(__('External URL for this project. When set, a "Live Demo" button shows on the project page. Leave empty to hide it.'))
                        ->metadata()
                );

                // Gallery images: the pf_projects.images column (array cast) is already
                // rendered as a slider on the project detail page, but the core form only
                // exposes the single featured "image". Wire a multi-image uploader so buyers
                // can attach several images per project. The "images[]" name persists via the
                // model's fillable + array cast (no custom save handler needed).
                $project = $form->getModel();

                $form->add('images[]', MediaImagesField::class, [
                    'label' => __('Gallery images'),
                    'helper_text' => __('Additional images shown in the slider on the project detail page. The featured image above is always shown first.'),
                    'values' => $project && is_array($project->images) ? $project->images : [],
                ]);

                $form->add(
                    'content_width',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Content width'))
                        ->helperText(__('"Full width" renders the detail page edge-to-edge instead of the centred reading column, matching the Full width template available on Pages.'))
                        ->choices([
                            'boxed' => __('Boxed'),
                            'full-width' => __('Full width'),
                        ])
                        ->metadata()
                );
            });
        }
    }

    Menu::useMenuItemIconImage();

    PageForm::extend(function (PageForm $form): void {
        if (! Theme::breadcrumb()->enabled()) {
            return;
        }

        $form
            ->add(
                'breadcrumb_enabled',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Breadcrumb enabled'))
                    // "No" is listed first on purpose: Orisa has no page header block in its
                    // reference design, and an untouched select submits its first option. With
                    // "Yes" first, every page saved in the admin silently opted into the block.
                    ->choices([
                        false => __('No'),
                        true => __('Yes'),
                    ])
                    ->metadata()
            )
            ->add(
                'breadcrumb_background',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Breadcrumb background'))
                    ->metadata()
            );
    });

    // Header-spacing toggle: lets buyers opt-out of the top padding strip rendered
    // above page content. Needed when the first block is a full-bleed hero that
    // should sit flush under the absolute header, but the page isn't registered as
    // the system homepage (Theme Options → Pages → Your home page display).
    PageForm::extend(function (PageForm $form): void {
        $form->add(
            'hide_header_spacing',
            SelectField::class,
            SelectFieldOption::make()
                ->label(__('Hide header spacing'))
                ->helperText(__('Set to Yes when the first block is a full-width hero that should sit flush under the header.'))
                ->choices([
                    false => __('No'),
                    true => __('Yes'),
                ])
                ->metadata()
        );
    });

    // Coming Soon template: expose the three meta fields the template reads
    // (subtitle, countdown date, banner image). Visible only when the page
    // template selector is set to "coming-soon".
    PageForm::extend(function (PageForm $form): void {
        $currentTemplate = $form->getModel()->template ?? null;

        $form
            ->add(
                'coming_soon_subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Coming soon subtitle'))
                    ->placeholder(__('We are On the Way'))
                    ->collapsible('template', 'coming-soon', $currentTemplate)
                    ->metadata()
            )
            ->add(
                'countdown_time',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Countdown date'))
                    ->helperText(__('Format: Y/m/d H:i:s — e.g. 2026/12/31 23:59:59'))
                    ->placeholder('2026/12/31 23:59:59')
                    ->collapsible('template', 'coming-soon', $currentTemplate)
                    ->metadata()
            )
            ->add(
                'banner_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Coming soon banner image'))
                    ->collapsible('template', 'coming-soon', $currentTemplate)
                    ->metadata()
            );
    });

    // Team form: let admins pick a Tabler icon per social link via CoreIconField (metadata-backed).
    if (is_plugin_active('team') && class_exists(TeamForm::class)) {
        TeamForm::extend(function (TeamForm $form): void {
            foreach (apply_filters('team_supported_socials', ['facebook', 'twitter', 'instagram']) as $social) {
                $form->add(
                    "social_icon_{$social}",
                    CoreIconField::class,
                    CoreIconFieldOption::make()
                        ->label(__('Icon: :social', ['social' => ucfirst($social)]))
                        ->helperText(__('Pick a Tabler icon for this social link (defaults to the matching brand icon).'))
                        ->metadata()
                );
            }
        });
    }

    if (is_plugin_active('ecommerce')) {
        // EcommerceHelper is a facade class, not a global function - so the previous
        // function_exists('EcommerceHelper') guard was always false and the ecommerce
        // front assets (front-ecommerce.js) were never enqueued on pages without a
        // product gallery (e.g. the cart page), breaking remove-from-cart AJAX.
        EcommerceHelper::registerThemeAssets();

        register_sidebar([
            'id' => 'product_sidebar',
            'name' => __('Product Sidebar'),
            'description' => __('Sidebar for product pages.'),
        ]);
    }

    add_filter('ads_locations', function (array $locations) {
        return [
            ...$locations,
            'main_content_before' => __('Main Content (before)'),
            'main_content_after' => __('Main Content (after)'),
            'footer_before' => __('Footer (before)'),
            'footer_after' => __('Footer (after)'),
            'post_list_before' => __('Post List (before)'),
            'post_list_after' => __('Post List (after)'),
            'post_before' => __('Post Detail (before)'),
            'post_after' => __('Post Detail (after)'),
            'project_before' => __('Project Detail (before)'),
            'project_after' => __('Project Detail (after)'),
            'service_before' => __('Service Detail (before)'),
            'service_after' => __('Service Detail (after)'),
            'team_before' => __('Team Detail (before)'),
            'team_after' => __('Team Detail (after)'),
        ];
    }, 128);

    add_filter('cms_installer_themes', function () {
        return [
            'orisa-creative-agency' => [
                'label' => 'Creative Agency',
                'image' => Theme::asset()->url('images/demos/home-1.png'),
            ],
            'orisa-digital-agency' => [
                'label' => 'Digital Agency',
                'image' => Theme::asset()->url('images/demos/home-2.png'),
            ],
            'orisa-marketing-agency' => [
                'label' => 'Marketing Agency',
                'image' => Theme::asset()->url('images/demos/home-3.png'),
            ],
            'orisa-ai-tech-agency' => [
                'label' => 'AI & Tech Agency',
                'image' => Theme::asset()->url('images/demos/home-4.png'),
            ],
            'orisa-personal-creative' => [
                'label' => 'Personal Creative',
                'image' => Theme::asset()->url('images/demos/home-5.png'),
            ],
        ];
    }, 10);
});
