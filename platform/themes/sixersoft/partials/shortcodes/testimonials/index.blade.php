@php
    $title = $shortcode->title ?? __('What Clients Say');
    $subtitle = $shortcode->subtitle ?? __('Testimonials');
@endphp

<section class="section bg-slate-50 dark:bg-slate-900/40">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
            @foreach ($testimonials as $testimonial)
                <figure class="card card-hover flex h-full flex-col p-6">
                    <svg class="size-7 text-brand-600/40 dark:text-brand-400/40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M11 7H7a4 4 0 0 0-4 4v6h6v-6H6a1 1 0 0 1 1-1h4V7Zm10 0h-4a4 4 0 0 0-4 4v6h6v-6h-3a1 1 0 0 1 1-1h4V7Z" />
                    </svg>

                    <blockquote class="mt-4 flex-1 text-sm leading-relaxed">
                        {!! BaseHelper::clean($testimonial->content) !!}
                    </blockquote>

                    <figcaption class="mt-6 flex items-center gap-3 border-t border-slate-200 pt-4 dark:border-slate-800">
                        <span class="flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-brand-600/10 font-semibold text-brand-600 dark:text-brand-400">
                            @if ($testimonial->image)
                                <img src="{{ RvMedia::getImageUrl($testimonial->image, 'thumb') }}" alt="{{ $testimonial->name }}" loading="lazy" decoding="async" class="size-full object-cover">
                            @else
                                {{ mb_substr($testimonial->name, 0, 1) }}
                            @endif
                        </span>
                        <span>
                            <span class="block text-sm font-semibold text-slate-900 dark:text-white">{{ $testimonial->name }}</span>
                            @if ($testimonial->company)
                                <span class="block text-xs text-slate-500 dark:text-slate-400">{{ $testimonial->company }}</span>
                            @endif
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
