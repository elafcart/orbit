{{-- Inline breadcrumb navigation for detail pages --}}
<div class="nav-menu d-flex align-items-center gap-2 pb-2 {{ $class ?? '' }}">
    @foreach ($crumbs as $crumb)
        @if (!$loop->first)
            <span class="nav-menu__item-separator">
                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11" fill="none">
                    <path d="M0.666992 0.666672L5.33366 5.33334L0.666992 10" stroke="#585959" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        @endif

        @if ($loop->last)
            <span class="nav-menu__item neutral-500">{{ $crumb['label'] }}</span>
        @else
            <a href="{{ $crumb['url'] }}" class="nav-menu__item neutral-900">{{ $crumb['label'] }}</a>
        @endif
    @endforeach
</div>
