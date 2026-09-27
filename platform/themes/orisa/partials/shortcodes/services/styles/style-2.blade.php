{{-- Services Style 2: from index-2.html `at-service-area` --}}
{{-- Light bg rounded container, vertical scroll panels with title + description + image --}}
@php
    // Section heading sits between the page H1 and the H3 service item titles. Rendered only when
    // the title field is filled, so blocks that leave it empty keep their original markup.
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
    $titleClass = 'reveal-text mb-50' . ($titleTag === 'div' ? ' h2' : '');
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="container-2200">
    <div class="at-service-area bg-neutral-50 rounded-5 mx-lg-3 mx-2 pt-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="at-service-subtitle-wrap at-about-border d-flex justify-content-between gap-3 mb-50">
                        @if($shortcode->subtitle)
                            <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                                <span class="text-uppercase">
                                    <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                    <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                </span>
                                <i>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                </i>
                            </span>
                        @endif
                        @if($shortcode->description)
                            <span class="fs-font-md fw-500 text-decoration-underline">{!! BaseHelper::clean($shortcode->description) !!}</span>
                        @endif
                    </div>
                    @if($shortcode->title)
                        <{{ $titleTag }} class="{{ $titleClass }} {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
            </div>
        </div>

        {{-- Vertical scroll panels: each service as a full-width panel --}}
        <div class="scroll-section vertical-section position-relative">
            <div class="wrapper">
                @foreach($services as $service)
                    @php
                        $serviceImage = $service->image ?: $service->getMetaData('image', true);
                        // Skills stored as pipe-separated lists via MetaBox.
                        // Format: "list1 item|list1 item|list1 item||list2 item|list2 item" (two lists split by ||)
                        $skillsRaw = (string) $service->getMetaData('skills', true);
                        $skillsLists = collect(explode('||', $skillsRaw))
                            ->map(fn ($l) => array_values(array_filter(array_map('trim', explode('|', $l)))))
                            ->filter(fn ($l) => ! empty($l))
                            ->all();
                    @endphp
                    <div class="item">
                        <a href="{{ $service->url }}" class="d-block text-reset text-decoration-none" aria-label="{{ $service->name }}">
                        <div class="container bg-neutral-50 pb-40 pt-20">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-12">
                                    <div class="d-flex flex-column justify-content-between h-100 py-4 px-2">
                                        {{-- Use <h3> instead of <h1> so each page emits only one semantic H1 (page-content), avoiding duplicate H1 with the service detail page. --}}
                                        <h3 class="fz-ds-1 fw-500 text-scale-anim pb-xxl-5 pb-4">{{ $service->name }}</h3>
                                        <div class="d-xxl-flex align-items-end">
                                            @if($service->description)
                                                <p class="fz-font-2xl neutral-950 reveal-text pe-xxl-5 mb-3">
                                                    {!! BaseHelper::clean($service->description) !!}
                                                </p>
                                            @endif
                                            @if(! empty($skillsLists))
                                                <div class="d-flex flex-column flex-md-row flex-xxl-column justify-content-between ps-xxl-5 ps-3">
                                                    @foreach($skillsLists as $list)
                                                        <ul class="text-nowrap neutral-950">
                                                            @foreach($list as $item)
                                                                <li>{{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($serviceImage)
                                    <div class="col-lg-5 offset-lg-1">
                                        <div class="rounded-4 overflow-hidden">
                                            <img class="img-cover" src="{{ RvMedia::getImageUrl($serviceImage) }}" alt="{{ $service->name }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
