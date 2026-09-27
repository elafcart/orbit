{{-- Product specifications, grouped, rendered as a narrow sidebar column.

     The ecommerce plugin ships its own partial (ecommerce::themes.includes.product-specification)
     but it lays out either a full-width table or a two-column grid, neither of which fits the
     narrow column beside the description tabs. This renders the same data - same visibility
     rules, same translated display values - stacked label-over-value instead.

     Everything here is admin-driven: Admin -> Ecommerce -> Specification Groups / Attributes
     define the groups and fields, and each product's Specifications tab supplies the values.
     Attributes marked hidden on the product are excluded by getVisibleSpecificationAttributes(). --}}
@php
    use Botble\Ecommerce\Models\ProductSpecificationAttributeTranslation;

    $currentLangCode = ProductSpecificationAttributeTranslation::getCurrentLanguageCode();

    $groupedSpecifications = $product
        ->getVisibleSpecificationAttributes()
        ->groupBy(fn ($attribute) => $attribute->group?->name ?: __('Other'));
@endphp

@if($groupedSpecifications->isNotEmpty())
    <div class="product-specification-sidebar">
        @foreach($groupedSpecifications as $groupName => $attributes)
            <div class="product-specification-sidebar__section">
                <h3 class="h6 product-specification-sidebar__title">{{ $groupName }}</h3>
                <ul class="product-specification-sidebar__list">
                    @foreach($attributes as $attribute)
                        <li class="product-specification-sidebar__item">
                            <span class="product-specification-sidebar__label">{{ $attribute->name }}</span>
                            <span class="product-specification-sidebar__value">
                                @if($attribute->type == 'checkbox')
                                    {{ $attribute->pivot->value ? __('Yes') : __('No') }}
                                @else
                                    {{ ProductSpecificationAttributeTranslation::getDisplayValue($product, $attribute, $currentLangCode) }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endif
