<div class="content-checklist py-4">
    <div class="row">
        @foreach(array_chunk($items, (int) ceil(count($items) / 2)) as $column)
            <div class="col-md-6">
                <ul class="list-unstyled">
                    @foreach($column as $item)
                        <li class="d-flex align-items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span class="fz-font-md">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
