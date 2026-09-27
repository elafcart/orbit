{{-- Careers Style 2: List layout with horizontal rows --}}
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

        <div class="d-flex flex-column gap-3">
            @foreach ($careers as $career)
                <a href="{{ $career->url }}" class="at-service-card rounded-4 p-4 d-flex align-items-center justify-content-between text-decoration-none common-color">
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <h5 class="mb-0">{!! BaseHelper::clean($career->name) !!}</h5>
                        @if ($career->location)
                            <span class="fz-font-sm opacity-75 d-inline-flex align-items-center gap-1">
                                {!! BaseHelper::renderIcon('ti ti-map-pin') !!} {{ $career->location }}
                            </span>
                        @endif
                        @if ($career->salary)
                            <span class="fz-font-sm opacity-75 d-inline-flex align-items-center gap-1">
                                {!! BaseHelper::renderIcon('ti ti-cash') !!} {{ $career->salary }}
                            </span>
                        @endif
                        <span class="fz-font-xs opacity-50">{{ $career->created_at->translatedFormat('M d, Y') }}</span>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M7.85986 2.43872L1.7123 8.58629L0.702148 7.57614L6.84971 1.42857H1.43131V0H9.28843V7.85714H7.85986V2.43872Z" fill="currentColor" />
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
