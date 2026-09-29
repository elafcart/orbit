<section class="blog-loop section-padding">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h1 class="section-title">{{ SeoHelper::getTitle() ?: 'Blog' }}</h1>
            <p class="section-desc mx-auto">{{ SeoHelper::getDescription() ?: 'Latest articles and insights' }}</p>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-lg-4 col-md-6">
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
            @empty
                <div class="col-12 text-center py-5">
                    <p>No posts found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {!! $posts->withQueryString()->links() !!}
        </div>
    </div>
</section>
