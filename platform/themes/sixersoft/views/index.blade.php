@php
    // Fallback homepage — rendered when no page is selected as homepage yet.
    $latestPosts = collect();

    if (is_plugin_active('blog')) {
        $latestPosts = \Botble\Blog\Models\Post::wherePublished()->latest()->limit(3)->get();
    }

    $hasPortfolio = is_plugin_active('portfolio');
@endphp

{{-- Hero --}}
<section class="relative overflow-hidden bg-slate-50 dark:bg-slate-900/40">
    <div class="pointer-events-none absolute -top-32 left-1/2 size-96 -translate-x-1/2 rounded-full bg-brand-600/15 blur-3xl" aria-hidden="true"></div>

    <div class="container-shell relative py-20 text-center sm:py-28">
        <div data-animate="stagger" data-stagger="0.12">
            <span class="section-eyebrow inline-flex items-center gap-2 rounded-full border border-brand-600/30 bg-brand-600/5 px-4 py-1.5">
                <span class="size-1.5 rounded-full bg-brand-600"></span>
                Sixersoft · Botble CMS Starter Theme
            </span>

            <h1 class="mx-auto mt-6 max-w-3xl font-display text-4xl font-bold tracking-tight text-balance sm:text-6xl">
                {{ theme_option('hero_title', __('Build something extraordinary')) }}
            </h1>

            <p class="mx-auto mt-5 max-w-2xl text-lg text-slate-500 dark:text-slate-400">
                {{ theme_option('hero_subtitle', __('Sixersoft is a basic Botble CMS starter theme powered by Tailwind CSS, GSAP and Vite.')) }}
            </p>

            <div class="mt-9 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/blog') }}" class="btn btn-primary">
                    {{ __('Explore the Blog') }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="https://botble.com/docs" target="_blank" rel="noopener" class="btn btn-outline">{{ __('Read the Docs') }}</a>
            </div>
        </div>

        {{-- Counters --}}
        <div class="mx-auto mt-16 grid max-w-3xl grid-cols-3 gap-6" data-animate="fade-up" data-delay="0.3">
            @foreach ([['value' => 4, 'suffix' => '', 'label' => __('Tailwind v4')], ['value' => 60, 'suffix' => 'fps', 'label' => __('GSAP Animations')], ['value' => 100, 'suffix' => '%', 'label' => __('Vite Powered')]] as $stat)
                <div class="card p-5">
                    <p class="font-display text-3xl font-bold text-brand-600" data-counter="{{ $stat['value'] }}" data-counter-suffix="{{ $stat['suffix'] }}">0</p>
                    <p class="mt-1 text-xs font-medium tracking-wide text-slate-500 uppercase dark:text-slate-400">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Features --}}
