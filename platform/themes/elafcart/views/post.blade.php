<article class="post-single">
    <section class="post-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="post-meta-top">
                        <span class="post-category">{{ $post->categories->first()?->name ?? 'Blog' }}</span>
                        <span class="post-date">{{ $post->created_at->format('d M, Y') }}</span>
                    </div>
                    <h1 class="post-title">{{ $post->name }}</h1>
                    @if($post->description)
                        <p class="post-excerpt">{{ $post->description }}</p>
                    @endif
                    <div class="post-author">
                        <img src="https://i.pravatar.cc/40?u={{ $post->author->id ?? 1 }}" alt="author" class="author-avatar">
                        <span>By {{ $post->author->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($post->image)
    <section class="post-image">
        <div class="container">
            <img src="{{ RvMedia::getImageUrl($post->image) }}" alt="{{ $post->name }}" class="post-featured-image">
        </div>
    </section>
    @endif

    <section class="post-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="ck-content">
                        {!! BaseHelper::clean($post->content) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
