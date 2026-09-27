<div class="at-blog-posts-widget">
    @if ($config['title'])
        <h4 class="widget-title mb-4">{{ $config['title'] }}</h4>
    @endif
    @if ($posts->isNotEmpty())
        <ul class="list-unstyled">
            @foreach ($posts as $post)
                <li class="mb-3 pb-3 border-bottom">
                    <a href="{{ $post->url }}" class="d-block fw-medium mb-1">
                        {{ $post->name }}
                    </a>
                    <span class="text-muted small">
                        {{ $post->created_at->format(config('core.base.general.date_format.date', 'M d, Y')) }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
