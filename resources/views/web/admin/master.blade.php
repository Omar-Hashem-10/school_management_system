<!DOCTYPE html>
<html lang="en">

@include('web.admin.layouts.header.head')

<body>

  @include('web.admin.layouts.header.nav')
  @include('web.admin.layouts.header.aside')

  

  <main id="main" class="main">

    @include('web.admin.layouts.header.pageHeader')

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
@include('web.admin.layouts.footer.footer')

 

</body>

</html>