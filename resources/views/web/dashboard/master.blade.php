<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

@include('web.dashboard.layouts.header.head')

<body>
    <div class="wrapper">
        @include('web.dashboard.layouts.header.nav')
        @include('web.dashboard.layouts.header.aside')
        @if(app()->getLocale()=='ar')
        <div class="container">
            @endif
            @yield('content')
            @if(app()->getLocale()=='ar')
        </div>
        @endif
        @include('web.dashboard.inc.errors')
        @include('web.dashboard.inc.success')
    </div>
    @include('web.dashboard.layouts.footer.footer')
    @yield('scripts')
</body>

</html>