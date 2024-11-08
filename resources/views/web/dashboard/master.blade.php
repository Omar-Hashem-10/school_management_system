<!DOCTYPE html>
<html lang="en">

@include('web.dashboard.layouts.header.head')

<body>
    <div class="wrapper">
        @include('web.dashboard.layouts.header.nav')
        @include('web.dashboard.layouts.header.aside')
        @yield('content')
        @include('web.dashboard.inc.errors')
        @include('web.dashboard.inc.success')
        @include('web.dashboard.layouts.footer.footer')
    </div>

</body>

</html>