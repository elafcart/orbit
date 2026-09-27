@php
    Theme::set('withoutLayout', true);
@endphp

@extends(Theme::getThemeNamespace('layouts.base'))

@section('content')
    {!! Theme::content() !!}
@endsection
