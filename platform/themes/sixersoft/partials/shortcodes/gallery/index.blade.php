@php
    $title = $shortcode->title ?? __('Gallery');
    $subtitle = $shortcode->subtitle ?? __('Moments');
@endphp

<section class="section bg-slate-50 dark:bg-slate-900/40">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.08">
            @foreach ($galleries as $gallery)
                <figure class="card card-hover group relative overflow-hidden">
                    <div class="aspect-[4/3] overflow-hidden bg-slate-100 dark:bg-slate-800">
                        @if ($gallery->image)
                            <img
                                src="{{ RvMedia::getImageUrl($gallery->image, 'medium') }}"
                                alt="{{ $gallery->name }}"
                                loading="lazy"
                                decoding="async"
                                class="size-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @endif
                    </div>
                    <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/85 to-transparent p-4 pt-10">
                        <p class="text-sm font-semibold text-white">{{ $gallery->name }}</p>
                        @if ($gallery->description)
                            <p class="mt-0.5 line-clamp-1 text-xs text-slate-300">{{ $gallery->description }}</p>
                        @endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
