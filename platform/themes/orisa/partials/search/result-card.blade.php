{{-- Image + title card for one search result (project, service).
     Reuses the generic blog-card styles so mixed result types share one look.
     Vars: $item (any model exposing name, url and image). --}}
<div class="blog-card col-lg-3 col-md-6 col-12 mb-30">
    <div class="blog-card__thumb hover-effect-1">
        <a href="{{ $item->url }}" class="blog-card__img-link">
            {{-- w-100 rather than blog-card__img: that class sets height:100% against a
                 thumb with no height, which collapses the image inside a grid column. --}}
            {{ RvMedia::image($item->image, $item->name, attributes: ['class' => 'w-100']) }}
        </a>
    </div>
    <div class="blog-card__content">
        <h3 class="h6 blog-card__title">
            <a href="{{ $item->url }}" class="blog-card__title-link">{!! BaseHelper::clean($item->name) !!}</a>
        </h3>
    </div>
</div>
