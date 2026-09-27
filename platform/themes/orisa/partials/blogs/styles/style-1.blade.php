<div class="blog-card__thumb hover-effect-1">
    <a href="{{ $post->url }}" class="blog-card__img-link">
        {{ RvMedia::image($post->image, $post->name, 'horizontal_thumb', attributes: ['class' => 'blog-card__img22']) }}
    </a>
</div>
<div class="blog-card__content">
    <h3 class="h6 blog-card__title">
        <a href="{{ $post->url }}" class="blog-card__title-link">{!! BaseHelper::clean($post->name) !!}</a>
    </h3>
    <p class="blog-card__meta">
        <span class="blog-card__meta-text">{{ __('By') }} </span>
        <span class="blog-card__author">{{ $post->author->name ?? '' }}</span>
        <span class="blog-card__meta-text"> – {{ Theme::formatDate($post->created_at) }}</span>
    </p>
</div>
