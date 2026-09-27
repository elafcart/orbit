<?php

use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Contact\Forms\ShortcodeContactAdminConfigForm;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;

app()->booted(function (): void {
    if (! is_plugin_active('contact')) {
        return;
    }

    // Override the contact form template to use the orisa theme partial
    add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
        return Theme::getThemeNamespace('partials.shortcodes.contact-form.index');
    });

    Shortcode::setPreviewImage('contact-form', Theme::asset()->url('images/ui-blocks/contact-form.png'));

    Shortcode::modifyAdminConfig('contact-form', function (ShortcodeContactAdminConfigForm $form) {
        $attributes = $form->getModel();

        return $form
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->label(__('Style'))
                    ->defaultValue(Arr::get($attributes, 'style', 1))
                    ->numberItemsPerRow(1)
                    ->withoutAspectRatio()
                    ->choices(
                        collect(range(1, 3))->mapWithKeys(fn ($i) => [
                            $i => [
                                'label' => __('Style :number', ['number' => $i]),
                                'image' => Theme::asset()->url("images/shortcodes/contact-form/style-$i.png"),
                            ],
                        ])->toArray()
                    )
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
                    ->helperText(__('Use H1 when this shortcode is the page hero. Switch to H2/H3 if the page already has another H1 (one H1 per page is best for SEO).'))
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
                'subtitle',
                TextField::class,
                TextFieldOption::make()->label(__('Subtitle'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()->label(__('Description'))
            )
            ->add(
                'address_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Office heading'))
                    ->placeholder(__('Office'))
                    ->helperText(__('Heading shown above the first office address. Leave empty to use "Office".'))
            )
            ->add(
                'address_icon',
                CoreIconField::class,
                CoreIconFieldOption::make()
                    ->label(__('Office icon'))
                    ->helperText(__('Tabler icon shown next to the first office. Leave empty to use the default brand mark.'))
            )
            ->add(
                'address',
                TextField::class,
                TextFieldOption::make()->label(__('Address'))
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()->label(__('Phone'))
            )
            ->add(
                'email',
                TextField::class,
                TextFieldOption::make()->label(__('Email'))
            )
            ->add(
                'address_label_2',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Office heading 2'))
                    ->placeholder(__('Office'))
                    ->helperText(__('Heading shown above the second office address. Leave empty to use "Office".'))
            )
            ->add(
                'address_icon_2',
                CoreIconField::class,
                CoreIconFieldOption::make()
                    ->label(__('Office icon 2'))
                    ->helperText(__('Tabler icon shown next to the second office. Leave empty to use the default brand mark.'))
            )
            ->add(
                'address_2',
                TextField::class,
                TextFieldOption::make()->label(__('Address 2'))
            )
            ->add(
                'phone_2',
                TextField::class,
                TextFieldOption::make()->label(__('Phone 2'))
            )
            ->add(
                'email_2',
                TextField::class,
                TextFieldOption::make()->label(__('Email 2'))
            )
            ->add(
                'map_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Map embed URL'))
                    ->collapsible('style', [1, 2], $attributes['style'] ?? 1)
            );
    });
});
