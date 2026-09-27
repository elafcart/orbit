@php
    Theme::set('hideBreadcrumb', true);
    $teamSidebar = dynamic_sidebar('team_sidebar');
@endphp

{!! apply_filters('ads_render', null, 'team_before', ['class' => 'my-2 text-center']) !!}

<section class="pt-150 pb-80">
    <div class="container">
        <div class="row">
            <div @class(['col-12', 'col-lg-8' => $teamSidebar])>
                @include(Theme::getThemeNamespace('partials.inline-breadcrumb'), [
                    'crumbs' => [
                        ['url' => route('public.index'), 'label' => __('Home')],
                        ['label' => $team->name],
                    ],
                    'class' => 'mb-4',
                ])
                <div class="row align-items-center mb-5">
                    @if($team->image)
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="rounded-4 overflow-hidden">
                                {{ RvMedia::image($team->image, $team->name, attributes: ['class' => 'w-100']) }}
                            </div>
                        </div>
                    @endif
                    <div @class(['col-md-7' => $team->image, 'col-12' => !$team->image])>
                        <h2 class="mb-2">{!! BaseHelper::clean($team->name) !!}</h2>
                        @if($team->title)
                            <p class="fz-font-lg opacity-50 mb-3">{{ $team->title }}</p>
                        @endif
                        @if($team->socials && is_array($team->socials))
                            @php
                                $socialIconDefaults = [
                                    'facebook' => 'ti ti-brand-facebook',
                                    'twitter' => 'ti ti-brand-x',
                                    'instagram' => 'ti ti-brand-instagram',
                                    'linkedin' => 'ti ti-brand-linkedin',
                                    'youtube' => 'ti ti-brand-youtube',
                                    'tiktok' => 'ti ti-brand-tiktok',
                                    'github' => 'ti ti-brand-github',
                                    'dribbble' => 'ti ti-brand-dribbble',
                                    'behance' => 'ti ti-brand-behance',
                                ];
                            @endphp
                            <div class="d-flex gap-3">
                                @foreach($team->socials as $key => $url)
                                    @if(!empty($url))
                                        @php
                                            $iconName = trim((string) $team->getMetaData("social_icon_{$key}", true));
                                            if (! $iconName) {
                                                $iconName = $socialIconDefaults[$key] ?? 'ti ti-world';
                                            }
                                        @endphp
                                        <a href="{{ $url }}" target="_blank" rel="noopener" class="at-social-link" aria-label="{{ ucfirst($key) }}">
                                            {!! BaseHelper::renderIcon($iconName) !!}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                @if($team->description)
                    <p class="fz-font-lg mb-4">{!! BaseHelper::clean($team->description) !!}</p>
                @endif

                <div class="ck-content">
                    {!! BaseHelper::clean($team->content) !!}
                </div>

                <div class="d-flex align-items-center mt-5 py-3 border-top">
                    <span class="fw-bold me-2">{{ __('Share:') }}</span>
                    {!! Theme::renderSocialSharing($team->url, SeoHelper::getDescription(), $team->image) !!}
                </div>
            </div>

            @if($teamSidebar)
                <div class="col-lg-4 d-flex flex-column gap-4">
                    {!! $teamSidebar !!}
                </div>
            @endif
        </div>
    </div>
</section>

{!! apply_filters('ads_render', null, 'team_after', ['class' => 'my-2 text-center']) !!}
