<?php

use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Testimonial\Models\Testimonial;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    Shortcode::register('testimonials', __('Testimonials'), __('Testimonials'), function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
        $tabs = ThemeHelper::sanitizeTabImages(
            Shortcode::fields()->getTabsData(
                ['name', 'role', 'company', 'quote', 'avatar', 'company_logo', 'rating'],
                $shortcode
            ) ?? [],
            ['avatar', 'company_logo']
        );

        // Fallback: if no inline tabs but `testimonial_ids` provided, hydrate from DB (ordered by given IDs).
        // Note: Shortcode class uses __get without __isset, so empty()/isset() don't work on magic props.
        $testimonialIds = (string) ($shortcode->testimonial_ids ?? '');
        if (empty($tabs) && $testimonialIds !== '' && class_exists(Testimonial::class)) {
            $ids = collect(explode(',', $testimonialIds))
                ->map(fn ($id) => (int) trim($id))
                ->filter()
                ->values();

            if ($ids->isNotEmpty()) {
                $records = Testimonial::query()
                    ->wherePublished()
                    ->whereIn('id', $ids->all())
                    ->get()
                    ->keyBy('id');

                $tabs = $ids
                    ->map(fn ($id) => $records->get($id))
                    ->filter()
                    ->map(fn ($row) => [
                        'name' => (string) $row->name,
                        'role' => '',
                        'company' => (string) ($row->company ?? ''),
                        'quote' => (string) ($row->content ?? ''),
                        'avatar' => (string) ($row->image ?? ''),
                        'company_logo' => '',
                        'rating' => 5,
                    ])
                    ->values()
                    ->all();
            }
        }

        return Theme::partial('shortcodes.testimonials.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setPreviewImage('testimonials', Theme::asset()->url('images/ui-blocks/testimonials.png'));

    Shortcode::setAdminConfig('testimonials', function (array $attributes): ShortcodeForm {
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
                        collect(range(1, 7))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :i', ['i' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/testimonials/style-$i.png"),
                            ],
                        ])->all()
                    )
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->defaultValue(__('Trusted by Clients'))
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
                'subtitle',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Subtitle / Description'))
                    ->rows(2)
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description (styles 2, 3 & 4)'))
                    ->rows(3)
                    ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image (styles 2, 3 & 4)'))
                    ->collapsible('style', [2, 3, 4], $attributes['style'] ?? 1)
            )
            ->add(
                'action_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('CTA label'))
                    ->collapsible('style', [1, 5, 6], $attributes['style'] ?? 1)
            )
            ->add(
                'action_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('CTA URL'))
                    ->collapsible('style', [1, 5, 6], $attributes['style'] ?? 1)
            )
            ->addButtonActions(['primary' => __('Primary')], [], 2, $attributes['style'] ?? 1)
            // Style 7: side team image + caption + contact info
            ->add(
                'team_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Team image (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'team_caption',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Team caption (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_address',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Contact address (style 7)'))
                    ->rows(2)
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact phone (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'contact_email',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact email (style 7)'))
                    ->collapsible('style', 7, $attributes['style'] ?? 1)
            )
            ->add(
                'testimonial_ids',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Testimonial IDs (comma-separated)'))
                    ->helperText(__('Pull testimonials from the database by ID, e.g. 1,2,3. Takes precedence is empty when tabs below are filled.'))
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Testimonial items'))
                    ->fields([
                        'name' => [
                            'title' => __('Client name'),
                            'required' => true,
                        ],
                        'role' => [
                            'title' => __('Role / Position'),
                        ],
                        'company' => [
                            'title' => __('Company / Location'),
                        ],
                        'quote' => [
                            'title' => __('Quote'),
                            'type' => 'textarea',
                        ],
                        'rating' => [
                            'title' => __('Rating (1-5)'),
                        ],
                        'avatar' => [
                            'title' => __('Avatar image'),
                            'type' => 'image',
                        ],
                        'company_logo' => [
                            'title' => __('Company logo image'),
                            'type' => 'image',
                        ],
                    ])
                    ->attrs($attributes)
            );
    });
});
