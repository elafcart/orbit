@php
    $title = $shortcode->title ?? __('Meet The Team');
    $subtitle = $shortcode->subtitle ?? __('Our People');
@endphp

<section class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-animate="stagger" data-stagger="0.1">
            @foreach ($members as $member)
                <article class="card card-hover group overflow-hidden text-center">
                    <div class="aspect-[4/5] overflow-hidden bg-slate-100 dark:bg-slate-800">
                        @if ($member->photo)
                            <img
                                src="{{ RvMedia::getImageUrl($member->photo, 'medium') }}"
                                alt="{{ $member->name }}"
                                loading="lazy"
                                decoding="async"
                                class="size-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex size-full items-center justify-center font-display text-5xl font-bold text-slate-300 dark:text-slate-600">
                                {{ mb_substr($member->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="text-base font-semibold">
                            @if ($member->url)
                                <a href="{{ $member->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $member->name }}</a>
                            @else
                                {{ $member->name }}
                            @endif
                        </h3>

                        @if ($member->title)
                            <p class="mt-1 text-xs font-medium tracking-wide text-brand-600 uppercase dark:text-brand-400">{{ $member->title }}</p>
                        @endif

                        @if (! empty($member->socials))
                            <div class="mt-3 flex justify-center gap-2">
                                @foreach ((array) $member->socials as $social)
                                    @if (! empty($social['url'] ?? $social))
                                        <a
                                            href="{{ $social['url'] ?? $social }}"
                                            target="_blank"
                                            rel="noopener"
                                            aria-label="{{ $social['name'] ?? 'Social link' }}"
                                            class="flex size-8 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-brand-600 hover:text-white dark:bg-slate-800 dark:text-slate-300"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                            </svg>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
