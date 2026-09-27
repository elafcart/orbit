<div class="at-services-widget">
    @if ($config['title'])
        <h4 class="widget-title mb-4">{{ $config['title'] }}</h4>
    @endif
    @if ($services->isNotEmpty())
        <div class="sidebar">
            @foreach ($services as $service)
                <a href="{{ $service->url }}" class="d-flex justify-content-between align-items-center mb-2 py-3 px-3 border">
                    {{ $service->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M17.4177 5.41772L16.3487 6.48681L21.1059 11.244H0V12.756H21.1059L16.3487 17.5132L17.4177 18.5822L24 12L17.4177 5.41772Z" fill="currentColor" />
                    </svg>
                </a>
            @endforeach
        </div>
    @endif
</div>
