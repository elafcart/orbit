@php
    Theme::set('hideBreadcrumb', true);

    $displayBlogTopSidebar = false;

    // The search hero below renders the page H1, so the shared listing must not add its own.
    $archiveHeading = '';

    // The /search route comes from the blog plugin and only queries blog posts.
    // Orisa's header search form appears on every page, so the other public
    // content types are queried here at the theme level to keep one site-wide search.
    $searchKeyword = trim((string) BaseHelper::stringify(request()->query('q')));

    // Extra result sets accompany the first page of blog results only: the ?page
    // parameter belongs to the blog paginator, so paging must not repeat them.
    $showExtraResults = $searchKeyword !== '' && request()->integer('page', 1) <= 1;

    $searchProducts = collect();
    $searchProjects = collect();
    $searchServices = collect();
    $searchPages = collect();

    if ($showExtraResults) {
        // LIKE wildcards in the keyword must be escaped or "100%" matches everything.
        $escapedKeyword = '%' . addcslashes($searchKeyword, '%_\\') . '%';

        $searchByName = fn (string $model, int $limit = 8) => $model::query()
            ->wherePublished()
            ->where(fn ($query) => $query
                ->where('name', 'LIKE', $escapedKeyword)
                ->orWhere('description', 'LIKE', $escapedKeyword))
            ->with('slugable')
            ->limit($limit)
            ->get();

        if (is_plugin_active('ecommerce')) {
            $searchProducts = app(\Botble\Ecommerce\Services\Products\GetProductService::class)
                ->getProduct(
                    \Illuminate\Http\Request::create('/', 'GET', ['q' => $searchKeyword, 'num' => 8, 'page' => 1]),
                    null,
                    null,
                    \Botble\Ecommerce\Facades\EcommerceHelper::withProductEagerLoadingRelations()
                );
        }

        if (is_plugin_active('portfolio')) {
            $searchProjects = $searchByName(\Botble\Portfolio\Models\Project::class);
            $searchServices = $searchByName(\Botble\Portfolio\Models\Service::class);
        }

        $searchPages = $searchByName(\Botble\Page\Models\Page::class, 12);
    }

    $hasExtraResults = $searchProducts->isNotEmpty()
        || $searchProjects->isNotEmpty()
        || $searchServices->isNotEmpty()
        || $searchPages->isNotEmpty();
@endphp

<!-- search hero section -->
<div class="sec-1-search overflow-hidden pt-150">
    <div class="container pb-20">
        <div class="row align-items-end">
            <div class="col-12">
                <h1 class="fz-ds-1 lh-1 fw-500 mb-0">{{ __('Search') }}</h1>
                @if($searchKeyword !== '')
                    <p class="fz-font-lg neutral-900 mb-0 mt-20">
                        {{ __('Results for: ":query"', ['query' => $searchKeyword]) }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Skip the blog block when it has nothing to show but another type matched,
     otherwise its empty grid leaves a tall blank gap below the hero. --}}
@if($posts->isNotEmpty() || ! $hasExtraResults)
    @include(Theme::getThemeNamespace('views.loop'))
@endif

@if($searchProducts->isNotEmpty())
    <!-- product results section -->
    <div class="sec-2-search overflow-hidden pt-60 pb-60">
        <div class="container">
            @include(Theme::getThemeNamespace('partials.search.section-header'), [
                'label' => __('Products'),
                'heading' => __('Products matching ":query"', ['query' => $searchKeyword]),
                'ctaUrl' => route('public.products', ['q' => $searchKeyword]),
                'ctaLabel' => __('View all products'),
            ])

            <div class="row">
                @foreach($searchProducts as $product)
                    <div class="product-card col-xxl-3 col-lg-4 col-md-6 col-12 mb-30">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if($searchProjects->isNotEmpty())
    <!-- project results section -->
    <div class="sec-3-search overflow-hidden pt-60 pb-60">
        <div class="container">
            @include(Theme::getThemeNamespace('partials.search.section-header'), [
                'label' => __('Projects'),
                'heading' => __('Projects matching ":query"', ['query' => $searchKeyword]),
            ])

            <div class="row">
                @foreach($searchProjects as $item)
                    @include(Theme::getThemeNamespace('partials.search.result-card'), ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>
@endif

@if($searchServices->isNotEmpty())
    <!-- service results section -->
    <div class="sec-4-search overflow-hidden pt-60 pb-60">
        <div class="container">
            @include(Theme::getThemeNamespace('partials.search.section-header'), [
                'label' => __('Services'),
                'heading' => __('Services matching ":query"', ['query' => $searchKeyword]),
            ])

            <div class="row">
                @foreach($searchServices as $item)
                    @include(Theme::getThemeNamespace('partials.search.result-card'), ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>
@endif

@if($searchPages->isNotEmpty())
    <!-- page results section: pages have no artwork, so they list as links -->
    <div class="sec-5-search overflow-hidden pt-60 pb-100">
        <div class="container">
            @include(Theme::getThemeNamespace('partials.search.section-header'), [
                'label' => __('Pages'),
                'heading' => __('Pages matching ":query"', ['query' => $searchKeyword]),
            ])

            <ul class="at-categories-list">
                @foreach($searchPages as $item)
                    <li>
                        <a href="{{ $item->url }}" class="at-categories-item">{!! BaseHelper::clean($item->name) !!}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
