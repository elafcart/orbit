<?php

use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;

class SiteInformationWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Site Information'),
            'description' => __('Display company information in the footer.'),
            'company_name' => null,
            'tagline' => null,
            'address' => null,
            'phone' => null,
            'email' => null,
        ]);
    }

    protected function settingForm(): WidgetForm|string|null
    {
        return WidgetForm::createFromArray($this->getConfig())
            ->add(
                'company_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Company Name'))
            )
            ->add(
                'tagline',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Tagline'))
            )
            ->add(
                'address',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Address'))
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Phone'))
            )
            ->add(
                'email',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Email'))
            );
    }
}
