<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

@can('isAdmin')
    @include('web.dashboard.admin.layouts.aside')
@endcan


@can('isManager')
    @include('web.dashboard.admin.layouts.aside')
@endcan
@can('isHR')
    @include('web.dashboard.admin.layouts.aside')
@endcan
@can('isAcademicAffairs')
    @include('web.dashboard.admin.layouts.aside')
@endcan
@can('isTeacher')
    @include('web.dashboard.teacher.layouts.aside')
@endcan

@can('isStudent')
    @include('web.dashboard.student.layouts.aside')
@endcan

@can('isGuardian')
    @include('web.dashboard.guardian.layouts.aside')
@endcan


</aside>
