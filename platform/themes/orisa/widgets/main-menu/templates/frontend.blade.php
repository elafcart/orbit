<div class="at-main-menu {{ (BaseHelper::isHomepage() || request()->is('/')) ? 'menu-light' : '' }} d-inline-flex justify-content-center">
    {!! Menu::renderMenuLocation('main-menu', ['view' => 'main-menu', 'options' => ['class' => '']]) !!}
</div>
