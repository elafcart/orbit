<ul{!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $row)
        <li @class(['has-dropdown' => $row->has_child, $row->css_class => $row->css_class])>
            <a
                href="{{ $row->url }}"
                target="{{ $row->target }}"
                @class(['active' => $row->active])
            >{!! BaseHelper::clean($row->icon_html) !!}{{ $row->title }}</a>

            @if ($row->has_child)
                <ul class="at-submenu submenu">
                    @foreach ($row->child as $child)
                        <li @class(['has-dropdown' => $child->has_child, $child->css_class => $child->css_class])>
                            <a href="{{ $child->url }}" target="{{ $child->target }}" @class(['active' => $child->active])>
                                {!! BaseHelper::clean($child->icon_html) !!}
                                {{ $child->title }}
                            </a>
                            @if ($child->has_child)
                                <ul class="at-submenu submenu">
                                    @foreach ($child->child as $grandchild)
                                        <li>
                                            <a href="{{ $grandchild->url }}" target="{{ $grandchild->target }}" @class(['active' => $grandchild->active])>
                                                {!! BaseHelper::clean($grandchild->icon_html) !!}
                                                {{ $grandchild->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
