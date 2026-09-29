@php
    $menu = $menu ?? null;
    if (!$menu) return;
@endphp

@foreach($menu->nodes as $node)
    @php
        $hasChildren = $node->hasChild();
        $url = $node->url;
        $isActive = $node->active;
    @endphp
    <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }} {{ $isActive ? 'active' : '' }}">
        <a href="{{ $url }}" class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }}" @if($hasChildren) data-bs-toggle="dropdown" @endif>
            {{ $node->title }}
        </a>
        @if($hasChildren)
            <ul class="dropdown-menu">
                @foreach($node->child as $child)
                    <li><a href="{{ $child->url }}" class="dropdown-item">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
