{{-- Projects Style 1 — pinned title left + stacked portfolio right (index.html mg-portfolio-area) --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="mg-portfolio-area pt-145 pb-65">
    <div class="container">
        <div class="row">
            {{-- Left: pinned title + description + CTA --}}
            <div class="col-xxl-4 col-lg-4">
                <div class="mg-portfolio-title-wrap mg-portfolio-pin mb-30">
                    @if($shortcode->decoration_icon)
                        <x-core::icon :name="$shortcode->decoration_icon" class="fill-primary mb-10" style="width:48px;height:48px;" />
                    @else
                        <svg class="fill-primary mb-10" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M17 18L30 5H43V18L30 31V18H17Z" fill="currentColor" />
                            <path d="M30 31H43V44H30V31Z" fill="currentColor" />
                            <path d="M17 18L4 31V44H17L30 31H17V18Z" fill="currentColor" />
                            <path d="M17 18H4V5H17V18Z" fill="currentColor" />
                        </svg>
                    @endif

                    @if($shortcode->title)
                        <{{ $titleTag }} class="alt-section-title lh-1 mb-30 reveal-text {{ $titleSizeClass }}">{{ $shortcode->title }}</{{ $titleTag }}>
                    @endif

                    @if($shortcode->description)
                        <div class="at_fade_anim" data-delay=".3">
                            <p class="mg-portfolio-dec mb-50">{{ $shortcode->description }}</p>
                        </div>
                    @endif

                    @if($shortcode->primary_action_label)
                        <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                    <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                </svg>
                            </a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                    <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: stacked portfolio items --}}
            <div class="col-lg-7 ms-auto">
                <div class="mg-portfolio-item-wrap ml-130 mb-40">
                    @foreach($projects as $project)
                        <div class="mg-portfolio-item anim-zoomin-wrap mb-55" data-category="">
                            <div class="mg-portfolio-thumb anim-zoomin not-hide-cursor">
                                <a class="cursor-hide" href="{{ $project->url }}">
                                    <img data-speed=".8" class="w-100"
                                        src="{{ RvMedia::getImageUrl($project->image, null, false, RvMedia::getDefaultImage()) }}"
                                        alt="{{ $project->name }}">
                                </a>
                            </div>
                            <div class="mg-portfolio-content cs-portfolio-content d-flex align-items-center flex-wrap flex-md-nowrap justify-content-between">
                                <div class="w-md-75">
                                    <h3 class="h5 cs-portfolio-title at-title-anim fix mr-20 at-ff-sequel-semi-bold">
                                        <a href="{{ $project->url }}" class="at-title-text">{{ $project->name }}</a>
                                    </h3>
                                    @if($project->description)
                                        <p class="fz-font-lg neutral-500">{{ $project->description }}</p>
                                    @endif
                                </div>
                                @php
                                    $tags = array_filter([
                                        $project->place ?? null,
                                        $project->client ?? null,
                                    ]);
                                @endphp
                                @if(count($tags))
                                    <div class="cs-portfolio-tag">
                                        <ul class="d-flex justify-content-md-end flex-wrap text-nowrap">
                                            @foreach($tags as $tag)
                                                <li><a href="{{ $project->url }}">{{ $tag }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
