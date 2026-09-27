<div class="alt-footer-link-item col-6">
    <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{!! $config['name'] ? e($config['name']) : '&nbsp;' !!}</span>
    <ul>
        @foreach ($items as $item)
            @if (($label = $item->label) && ($url = $item->url))
                <li class="mb-15">
                    <a href="{{ url($url) }}" {!! $item->attributes ? BaseHelper::clean($item->attributes) : null !!}>
                        {!! BaseHelper::clean($label) !!}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
