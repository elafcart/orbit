@extends(Theme::getThemeNamespace('layouts.base'))

{{--
    Content page layout: a boxed, centered column for text-heavy pages such as
    Privacy Policy, Terms & Conditions, or Refund/Return Policy. Unlike the
    default and full-width templates (which render page content edge-to-edge so
    page-builder sections can span the viewport), this wraps the content in a
    `.container` so plain typed text gets proper left/right margins and reads as
    a tidy, readable column. `pb-100` adds breathing room above the footer; the
    top spacing is already handled by the breadcrumb or the header-spacing offset
    inside views/page.blade.php.
--}}

@section('content')
    <div class="container pb-100">
        {!! Theme::content() !!}
    </div>
@endsection
