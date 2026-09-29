@php
    $title = $shortcode->title ?? 'Latest Articles';
    $subtitle = $shortcode->subtitle ?? 'Blog';
    $limit = $shortcode->limit ?? 3;
    $posts = collect();
    if (is_plugin_active('blog')) {
        $posts = \Botble\Blog\Models\Post::wherePublished()->latest()->limit($limit)->get();
    }
@endphp

@if($posts->count())
<section class="blog-section section-padding" id="blog">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="section-subtitle">{{ $subtitle }}</span>
                <h2 class="section-title mb-0">{{ $title }}</h2>
            </div>
            <a href="{{ url('/blog') }}" class="btn btn-outline-dark rounded-pill d-none d-md-inline-flex">View All <i class="bi bi-arrow-up-right ms-2"></i></a>
        </div>

        <div class="row g-4">
            @foreach($posts as $index => $post)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <a href="{{ $post->url }}" class="blog-card">
                        <div class="blog-image">
                            @if($post->image)
                                <img src="{{ RvMedia::getImageUrl($post->image) }}" alt="{{ $post->name }}">
                            @else
                                <div class="blog-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span>{{ $post->created_at->format('d M Y') }}</span>
                                <span>•</span>
                                <span>{{ $post->categories->first()?->name ?? 'General' }}</span>
                            </div>
                            <h4>{{ $post->name }}</h4>
                            <p>{{ Str::limit($post->description, 80) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
