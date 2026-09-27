{{-- Careers Style 1: Card grid with location, salary, and arrow link --}}
<section {!! $shortcode->htmlAttributes() !!}>
    <div class="container">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="row mb-50">
                <div class="col-12">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                        </span>
                    @endif
                    @if ($shortcode->title)
                        <h2 class="reveal-text mb-0">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    @endif
                </div>
            </div>
        @endif

        <div class="row g-4">
            @foreach ($careers as $career)
                <div class="col-lg-4 col-md-6">
                    <div class="at-service-card rounded-4 p-4 h-100 d-flex flex-column">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <h5 class="mb-2">
                                    <a href="{{ $career->url }}" class="common-color">{!! BaseHelper::clean($career->name) !!}</a>
                                </h5>
                                @if ($career->location)
                                    <span class="fz-font-sm opacity-75 d-inline-flex align-items-center gap-1">
                                        {!! BaseHelper::renderIcon('ti ti-map-pin') !!} {{ $career->location }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ $career->url }}" class="at-service-card-icon flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <path d="M7.85986 2.43872L1.7123 8.58629L0.702148 7.57614L6.84971 1.42857H1.43131V0H9.28843V7.85714H7.85986V2.43872Z" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                        @if ($career->description)
                            <p class="fz-font-sm opacity-75 mb-3">{{ Str::limit($career->description, 120) }}</p>
                        @endif
                        <div class="mt-auto d-flex flex-wrap gap-2 align-items-center">
                            @if ($career->salary)
                                <span class="badge bg-primary bg-opacity-10 text-primary fz-font-sm px-3 py-2 rounded-pill">{{ $career->salary }}</span>
                            @endif
                            <span class="fz-font-xs opacity-50">{{ $career->created_at->translatedFormat('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
