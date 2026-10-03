@include(Theme::getThemeNamespace('partials.breadcrumb'))

<article class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-3xl">
            <header data-animate="fade-up">
                @if (! empty($project->client) || ! empty($project->place))
                    <div class="flex flex-wrap gap-2 text-xs font-semibold tracking-wide text-slate-500 uppercase dark:text-slate-400">
                        @if (! empty($project->client))
                            <span class="rounded-full bg-brand-600/10 px-3 py-1 text-brand-600 dark:text-brand-400">{{ $project->client }}</span>
                        @endif
                        @if (! empty($project->place))
                            <span class="rounded-full bg-slate-200/70 px-3 py-1 dark:bg-slate-800">{{ $project->place }}</span>
                        @endif
                    </div>
                @endif

                <h1 class="mt-4 font-display text-3xl font-bold tracking-tight text-balance sm:text-5xl">
                    {{ $project->name }}
                </h1>

                @if ($project->description)
                    <p class="mt-4 text-lg text-slate-500 dark:text-slate-400">{{ $project->description }}</p>
                @endif
            </header>
        </div>

        @if ($project->image)
            <div class="mt-10" data-animate="zoom-in">
                <img
                    src="{{ RvMedia::getImageUrl($project->image, 'large') }}"
                    alt="{{ $project->name }}"
                    fetchpriority="high"
                    decoding="async"
                    class="mx-auto max-h-[540px] w-full rounded-2xl object-cover"
                >
            </div>
        @endif

        @php
            $metrics = collect([
                ['value' => $project->metric_1_value, 'label' => $project->metric_1_label],
                ['value' => $project->metric_2_value, 'label' => $project->metric_2_label],
                ['value' => $project->metric_3_value, 'label' => $project->metric_3_label],
            ])->filter(fn ($metric) => ! empty($metric['value']) || ! empty($metric['label']));
        @endphp

        @if ($metrics->isNotEmpty())
            <div class="mx-auto mt-10 grid max-w-3xl gap-4 sm:grid-cols-3" data-animate="stagger" data-stagger="0.1">
                @foreach ($metrics as $metric)
                    <div class="card p-5 text-center">
                        <p class="font-display text-2xl font-bold text-brand-600 dark:text-brand-400">{{ $metric['value'] }}</p>
                        <p class="mt-1 text-xs font-medium tracking-wide text-slate-500 uppercase dark:text-slate-400">{{ $metric['label'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="entry-content mx-auto mt-10 max-w-3xl">
            {!! BaseHelper::clean($project->content) !!}
        </div>

        <div class="mx-auto mt-12 max-w-3xl text-center">
            <a href="{{ url('/') }}" class="btn btn-outline">{{ __('Back to Home') }}</a>
        </div>
    </div>
</article>
