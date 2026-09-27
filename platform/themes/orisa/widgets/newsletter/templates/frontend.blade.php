<div class="at-newsletter-widget">
    @if ($config['title'])
        <h4 class="text-white mb-3">{{ $config['title'] }}</h4>
    @endif
    @if (is_plugin_active('newsletter'))
        {!! do_shortcode(Shortcode::generateShortcode('newsletter-form')) !!}
    @endif
</div>
