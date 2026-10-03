@php
    $title = $shortcode->title ?? __('Frequently Asked Questions');
    $subtitle = $shortcode->subtitle ?? __('FAQ');
@endphp

<section class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        <div class="mx-auto mt-10 max-w-3xl space-y-3" data-animate="stagger" data-stagger="0.06">
            @foreach ($faqs as $faq)
                <details class="card group px-6 py-4 open:ring-1 open:ring-brand-600/30">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-semibold text-slate-900 select-none dark:text-white">
                        {{ $faq->question }}
                        <svg class="size-4 shrink-0 text-slate-400 transition duration-200 group-open:rotate-45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                    </summary>
                    <div class="pt-3 text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                        {!! BaseHelper::clean($faq->answer) !!}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
