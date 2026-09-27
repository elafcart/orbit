<?php

use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Newsletter\Forms\Fronts\NewsletterForm;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Theme\Facades\Theme;
use Theme\Orisa\Forms\ShortcodeForm;
use Theme\Orisa\Support\ThemeHelper;

app()->booted(function (): void {
    if (! is_plugin_active('newsletter')) {
        return;
    }

    Shortcode::register(
        'newsletter',
        __('Newsletter'),
        __('Newsletter'),
        function (ShortcodeCompiler $shortcode): ?string {
        ThemeHelper::sanitizeShortcodeAllImages($shortcode);
            $form = NewsletterForm::create();

            return Theme::partial('shortcodes.newsletter.index', compact('shortcode', 'form'));
        }
    );

    Shortcode::setPreviewImage('newsletter', Theme::asset()->url('images/ui-blocks/newsletter.png'));

    Shortcode::setAdminConfig('newsletter', function (array $attributes): ShortcodeForm {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue($attributes['style'] ?? 1)
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices([
                        1 => ['label' => __('Style 1 - Dark full-width banner')],
                        2 => ['label' => __('Style 2 - Light box with inline image')],
                    ])
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()->label(__('Title'))
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
                TextField::class,
                TextFieldOption::make()->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Inline image (style 2)'))
                    ->collapsible('style', 2, $attributes['style'] ?? 1)
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image (style 1)'))
                    ->collapsible('style', 1, $attributes['style'] ?? 1)
            );
    });
});
