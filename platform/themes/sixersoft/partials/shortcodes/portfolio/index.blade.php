@php
    $title = $shortcode->title ?? __('Selected Works');
    $subtitle = $shortcode->subtitle ?? __('Portfolio');
    $limit = (int) ($shortcode->limit ?? 6);

    $projects = collect();

    if (is_plugin_active('portfolio')) {
        $projects = \Botble\Portfolio\Models\Project::wherePublished()->latest()->limit($limit)->get();
    }
@endphp

@if ($projects->isNotEmpty())
    <section class="section bg-slate-50 dark:bg-slate-900/40">
        <div class="container-shell">
            <div class="flex flex-wrap items-end justify-between gap-4" data-animate="fade-up">
                <div>
                    <span class="section-eyebrow">{{ $subtitle }}</span>
                    <h2 class="section-title">{{ $title }}</h2>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
                @foreach ($projects as $project)
                    <article class="card card-hover group overflow-hidden">
                        <a href="{{ $project->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                            @if ($project->image)
                                <img
                                    src="{{ RvMedia::getImageUrl($project->image, 'medium') }}"
                                    alt="{{ $project->name }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="size-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            @endif
                        </a>

                        <div class="p-6">
                            <h3 class="line-clamp-1 text-lg font-semibold">
                                <a href="{{ $project->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $project->name }}</a>
                            </h3>

                            @if ($project->description)
                                <p class="mt-2 line-clamp-2 text-sm leading-relaxed">{{ $project->description }}</p>
                            @endif

                            <a href="{{ $project->url }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400">
                                {{ __('View Project') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
