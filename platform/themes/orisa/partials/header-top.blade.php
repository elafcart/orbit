@if (theme_option('display_header_top'))
    <div class="header-top" style="--header-top-bg: {{ theme_option('header_top_background_color', '#f5eeff') }}; --header-top-text: {{ theme_option('header_top_text_color', '#000000') }};">
        <div class="container d-flex justify-content-between align-items-center py-2">
            {!! dynamic_sidebar('header_top_start_sidebar') !!}
            {!! dynamic_sidebar('header_top_end_sidebar') !!}
        </div>
    </div>
@endif
