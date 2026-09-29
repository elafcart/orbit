<div class="page-wrapper">
    {!! apply_filters('ads_render', null, 'page_before', ['class' => 'text-center my-3']) !!}
    
    @if(!Theme::get('hidePageHeader'))
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">{{ $page->name }}</h1>
                @if($page->description)
                    <p class="page-desc">{{ $page->description }}</p>
                @endif
            </div>
        </div>
    </section>
    @endif

    <div class="page-content">
        {!! BaseHelper::clean($page->content) !!}
    </div>
    
    {!! apply_filters('ads_render', null, 'page_after', ['class' => 'text-center my-3']) !!}
</div>
