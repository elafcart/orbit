@php
    $projectImages = array_values(array_unique(array_filter(array_merge(
        $project->image ? [$project->image] : [],
        is_array($project->images) ? $project->images : []
    ))));
    $projectLink = $project->getMetaData('link', true);
@endphp

<article class="project-single">
    <section class="project-hero">
        <div class="container">
            <div class="project-hero-content">
                <a href="{{ route('public.index') }}#projects" class="back-link"><i class="bi bi-arrow-left"></i> Back to Projects</a>
                <h1 class="project-title">{{ $project->name }}</h1>
                @if($project->description)
                    <p class="project-subtitle">{{ $project->description }}</p>
                @endif
                
                <div class="project-meta-grid">
                    @if($project->client)
                        <div class="meta-item">
                            <span class="meta-label">Client</span>
                            <span class="meta-value">{{ $project->client }}</span>
                        </div>
                    @endif
                    @if($project->start_date)
                        <div class="meta-item">
                            <span class="meta-label">Year</span>
                            <span class="meta-value">{{ $project->start_date->format('Y') }}</span>
                        </div>
                    @endif
                    @if($project->place)
                        <div class="meta-item">
                            <span class="meta-label">Location</span>
                            <span class="meta-value">{{ $project->place }}</span>
                        </div>
                    @endif
                    <div class="meta-item">
                        <span class="meta-label">Category</span>
                        <span class="meta-value">Web Development</span>
                    </div>
                </div>

                @if($projectLink)
                    <a href="{{ $projectLink }}" target="_blank" class="btn btn-primary rounded-pill mt-4">Live Preview <i class="bi bi-box-arrow-up-right ms-2"></i></a>
                @endif
            </div>
        </div>
    </section>

    @if($projectImages)
    <section class="project-gallery">
        <div class="container">
            <div class="gallery-main">
                <img src="{{ RvMedia::getImageUrl($projectImages[0]) }}" alt="{{ $project->name }}" class="gallery-main-image">
            </div>
            @if(count($projectImages) > 1)
            <div class="gallery-grid mt-4">
                <div class="row g-3">
                    @foreach(array_slice($projectImages, 1) as $img)
                        <div class="col-md-6">
                            <img src="{{ RvMedia::getImageUrl($img) }}" alt="{{ $project->name }}" class="gallery-thumb">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    <section class="project-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="ck-content">
                        {!! BaseHelper::clean($project->content) !!}
                    </div>

                    @if($project->metric_1_value || $project->metric_2_value || $project->metric_3_value)
                    <div class="project-metrics">
                        @if($project->metric_1_value)
                            <div class="metric">
                                <h3>{{ $project->metric_1_value }}</h3>
                                <p>{{ $project->metric_1_label }}</p>
                            </div>
                        @endif
                        @if($project->metric_2_value)
                            <div class="metric">
                                <h3>{{ $project->metric_2_value }}</h3>
                                <p>{{ $project->metric_2_label }}</p>
                            </div>
                        @endif
                        @if($project->metric_3_value)
                            <div class="metric">
                                <h3>{{ $project->metric_3_value }}</h3>
                                <p>{{ $project->metric_3_label }}</p>
                            </div>
                        @endif
                    </div>
                    @endif

                    <div class="project-share">
                        <span>Share:</span>
                        <div class="share-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($project->url) }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($project->url) }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($project->url) }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $related = \Botble\Portfolio\Models\Project::wherePublished()->where('id', '!=', $project->id)->latest()->limit(3)->get();
    @endphp
    @if($related->count())
    <section class="related-projects">
        <div class="container">
            <h3 class="section-title text-center mb-5">More Projects</h3>
            <div class="row g-4">
                @foreach($related as $rel)
                    <div class="col-md-4">
                        <a href="{{ $rel->url }}" class="project-card">
                            <div class="project-card-image">
                                <img src="{{ RvMedia::getImageUrl($rel->image) }}" alt="{{ $rel->name }}">
                            </div>
                            <div class="project-card-content">
                                <h4>{{ $rel->name }}</h4>
                                <p>{{ Str::limit($rel->description, 80) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</article>
