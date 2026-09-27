{{-- Awards Style 1: from index-2.html `home-2-section-7` --}}
{{-- Title row + scroll-up cards (date, image, title, org, url) + footer description --}}
@php
    $arrowOutSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M10.0208 3.41421L1.41421 12.0208L0 10.6066L8.60659 2H1.02082V0H12.0208V11H10.0208V3.41421Z" fill="currentColor"/></svg>';
    $arrowRightSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5.00013 13.9999L5 5.00003L7 5L7.0001 11.9999L17.1719 12L13.2222 8.05027L14.6364 6.63606L21.0003 13L14.6364 19.364L13.2222 17.9497L17.1719 14L5.00013 13.9999Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="home-2-section-7 pt-120 pb-120">
    <div class="container">
        <div class="row g-4 align-items-end">
            @if($shortcode->title)
                <div class="col-xxl-3 col-lg-6 col-md-6">
                    <{{ $titleTag }} class="h1 fw-500 fz-ds-1 mb-0 {{ $titleSizeClass }}">
                        {!! BaseHelper::clean($shortcode->title) !!}
                    </{{ $titleTag }}>
                </div>
            @endif

            @if($shortcode->action_label)
                <div class="col-xxl-3 col-lg-4 col-md-4 ms-auto d-flex justify-content-lg-end">
                    <div class="at-btn-group at-btn-group-transparent at_fade_anim" data-delay=".5" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>{!! $arrowRightSvg !!}</a>
                        <a class="at-btn z-index-1" href="{{ $shortcode->action_url ?: '#' }}">{{ $shortcode->action_label }}</a>
                        <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>{!! $arrowRightSvg !!}</a>
                    </div>
                </div>
            @endif
        </div>

        @if(!empty($awards))
            <div class="row pt-120">
                <div class="col-12">
                    @foreach($awards as $award)
                        <div class="card-award scroll-move-up" @if(!empty($award['image_lg'])) data-img-award="{{ RvMedia::getImageUrl($award['image_lg']) }}" @endif>
                            <a href="{{ $award['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="card-award-link">
                                @if(!empty($award['date']))
                                    <span class="card-award-date">[ {{ $award['date'] }} ]</span>
                                @endif
                                <div class="card-award-content">
                                    @if(!empty($award['image']))
                                        <div class="card-award-image">
                                            <img src="{{ RvMedia::getImageUrl($award['image']) }}" alt="{{ $award['title'] ?? '' }}" class="w-100 h-100">
                                        </div>
                                    @endif
                                    @if(!empty($award['title']))
                                        <h3 class="h6 card-award-title mb-0">{{ $award['title'] }}</h3>
                                    @endif
                                </div>
                                @if(!empty($award['organization']))
                                    <h4 class="h6 card-award-web-excellence mb-0">{{ $award['organization'] }}</h4>
                                @endif
                                @if(!empty($award['url_label']))
                                    <div class="card-award-meta">
                                        <span class="card-award-url fz-font-lg">{{ $award['url_label'] }}</span>
                                    </div>
                                @endif
                                <div class="card-award-icon ms-auto">{!! $arrowOutSvg !!}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($shortcode->description)
            <div class="row">
                <div class="col-lg-7 col-12 ms-auto pt-80">
                    <div class="award-description d-flex gap-5">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="83" height="83" viewBox="0 0 83 83" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M41.5 0H0L41.5 41.5H0L41.5 83H83L41.5 41.5H83L41.5 0Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h5 class="revert-text mb-0 reveal-text">{!! BaseHelper::clean($shortcode->description) !!}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
