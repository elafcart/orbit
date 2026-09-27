<?php

use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    Shortcode::register(
        'hero-banner',
        __('Hero Banner'),
        __('Hero Banner'),
        function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $services = Shortcode::fields()->getTabsData(['name'], $shortcode, 'services') ?? [];
            $socialLinks = Shortcode::fields()->getTabsData(['name', 'url'], $shortcode, 'social_links') ?? [];
            $bottomServices = Shortcode::fields()->getTabsData(['name'], $shortcode, 'bottom_service') ?? [];

            return Theme::partial('shortcodes.hero-banner.index', compact('shortcode', 'services', 'socialLinks', 'bottomServices'));
        }
    );

    Shortcode::setPreviewImage('hero-banner', Theme::asset()->url('images/ui-blocks/hero-banner.png'));

    Shortcode::setAdminConfig('hero-banner', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 6))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/hero-banner/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Use H2 if your page already has another H1 (e.g. inside the page content) so SEO sees a single H1 per page.'))
                    ->choices([
                        'h1' => __('H1 (default)'),
                        'h2' => 'H2',
                        'h3' => 'H3',
                    ])
                    ->defaultValue('h1')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
                    ->collapsible('style', [1, 2, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'background_video',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Background video URL'))
                    ->collapsible('style', [1, 2], $attributes['style'] ?? 1)
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Hero image'))
                    ->collapsible('style', [1, 2, 3, 5, 6], $attributes['style'] ?? 1)
            )
            // Style 1: small decorative icon next to the description (replaces the built-in flower SVG)
            ->add('service_icon', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Service icon (style 1)'))
                ->helperText(__('Small decorative icon shown above the description. Recommended 40×40 SVG/PNG. Leave empty to use the default icon.'))
                ->collapsible('style', 1, $attributes['style'] ?? 1))
            // Style 3: right hero image (uses a dedicated field — NOT `background_image` —
            // because the base Shortcode compiler treats `background_image` as an inline
            // CSS background on the block wrapper, which would paint the whole hero section.)
            ->add('right_image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Right hero image'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            // Style 5: left column secondary image (dedicated field — avoids bg-cover side-effect of `background_image`)
            ->add('left_image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Left secondary image'))
                ->collapsible('style', 5, $attributes['style'] ?? 1))
            // Style 5: right column bio (long description, distinct from left column `description`)
            ->add('bio', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Right column bio'))
                ->collapsible('style', 5, $attributes['style'] ?? 1))
            // Shared card fields (style 2 bottom card + style 3 testimonial card)
            ->add('card_text', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Card text / testimonial quote (styles 2 & 3)'))
                ->collapsible('style', [2, 3], $attributes['style'] ?? 1))
            ->add('card_avatar', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Card avatar (styles 2 & 3)'))
                ->collapsible('style', [2, 3], $attributes['style'] ?? 1))
            // Style 3-only: testimonial author metadata
            ->add('card_author', TextField::class, TextFieldOption::make()
                ->label(__('Testimonial author name (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('card_author_role', TextField::class, TextFieldOption::make()
                ->label(__('Testimonial author role (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            // Style 3: right image badge (client count + avatar stack)
            ->add('client_count', TextField::class, TextFieldOption::make()
                ->label(__('Client count (number, e.g. 16)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_count_suffix', TextField::class, TextFieldOption::make()
                ->label(__('Client count suffix (e.g. K+)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_count_label', TextField::class, TextFieldOption::make()
                ->label(__('Client count label (e.g. Clients word-wide)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_avatar_1', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Client avatar 1'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_avatar_2', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Client avatar 2'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_avatar_3', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Client avatar 3'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_avatar_4', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Client avatar 4'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('client_avatar_5', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Client avatar 5'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            // Style 2: noise overlay + bottom card (title/subtitle/description) + card image
            ->add('noise_overlay', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Noise overlay image (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('bottom_subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Bottom card subtitle (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('bottom_title', TextField::class, TextFieldOption::make()
                ->label(__('Bottom card title (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('bottom_description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Bottom card description (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('card_image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Bottom card image (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            // Style 4: up to 3 stacked card images
            ->add('card_image_1', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Card image 1 (style 4)'))
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->add('card_image_2', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Card image 2 (style 4)'))
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->add('card_image_3', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Card image 3 (style 4)'))
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->addButtonActions(['primary' => __('Primary')])
            ->addButtonActions(['secondary' => __('Secondary')], [], [1, 3, 4, 6], $attributes['style'] ?? 1)
            ->add(
                'social_links',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Social links'))
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
                    ->fields([
                        'name' => [
                            'title' => __('Name'),
                        ],
                        'url' => [
                            'title' => __('URL'),
                        ],
                    ], 'social_links')
                    ->attrs($attributes)
            )
            ->add(
                'services',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Service tags'))
                    ->collapsible('style', [1, 2, 3, 4], $attributes['style'] ?? 1)
                    ->fields([
                        'name' => [
                            'title' => __('Name'),
                        ],
                    ], 'services')
                    ->attrs($attributes)
            )
            ->add(
                'bottom_service',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Bottom nav services (style 4)'))
                    ->collapsible('style', 4, $attributes['style'] ?? 1)
                    ->fields([
                        'name' => [
                            'title' => __('Service name'),
                        ],
                    ], 'bottom_service')
                    ->attrs($attributes)
            );
    });

    // ─── About Us Information ──────────────────────────────────────────────────

    Shortcode::register(
        'about-us-information',
        __('About Us Information'),
        __('About Us Information'),
        function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $tabs = ThemeHelper::sanitizeTabImages(
                Shortcode::fields()->getTabsData(['title', 'description', 'image', 'content', 'title_tag'], $shortcode)
            );
            $avatars = ThemeHelper::sanitizeTabImages(
                Shortcode::fields()->getTabsData(['image'], $shortcode, 'avatars')
            );

            return Theme::partial('shortcodes.about-us-information.index', compact('shortcode', 'tabs', 'avatars'));
        }
    );

    Shortcode::setPreviewImage('about-us-information', Theme::asset()->url('images/ui-blocks/about-us-information.png'));

    Shortcode::setAdminConfig('about-us-information', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 9))->mapWithKeys(function ($i) {
                            return [
                                $i => [
                                    'label' => __('Style :i', ['i' => $i]),
                                    'image' => Theme::asset()->url("images/shortcodes/about-us-information/style-$i.png"),
                                ],
                            ];
                        })->all()
                    )
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3)
            )
            ->add(
                'decoration_icon',
                CoreIconField::class,
                CoreIconFieldOption::make()
                    ->label(__('Decoration icon (style 1)'))
                    ->helperText(__('Tabler icon shown above the description. Leave empty to use the default brand mark.'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'email',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Email (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Phone (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            // Uses style_image_* to avoid colliding with Feature tabs' flat
            // image_N namespace (tab #N image). Do not rename back to image_N.
            ->add(
                'style_image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image 1'))
                    ->collapsible('style', [1, 2, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'style_image_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image 2'))
                    ->collapsible('style', [1, 2, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'style_image_3',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image 3'))
                    ->collapsible('style', 4, $attributes['style'] ?? 1)
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Hero image (styles 6, 7, 8, 9)'))
                    ->collapsible('style', [6, 7, 8, 9], $attributes['style'] ?? 1)
            )
            ->add(
                'avatars',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Avatars'))
                    ->fields([
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                    ], 'avatars')
                    ->attrs($attributes)
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'experience_years',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Experience years (odometer counter)'))
                    ->defaultValue(15)
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_heading',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact heading (style 5)'))
                    ->collapsible('style', 5, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_address',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Contact address (style 5)'))
                    ->rows(2)
                    ->collapsible('style', 5, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact phone (style 5)'))
                    ->collapsible('style', 5, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_email',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact email (style 5)'))
                    ->collapsible('style', 5, $attributes['style'] ?? 1)
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Feature tabs'))
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                            'required' => true,
                        ],
                        // Per-item heading level. Stored per tab, so items in the same block can differ.
                        // Left on "Default" the item keeps the tag its style has always rendered, which
                        // is why existing blocks are untouched until an editor picks a level.
                        'title_tag' => [
                            'title' => __('Title tag'),
                            'type' => 'select',
                            'options' => [
                                '' => __('Default'),
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => __('Regular text (no heading)'),
                            ],
                            'helper' => __('Semantic level for this item title. The CSS classes are kept on whichever tag is used, so the visual style never changes. Applies to styles 1 and 3, the styles that render the item title as a heading.'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                        'content' => [
                            'title' => __('Content'),
                            'type' => 'textarea',
                        ],
                    ])
                    ->attrs($attributes)
            )
            ->addButtonActions(['primary' => __('Primary')], [], [1, 2, 3], $attributes['style'] ?? 1);
    });

    // ─── Site Statistics ───────────────────────────────────────────────────────

    Shortcode::register(
        'site-statistics',
        __('Site Statistics'),
        __('Site Statistics'),
        function (ShortcodeCompiler $shortcode): ?string {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $tabs = Shortcode::fields()->getTabsData(['label', 'value', 'prefix', 'suffix', 'description'], $shortcode) ?? [];

            return Theme::partial('shortcodes.site-statistics.index', compact('shortcode', 'tabs'));
        }
    );

    Shortcode::setPreviewImage('site-statistics', Theme::asset()->url('images/ui-blocks/site-statistics.png'));

    Shortcode::setAdminConfig('site-statistics', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 4))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/site-statistics/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', [1, 2, 4], $attributes['style'] ?? 1))
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
                    ->collapsible('style', [1, 2], $attributes['style'] ?? 1)
            )
            ->add(
                'quantity',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Legacy counter count (styles 2 & 3)'))
                    ->helperText(__('Only needed when using the legacy title_N / data_N / unit_N attributes instead of the Statistics tabs below. Set 0 to hide.'))
                    ->defaultValue(0)
                    ->collapsible('style', [2, 3], $attributes['style'] ?? 1)
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Statistics'))
                    ->fields([
                        'value' => [
                            'title' => __('Value (number)'),
                            'required' => true,
                        ],
                        'prefix' => [
                            'title' => __('Prefix (e.g. $)'),
                        ],
                        'suffix' => [
                            'title' => __('Suffix (e.g. K+, M+, %, +, TB, .9%)'),
                        ],
                        'label' => [
                            'title' => __('Label'),
                            'required' => true,
                        ],
                        'description' => [
                            'title' => __('Description (style 4 only)'),
                            'type' => 'textarea',
                        ],
                    ])
                    ->attrs($attributes)
            );
    });

    // ─── Pricing Plans ────────────────────────────────────────────────────────

    Shortcode::register('pricing-plans', __('Pricing Plans'), __('Pricing Plans'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $plans = Shortcode::fields()->getTabsData(
            ['name', 'description', 'monthly_price', 'yearly_price', 'features', 'is_featured', 'button_label', 'button_url'],
            $shortcode
        );

        return Theme::partial('shortcodes.pricing-plans.index', compact('shortcode', 'plans'));
    });

    Shortcode::setPreviewImage('pricing-plans', Theme::asset()->url('images/ui-blocks/pricing-plans.png'));

    Shortcode::setAdminConfig('pricing-plans', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect([1, 3])->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/pricing-plans/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add('description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Description'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('background_images', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Background image'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->addButtonActions(['primary' => __('Primary'), 'secondary' => __('Secondary')], [], 3, $attributes['style'] ?? 1)
            ->add('custom_pricing_title', TextField::class, TextFieldOption::make()
                ->label(__('Custom-pricing callout title (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('custom_pricing_description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Custom-pricing callout description (style 3)'))
                ->rows(3)
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('contact_email', TextField::class, TextFieldOption::make()
                ->label(__('Contact email (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('contact_phone', TextField::class, TextFieldOption::make()
                ->label(__('Contact phone (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add(
                'plans',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Plans'))
                ->fields([
                    'name' => ['title' => __('Plan name'), 'required' => true],
                    'description' => ['title' => __('Plan description'), 'type' => 'textarea'],
                    'monthly_price' => ['title' => __('Monthly price')],
                    'yearly_price' => ['title' => __('Yearly price')],
                    'features' => ['title' => __('Features (one per line)'), 'type' => 'textarea'],
                    'is_featured' => ['title' => __('Featured?'), 'type' => 'checkbox'],
                    'button_label' => ['title' => __('Button label')],
                    'button_url' => ['title' => __('Button URL')],
                ])
                ->attrs($attributes)
            );
    });

    // ─── Call to Action ───────────────────────────────────────────────────────

    Shortcode::register('call-to-action', __('Call to Action'), __('Call to Action'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        return Theme::partial('shortcodes.call-to-action.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('call-to-action', Theme::asset()->url('images/ui-blocks/call-to-action.png'));

    Shortcode::setAdminConfig('call-to-action', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                ->label(__('Style'))
                ->defaultValue($attributes['style'] ?? 1)
                ->numberItemsPerRow(1)
                ->withoutAspectRatio()
                ->choices([
                    1 => ['label' => __('Style 1 - Full banner')],
                    2 => ['label' => __('Style 2 - Compact')],
                    3 => ['label' => __('Style 3 - Dark + right image')],
                ])
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', 1, $attributes['style'] ?? 1))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label(__('Description')))
            ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Background image'))
                ->collapsible('style', [1, 3], $attributes['style'] ?? 1))
            ->add('image_2', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Right side image (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->addButtonActions(['primary' => __('Primary')]);
    });

    // ─── Partners ─────────────────────────────────────────────────────────────

    Shortcode::register('partners', __('Partners'), __('Partners'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $partners = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['name', 'image', 'url'], $shortcode)
        );

        return Theme::partial('shortcodes.partners.index', compact('shortcode', 'partners'));
    });

    Shortcode::setPreviewImage('partners', Theme::asset()->url('images/ui-blocks/partners.png'));

    Shortcode::setAdminConfig('partners', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                ->label(__('Style'))
                ->defaultValue($attributes['style'] ?? 1)
                ->numberItemsPerRow(1)
                ->withoutAspectRatio()
                ->choices([
                    1 => ['label' => __('Style 1 - Ticker')],
                    2 => ['label' => __('Style 2 - Inline')],
                    3 => ['label' => __('Style 3 - Grid')],
                    4 => ['label' => __('Style 4 - Home5 carousel with reviews')],
                ])
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', [2, 4], $attributes['style'] ?? 1))
            ->add('title', TextField::class, TextFieldOption::make()
                ->label(__('Title'))
                ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
                    ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Description'))
                ->collapsible('style', [2, 3], $attributes['style'] ?? 1))
            // Style 3 extras: left ripple image, secondary image, and middle stat block
            // Uses style_image_* to avoid colliding with "partners" tabs' flat
            // image_N namespace (partner #N image).
            ->add('style_image_1', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Left ripple image (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('style_image_2', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Secondary info image (style 3)'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('stat_prefix', TextField::class, TextFieldOption::make()
                ->label(__('Stat prefix (e.g. $) - style 3'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('stat_value', TextField::class, TextFieldOption::make()
                ->label(__('Stat value (e.g. 850) - style 3'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            ->add('stat_suffix', TextField::class, TextFieldOption::make()
                ->label(__('Stat suffix (e.g. M+) - style 3'))
                ->collapsible('style', 3, $attributes['style'] ?? 1))
            // Style 4: customer review rating block (home-5 carousel)
            ->add('review_label', TextField::class, TextFieldOption::make()
                ->label(__('Review label (style 4)'))
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->add('review_rating', NumberField::class, NumberFieldOption::make()
                ->label(__('Review rating 1-5 (style 4)'))
                ->defaultValue(5)
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->add('review_url', TextField::class, TextFieldOption::make()
                ->label(__('Review URL (style 4)'))
                ->collapsible('style', 4, $attributes['style'] ?? 1))
            ->add(
                'partners',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Partners'))
                ->fields([
                    'name' => ['title' => __('Name'), 'required' => true],
                    'image' => ['title' => __('Logo'), 'type' => 'image', 'required' => true],
                    'url' => ['title' => __('URL')],
                ])
                ->attrs($attributes)
            )
            ->addButtonActions(['primary' => __('Primary')], [], 2, $attributes['style'] ?? 1);
    });

    // ─── Our Journey (about-1 sec-2-about block-journey) ──────────────────────

    Shortcode::register(
        'our-journey',
        __('Our Journey'),
        __('Timeline section with subtitle, title, hover card and vertical journey list'),
        function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $items = Shortcode::fields()->getTabsData(['date', 'title', 'company', 'description', 'url'], $shortcode, 'items') ?? [];

            return Theme::partial('shortcodes.our-journey.index', compact('shortcode', 'items'));
        }
    );

    Shortcode::setPreviewImage('our-journey', Theme::asset()->url('images/ui-blocks/our-journey.png'));

    Shortcode::setAdminConfig('our-journey', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle (top tag label)')))
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(2)
            )
            ->addButtonActions(['primary' => __('Primary CTA')], [], [], 1)
            ->add('card_image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Card image')))
            ->add('card_badge', TextField::class, TextFieldOption::make()->label(__('Card badge text (e.g. "Since 2012")')))
            ->add('card_title', TextField::class, TextFieldOption::make()->label(__('Card title (large hover heading)')))
            ->add(
                'card_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Card description'))
                    ->rows(2)
            )
            ->add('card_label', TextField::class, TextFieldOption::make()
                ->label(__('Card footer label (HTML allowed, e.g. "Orisa Nova<sup>®</sup>")')))
            ->add('card_url', TextField::class, TextFieldOption::make()->label(__('Card URL')))
            ->add(
                'items',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Timeline items'))
                    ->fields([
                        'date' => ['title' => __('Date / phase label')],
                        'title' => ['title' => __('Title'), 'required' => true],
                        'company' => ['title' => __('Sub-text / company (optional)')],
                        'description' => ['title' => __('Description'), 'type' => 'textarea'],
                        'url' => ['title' => __('URL')],
                    ], 'items')
                    ->attrs($attributes)
            );
    });

    // ─── Skills Carousel ──────────────────────────────────────────────────────

    Shortcode::register('skills-carousel', __('Skills Carousel'), __('Skills Carousel'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $skills = Shortcode::fields()->getTabsData(['name'], $shortcode);

        return Theme::partial('shortcodes.skills-carousel.index', compact('shortcode', 'skills'));
    });

    Shortcode::setPreviewImage('skills-carousel', Theme::asset()->url('images/ui-blocks/skills-carousel.png'));

    Shortcode::setAdminConfig('skills-carousel', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('dark', OnOffField::class, OnOffFieldOption::make()
                ->label(__('Dark mode (bg-neutral-900 + white text)'))
                ->defaultValue(false))
            ->add('scroll_direction', TextField::class, TextFieldOption::make()
                ->label(__('Scroll direction (left or right)'))
                ->defaultValue('left'))
            ->add(
                'skills',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Skills'))
                ->fields([
                    'name' => ['title' => __('Skill name'), 'required' => true],
                ])
                ->attrs($attributes)
            );
    });

    // ─── Service Cards (services-3 sec-2-services — 4-column rotating-variant grid)

    Shortcode::register('service-cards', __('Service Cards'), __('4-column service grid with rotating visual variants'), function (ShortcodeCompiler $shortcode) {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $cards = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['title', 'description', 'image', 'url'], $shortcode)
        );

        return Theme::partial('shortcodes.service-cards.index', compact('shortcode', 'cards'));
    });

    Shortcode::setPreviewImage('service-cards', Theme::asset()->url('images/ui-blocks/service-cards.png'));

    Shortcode::setAdminConfig('service-cards', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 2))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/service-cards/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('title', TextField::class, TextFieldOption::make()
                ->label(__('Title (style 2)'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Description (style 2)'))
                ->rows(2)
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add(
                'cards',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Service cards (visual variant rotates by index)'))
                    ->fields([
                        'title' => ['title' => __('Title'), 'required' => true],
                        'description' => ['title' => __('Description'), 'type' => 'textarea'],
                        'image' => ['title' => __('Image'), 'type' => 'image'],
                        'url' => ['title' => __('URL')],
                    ])
                    ->attrs($attributes)
            );
    });

    // ─── Keyword Ticker (services-2 sec-2-services — diamond-separated marquee) ─

    Shortcode::register('keyword-ticker', __('Keyword Ticker'), __('Marquee of keywords separated by diamond SVGs'), function (ShortcodeCompiler $shortcode) {
        $items = Shortcode::fields()->getTabsData(['name'], $shortcode);

        return Theme::partial('shortcodes.keyword-ticker.index', compact('shortcode', 'items'));
    });

    Shortcode::setPreviewImage('keyword-ticker', Theme::asset()->url('images/ui-blocks/keyword-ticker.png'));

    Shortcode::setAdminConfig('keyword-ticker', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('scroll_direction', TextField::class, TextFieldOption::make()
                ->label(__('Scroll direction (left or right)'))
                ->defaultValue('left'))
            ->add(
                'items',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Keywords'))
                    ->fields([
                        'name' => ['title' => __('Keyword'), 'required' => true],
                    ])
                    ->attrs($attributes)
            );
    });

    // ─── Image Mosaic (3-col parallax decorative grid — sec-5-about) ────────

    Shortcode::register('image-mosaic', __('Image Mosaic'), __('Decorative 3-column parallax image grid'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $items = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['image'], $shortcode)
        );

        return Theme::partial('shortcodes.image-mosaic.index', compact('shortcode', 'items'));
    });

    Shortcode::setPreviewImage('image-mosaic', Theme::asset()->url('images/ui-blocks/galleries.png'));

    Shortcode::setAdminConfig('image-mosaic', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('column_speed_1', TextField::class, TextFieldOption::make()->label(__('Column 1 parallax speed'))->defaultValue('-0.1'))
            ->add('column_speed_2', TextField::class, TextFieldOption::make()->label(__('Column 2 parallax speed'))->defaultValue('0.8'))
            ->add('column_speed_3', TextField::class, TextFieldOption::make()->label(__('Column 3 parallax speed'))->defaultValue('-0.1'))
            ->add(
                'items',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Images (distributed across 3 columns in order)'))
                    ->fields([
                        'image' => ['title' => __('Image'), 'type' => 'image', 'required' => true],
                    ])
                    ->attrs($attributes)
            );
    });

    // ─── Skill Cards (Tech Stack / Tools grid — sec-6-about) ────────────────

    Shortcode::register('skill-cards', __('Skill Cards'), __('Categorized tech stack cards with icon tags and score'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $cards = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['title', 'image', 'score', 'tags'], $shortcode)
        );

        // Normalize tags: each card's `tags` is a multi-line string "Name|icon-path" per line.
        foreach ($cards as &$card) {
            $rawTags = (string) ($card['tags'] ?? '');
            $parsed = [];
            foreach (preg_split('/\r\n|\r|\n/', $rawTags) as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }
                [$name, $icon] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');
                $parsed[] = ['name' => $name, 'icon' => $icon];
            }
            $card['tag_items'] = $parsed;
        }
        unset($card);

        return Theme::partial('shortcodes.skill-cards.index', compact('shortcode', 'cards'));
    });

    Shortcode::setPreviewImage('skill-cards', Theme::asset()->url('images/ui-blocks/skills-carousel.png'));

    Shortcode::setAdminConfig('skill-cards', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add('description', TextareaField::class, TextareaFieldOption::make()->label(__('Description')))
            ->add(
                'cards',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Skill cards'))
                    ->fields([
                        'title' => ['title' => __('Category title'), 'required' => true],
                        'image' => ['title' => __('Thumbnail image'), 'type' => 'image'],
                        'score' => ['title' => __('Score (0-100)')],
                        'tags' => ['title' => __('Tags (one per line: "Name|icon/path")'), 'type' => 'textarea'],
                    ])
                    ->attrs($attributes)
            );
    });

    // ─── Content Block ────────────────────────────────────────────────────────

    Shortcode::register('content-block', __('Content Block'), __('Content Block'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $items = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['title', 'description', 'image', 'icon'], $shortcode)
        );

        return Theme::partial('shortcodes.content-block.index', compact('shortcode', 'items'));
    });

    Shortcode::setPreviewImage('content-block', Theme::asset()->url('images/ui-blocks/content-block.png'));

    Shortcode::setAdminConfig('content-block', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                ->label(__('Style'))
                ->defaultValue($attributes['style'] ?? 1)
                ->numberItemsPerRow(1)
                ->withoutAspectRatio()
                ->choices(
                    collect(range(1, 11))->mapWithKeys(fn ($i) => [
                        $i => ['label' => __('Style :i', ['i' => $i])],
                    ])->all()
                )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('title_heading_level', SelectField::class, SelectFieldOption::make()
                ->label(__('Title heading level'))
                ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                ->choices([
                    'h1' => 'H1',
                    'h2' => __('H2 (default)'),
                    'h3' => 'H3',
                    'h4' => 'H4',
                ])
                ->defaultValue('h2'))
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', [1, 3, 6, 7, 9, 10, 11], $attributes['style'] ?? 1))
            ->add('description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Description'))
                ->collapsible('style', [1, 2, 3, 5, 6, 7, 9, 10, 11], $attributes['style'] ?? 1))
            // Uses style_image_* to avoid colliding with "items" tabs' flat
            // image_N namespace (item #N image).
            ->add('style_image_1', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Image 1'))
                ->collapsible('style', [1, 3, 6, 7], $attributes['style'] ?? 1))
            ->add('style_image_2', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Image 2'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('style_image_3', MediaImageField::class, MediaImageFieldOption::make()->label(__('Image 3'))->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('style_image_4', MediaImageField::class, MediaImageFieldOption::make()->label(__('Image 4'))->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('background_image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Background image')))
            ->add('contact_phone', TextField::class, TextFieldOption::make()->label(__('Contact phone'))->collapsible('style', 11, $attributes['style'] ?? 1))
            ->add('contact_email', TextField::class, TextFieldOption::make()->label(__('Contact email'))->collapsible('style', 11, $attributes['style'] ?? 1))
            ->add('contact_address', TextareaField::class, TextareaFieldOption::make()->label(__('Contact address'))->collapsible('style', 11, $attributes['style'] ?? 1))
            // Style 6: hero + testimonial + stat + skills list + small quote
            ->add('hero_title', TextField::class, TextFieldOption::make()
                ->label(__('Hero card title (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('hero_experience', TextField::class, TextFieldOption::make()
                ->label(__('Hero experience tag (style 6, HTML allowed)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_quote', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Testimonial quote (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_name', TextField::class, TextFieldOption::make()
                ->label(__('Testimonial author name (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_role', TextField::class, TextFieldOption::make()
                ->label(__('Testimonial author role (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_rating', NumberField::class, NumberFieldOption::make()
                ->label(__('Testimonial rating 1-5 (style 6)'))
                ->defaultValue(5)
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_since', TextField::class, TextFieldOption::make()
                ->label(__('Testimonial since label (style 6, e.g. "[Since 2012]")'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('testimonial_avatar', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Testimonial avatar (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('stat_value', TextField::class, TextFieldOption::make()
                ->label(__('Stat value (style 6, e.g. "5k+")'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('stat_label', TextField::class, TextFieldOption::make()
                ->label(__('Stat label (style 6, HTML allowed)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('skills_list', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Skills list (style 6)'))
                ->helperText(__('Pipe-separated list, e.g. "Python, C++|PyTorch, TensorFlow"'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            ->add('quote_small', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Small quote (style 6)'))
                ->collapsible('style', 6, $attributes['style'] ?? 1))
            // Style 7: feature highlight card
            ->add('feature_tag', TextField::class, TextFieldOption::make()
                ->label(__('Feature tag (style 7)'))
                ->collapsible('style', 7, $attributes['style'] ?? 1))
            ->add('feature_title', TextField::class, TextFieldOption::make()
                ->label(__('Feature title (style 7)'))
                ->collapsible('style', 7, $attributes['style'] ?? 1))
            ->add('feature_description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Feature description (style 7)'))
                ->collapsible('style', 7, $attributes['style'] ?? 1))
            ->add('feature_label', TextField::class, TextFieldOption::make()
                ->label(__('Feature label (style 7)'))
                ->collapsible('style', 7, $attributes['style'] ?? 1))
            ->add('feature_url', TextField::class, TextFieldOption::make()
                ->label(__('Feature URL (style 7)'))
                ->collapsible('style', 7, $attributes['style'] ?? 1))
            // Style 8: banner + contact fallbacks + image
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()
                ->label(__('Banner image (style 8)'))
                ->collapsible('style', 8, $attributes['style'] ?? 1))
            ->add('email', TextField::class, TextFieldOption::make()
                ->label(__('Email (style 8, falls back to site email)'))
                ->collapsible('style', 8, $attributes['style'] ?? 1))
            ->add('phone', TextField::class, TextFieldOption::make()
                ->label(__('Phone (style 8, falls back to site phone)'))
                ->collapsible('style', 8, $attributes['style'] ?? 1))
            ->add(
                'items',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Items'))
                ->fields([
                    'title' => ['title' => __('Title'), 'required' => true],
                    'description' => ['title' => __('Description'), 'type' => 'textarea'],
                    'image' => ['title' => __('Image'), 'type' => 'image'],
                    'icon' => ['title' => __('Icon class')],
                ])
                ->attrs($attributes)
            )
            ->addButtonActions(['primary' => __('Primary')], [], [1, 3, 6, 7, 9], $attributes['style'] ?? 1)
            ->addButtonActions(['secondary' => __('Secondary')], [], 9, $attributes['style'] ?? 1);
    });

    // ─── Content Checklist (service detail) ──────────────────────────────────

    Shortcode::register('content-checklist', __('Content Checklist'), __('Content Checklist'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $items = array_filter(array_map('trim', explode('\n', $shortcode->checklist ?? '')));

        if (empty($items)) {
            return '';
        }

        return Theme::partial('shortcodes.content-checklist', compact('shortcode', 'items'));
    });

    Shortcode::setAdminConfig('content-checklist', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'checklist',
                TextareaField::class,
                TextareaFieldOption::make()
                ->label(__('Checklist items'))
                ->helperText(__('Separate items with \\n'))
                ->rows(5)
            );
    });

    // ─── Content Features (service detail) ───────────────────────────────────

    Shortcode::register('content-features', __('Content Features'), __('Content Features'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $items = Shortcode::fields()->getTabsData(['title', 'description', 'icon'], $shortcode);

        if (empty($items)) {
            return '';
        }

        return Theme::partial('shortcodes.content-features', compact('shortcode', 'items'));
    });

    Shortcode::setAdminConfig('content-features', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Background image')))
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Features'))
                ->fields([
                    'title' => ['title' => __('Title'), 'required' => true],
                    'description' => ['title' => __('Description'), 'type' => 'textarea'],
                    'icon' => ['title' => __('Icon class')],
                ])
                ->attrs($attributes)
            );
    });

    // ─── Awards (sec-7-home-2) ────────────────────────────────────────────────

    Shortcode::register('awards', __('Awards'), __('Awards list'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $awards = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['date', 'title', 'organization', 'url', 'url_label', 'image', 'image_lg'], $shortcode),
            ['image', 'image_lg']
        );

        return Theme::partial('shortcodes.awards.index', compact('shortcode', 'awards'));
    });

    Shortcode::setPreviewImage('awards', Theme::asset()->url('images/ui-blocks/awards.png'));

    Shortcode::setAdminConfig('awards', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 2))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/awards/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('subtitle', TextField::class, TextFieldOption::make()
                ->label(__('Subtitle'))
                ->collapsible('style', 2, $attributes['style'] ?? 1))
            ->add('description', TextareaField::class, TextareaFieldOption::make()
                ->label(__('Description'))
                ->collapsible('style', 1, $attributes['style'] ?? 1))
            ->add('action_label', TextField::class, TextFieldOption::make()->label(__('CTA label')))
            ->add('action_url', TextField::class, TextFieldOption::make()->label(__('CTA URL')))
            ->add(
                'awards',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Awards'))
                ->fields([
                    'date' => ['title' => __('Date')],
                    'title' => ['title' => __('Award title'), 'required' => true],
                    'organization' => ['title' => __('Organization')],
                    'url' => ['title' => __('URL')],
                    'url_label' => ['title' => __('URL label')],
                    'image' => ['title' => __('Image'), 'type' => 'image'],
                    'image_lg' => ['title' => __('Hover image (large)'), 'type' => 'image'],
                ])
                ->attrs($attributes)
            );
    });

    // ─── Image Gallery (sec-8-home-2) ─────────────────────────────────────────

    Shortcode::register('image-gallery', __('Image Gallery'), __('Image carousel'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $images = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(['image', 'alt'], $shortcode)
        );

        return Theme::partial('shortcodes.image-gallery.index', compact('shortcode', 'images'));
    });

    Shortcode::setPreviewImage('image-gallery', Theme::asset()->url('images/ui-blocks/image-gallery.png'));

    Shortcode::setAdminConfig('image-gallery', function (array $attributes) {
        $attributes = ThemeHelper::sanitizeShortcodeImageAttributes($attributes);

        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 2))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/image-gallery/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add(
                'images',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                ->label(__('Images'))
                ->fields([
                    'image' => ['title' => __('Image'), 'type' => 'image', 'required' => true],
                    'alt' => ['title' => __('Alt text')],
                ])
                ->attrs($attributes)
            );
    });

    // ─── Video Showreel (sec-11-home-2) ───────────────────────────────────────

    Shortcode::register('video-showreel', __('Video Showreel'), __('Video play with thumbnail'), function (ShortcodeCompiler $shortcode) {
            ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        return Theme::partial('shortcodes.video-showreel.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('video-showreel', Theme::asset()->url('images/ui-blocks/video-showreel.png'));

    Shortcode::setAdminConfig('video-showreel', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label(__('Thumbnail image')))
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title (used as image alt)')))
            ->add(
                'title_heading_level',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title heading level'))
                    ->helperText(__('Choose the semantic heading level for this section title. Use H2 when this block follows the page hero (default). Pick H1 only if this block is the hero on its own page.'))
                    ->choices([
                        'h1' => 'H1',
                        'h2' => __('H2 (default)'),
                        'h3' => 'H3',
                        'h4' => 'H4',
                    ])
                    ->defaultValue('h2')
            )
            ->add(
                'title_font_size',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Title font size'))
                    ->helperText(__('Preset steps on the theme type scale, so the title stays responsive. Choose Default to keep this block\'s built-in size.'))
                    ->choices([
                        '' => __('Default'),
                        'sm' => __('Small'),
                        'md' => __('Medium'),
                        'lg' => __('Large'),
                        'xl' => __('Extra large'),
                    ])
                    ->defaultValue('')
            )
            ->add('video_url', TextField::class, TextFieldOption::make()->label(__('Video URL (YouTube/Vimeo/MP4)')))
            ->add('left_label', TextField::class, TextFieldOption::make()->label(__('Left label'))->defaultValue(__('Play')))
            ->add('right_label', TextField::class, TextFieldOption::make()->label(__('Right label'))->defaultValue(__('Showreel')));
    });
});
