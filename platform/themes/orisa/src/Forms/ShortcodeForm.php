<?php

namespace Theme\Orisa\Forms;

use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Shortcode\Forms\ShortcodeForm as BaseShortcodeForm;

class ShortcodeForm extends BaseShortcodeForm
{
    public function addButtonActions(array $names = [], array $wrapperAttributes = [], array|int|null $visibleForStyles = null, int $currentStyle = 1): static
    {
        $names = $names ?: ['primary' => __('Primary')];

        foreach ($names as $key => $label) {
            $labelOption = TextFieldOption::make()
                ->label(__(':label action label', ['label' => $label]));

            $urlOption = TextFieldOption::make()
                ->label(__(':label action URL', ['label' => $label]));

            $iconOption = CoreIconFieldOption::make()
                ->label(__(':label action icon', ['label' => $label]));

            if ($visibleForStyles !== null) {
                $labelOption->collapsible('style', $visibleForStyles, $currentStyle);
                $urlOption->collapsible('style', $visibleForStyles, $currentStyle);
                $iconOption->collapsible('style', $visibleForStyles, $currentStyle);
            }

            $this
                ->addOpenFieldset("{$key}_action", $wrapperAttributes)
                ->add("{$key}_action_label", TextField::class, $labelOption)
                ->add("{$key}_action_url", TextField::class, $urlOption)
                ->add("{$key}_action_icon", CoreIconField::class, $iconOption)
                ->addCloseFieldset("{$key}_action");
        }

        return $this;
    }
}
