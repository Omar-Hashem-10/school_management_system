<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

@can('isAdmin')
    @include('web.dashboard.admin.layouts.aside')
@endcan

@can('isTeacher')
    @include('web.dashboard.teacher.layouts.aside')
@endcan

@can('isStudent')
    @include('web.dashboard.student.layouts.aside')
@endcan


</aside><!-- End Sidebar-->