<section class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ __('What is inside') }}</span>
            <h2 class="section-title">{{ __('A modern foundation, ready to extend') }}</h2>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-3" data-animate="stagger" data-stagger="0.12">
            <div class="card card-hover p-8">
                <span class="flex size-12 items-center justify-center rounded-xl bg-brand-600/10 text-brand-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 2 2 7l10 5 10-5-10-5ZM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </span>
                <h3 class="mt-5 text-lg font-semibold">{{ __('Tailwind CSS v4') }}</h3>
                <p class="mt-2 text-sm leading-relaxed">{{ __('Utility-first styling compiled through the Vite pipeline. Dark mode, design tokens and responsive layout out of the box.') }}</p>
            </div>

            <div class="card card-hover p-8">
                <span class="flex size-12 items-center justify-center rounded-xl bg-brand-600/10 text-brand-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z" />
                    </svg>
                </span>
                <h3 class="mt-5 text-lg font-semibold">{{ __('GSAP Animations') }}</h3>
                <p class="mt-2 text-sm leading-relaxed">{{ __('Scroll-triggered reveals, staggered sections and counters powered by GSAP ScrollTrigger — with reduced-motion support.') }}</p>
            </div>

            <div class="card card-hover p-8">
                <span class="flex size-12 items-center justify-center rounded-xl bg-brand-600/10 text-brand-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m5 3 14 9-14 9V3Z" />
                    </svg>
                </span>
                <h3 class="mt-5 text-lg font-semibold">{{ __('Vite Build') }}</h3>
                <p class="mt-2 text-sm leading-relaxed">{{ __('One command builds every asset. Edit assets/ then run pnpm run dev or pnpm run prod and the theme picks it up.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Portfolio (from the default portfolio plugin) --}}
@if ($hasPortfolio)
    @include(Theme::getThemeNamespace('partials.shortcodes.portfolio.index'), [
        'shortcode' => (object) ['title' => __('Selected Works'), 'subtitle' => __('Portfolio'), 'limit' => 3],
    ])
@endif

{{-- Latest posts --}}
@if ($latestPosts->isNotEmpty())
    <section class="section bg-slate-50 dark:bg-slate-900/40">
        <div class="container-shell">
            <div class="flex flex-wrap items-end justify-between gap-4" data-animate="fade-up">
                <div>
                    <span class="section-eyebrow">{{ __('From the blog') }}</span>
                    <h2 class="section-title">{{ __('Latest Articles') }}</h2>
                </div>
                <a href="{{ url('/blog') }}" class="btn btn-outline">{{ __('View All') }}</a>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3" data-animate="stagger" data-stagger="0.12">
                @foreach ($latestPosts as $post)
                    <article class="card card-hover group overflow-hidden">
                        <a href="{{ $post->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800">
                            @if ($post->image)
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium') }}" alt="{{ $post->name }}" class="size-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" decoding="async">
                            @endif
                        </a>
                        <div class="p-6">
                            <p class="text-xs font-medium text-slate-400">{{ Theme::formatDate($post->created_at) }}</p>
                            <h3 class="mt-2 line-clamp-2 text-lg font-semibold leading-snug">
                                <a href="{{ $post->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $post->name }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- Setup guide --}}
<section class="section">
    <div class="container-shell" data-animate="fade-up">
        <div class="card border-dashed border-brand-600/50 p-8 sm:p-10">
            <h2 class="font-display text-2xl font-bold">{{ __('🚀 Quick Setup Guide') }} · দ্রুত সেটআপ গাইড</h2>
            <p class="mt-3 text-sm leading-relaxed">{{ __('You are seeing this page because no homepage is selected yet.') }} — আপনি এই পেজটি দেখছেন কারণ এখনো কোনো হোমপেজ নির্বাচন করা হয়নি।</p>

            <ol class="mt-6 space-y-4 text-sm leading-relaxed">
                <li class="flex gap-3">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-brand-600/10 text-xs font-bold text-brand-600">1</span>
                    <span><strong>Admin → Appearance → Menus</strong> — {{ __('Create the main menu (location: Main Navigation).') }} মূল মেনু তৈরি করুন।</span>
                </li>
                <li class="flex gap-3">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-brand-600/10 text-xs font-bold text-brand-600">2</span>
                    <span><strong>Admin → Pages</strong> — {{ __('Create a page (e.g. "Home") and pick the "Homepage" template.') }} একটি পেজ তৈরি করে "Homepage" টেমপ্লেট নির্বাচন করুন।</span>
                </li>
                <li class="flex gap-3">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-brand-600/10 text-xs font-bold text-brand-600">3</span>
                    <span><strong>Admin → Appearance → Theme Options</strong> — {{ __('Set your homepage under "Page" and the primary color in the Sixersoft section.') }} হোমপেজ নির্বাচন ও প্রাইমারি কালার পরিবর্তন করুন।</span>
                </li>
                <li class="flex gap-3">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-brand-600/10 text-xs font-bold text-brand-600">4</span>
                    <span>
                        <strong>{{ __('Build assets') }}</strong> —
                        <code class="rounded bg-slate-100 px-2 py-0.5 font-mono text-xs text-brand-700 dark:bg-slate-800 dark:text-brand-300">pnpm install && pnpm run prod</code>
                        {{ __('(already built if you received this theme packaged).') }}
                    </span>
                </li>
            </ol>
        </div>
    </div>
</section>
