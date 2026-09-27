<div class="at-blog-card style-2 d-flex gap-4 align-items-center">
    <div class="at-blog-card-img overflow-hidden rounded-3 flex-shrink-0" style="width: 200px;">
        <a href="{{ $post->url }}">
            {{ RvMedia::image($post->image, $post->name, 'horizontal_thumb', attributes: ['class' => 'w-100 img-cover']) }}
        </a>
    </div>
    <div class="at-blog-card-content">
        <div class="d-flex align-items-center gap-3 mb-2">
            @if($post->categories->isNotEmpty())
                <a href="{{ $post->categories->first()->url }}" class="at-btn-tag fz-font-sm">
                    {{ $post->categories->first()->name }}
                </a>
            @endif
            <span class="fz-font-sm opacity-50">{{ Theme::formatDate($post->created_at) }}</span>
        </div>
        <h6 class="mb-0">
            <a href="{{ $post->url }}">{!! BaseHelper::clean($post->name) !!}</a>
        </h6>
    </div>
</div>
