@php
    Theme::set('breadcrumbEnabled', $page->getMetaData('breadcrumb_enabled', true));
    Theme::set('breadcrumbBackground', $page->getMetaData('breadcrumb_background', true));
    // Header-spacing offset is rendered above the page content on inner pages so
    // that the sticky header doesn't overlap the first block. Skip it on the
    // homepage (where the hero already provides its own top offset), on any page
    // that explicitly opts out via the `hide_header_spacing` meta flag, and when
    // the page-header block (title + breadcrumb) renders above the content — that
    // block already carries the clearance, so keeping this would double it.
    $hasHeaderSpacing = ! BaseHelper::isHomepage($page->getKey())
        && ! $page->getMetaData('hide_header_spacing', true)
        && ! \Theme\Orisa\Support\ThemeHelper::isBreadcrumbEnabled();

    // If the page selects a custom template (e.g. "coming-soon"), render the
    // matching view at views/templates/{template}.blade.php instead of the
    // default content output. The template view receives `$page` and is fully
    // responsible for the inner markup.
    $templateView = $page->template
        ? Theme::getThemeNamespace('views.templates.' . $page->template)
        : null;
    $hasTemplateView = $templateView && view()->exists($templateView);
@endphp

@if ($hasTemplateView)
    @include($templateView, ['page' => $page])
@else
    <div class="at-page-content">
        @if ($hasHeaderSpacing)
            <div class="pt-100"></div>
        @endif

        {!! apply_filters(
            PAGE_FILTER_FRONT_PAGE_CONTENT,
            BaseHelper::clean($page->content),
            $page,
        ) !!}
    </div>
@endif
