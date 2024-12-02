<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="{{ route('dashboard.admin.home.index') }}">
      <i class="bi bi-grid"></i>
      <span>{{ __('custom.aside.Dashboard') }}</span>
    </a>
  </li><!-- End Dashboard Nav -->
  @cannot('isHR')
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>{{ __('custom.aside.Managements') }}</span><i
        class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <!-- Other sections -->
      <li>
        <a href="{{ route('dashboard.admin.academic-years.index') }}">
          <i class="bi bi-circle"></i><span>Academic years</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.levels.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Levels') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.subjects.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Subjects') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.level_subjects.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Level_Subjects') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.course_codes.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Course_Codes') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.class_rooms.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Classrooms') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.days.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Days') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.time_slots.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Time_Slots') }}</span>
        </a>
      </li>
      <!-- Schedule Section -->
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#schedule-nav">
          <i class="bi bi-calendar"></i><span>{{ __('custom.aside.Schedule') }}</span>
        </a>
        <ul class="nav-content collapse" id="schedule-nav" data-bs-parent="#components-nav">
          @foreach($classRooms as $classRoom)
          <li>
            <a href="{{ route('dashboard.admin.schedules.index', ['class_room_id' => $classRoom->id]) }}">
              <i class="bi bi-circle"></i><span>{{ $classRoom->name }}</span>
            </a>
          </li>
          @endforeach
        </ul>
      </li>
    </ul>
  </li>
  @endcannot
  <!-- Users Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-group-line"></i><span>{{ __('custom.aside.Users') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @can('isAdmin')
      <li>
        <a href="{{ route('dashboard.admin.admins.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Admins') }}</span>
        </a>
      </li>
      @endcan

      @canany('isAdmin','isManager')
      <li>
        <a href="{{ route('dashboard.admin.users.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Users') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.roles.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Roles') }}</span>
        </a>
      </li>
      @endcanany

      @cannot('isAcademicAffairs')
      <li>
        <a href="{{ route('dashboard.admin.employees.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Employees') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.teachers.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Teachers') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.salaries.show.dates') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Salaries') }}</span>
        </a>
      </li>   
      @endcannot

      @cannot('isHR')
      <li>
        <a href="{{ route('dashboard.admin.students.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Students') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.guardians.index') }}">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Guardians') }}</span>
        </a>
      </li>
     @endcannot

    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#attendances-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>{{ __('custom.aside.Attendance.Attendance') }}</span><i
        class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="attendances-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @cannot('isHR')
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#attendStudent-nav">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Attendance.Students') }}</span>
        </a>
        <ul class="nav-content collapse" id="attendStudent-nav" data-bs-parent="#attendances-nav">
          @foreach($classRooms as $classRoom)
          <li>
            <a href="{{ route('dashboard.admin.attend_students.show', $classRoom->id) }}">
              <i class="bi bi-circle"></i><span>{{ $classRoom->name }}</span>
            </a>
          </li>
          @endforeach
        </ul>
      </li>
      @endcannot
      @cannot('isAcademicAffairs')
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#attendEmployee-nav">
          <i class="bi bi-circle"></i><span>{{ __('custom.aside.Attendance.Employees') }}</span>
        </a>
        <ul class="nav-content collapse" id="attendEmployee-nav" data-bs-parent="#attendances-nav">
          <li>
            <a href="{{ route('dashboard.admin.attend_teachers.show') }}">
              <i class="bi bi-circle"></i><span>{{ __('custom.aside.Teachers') }}</span>
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.admin.attend_admins.show') }}">
              <i class="bi bi-circle"></i><span>{{ __('custom.aside.Admins') }}</span>
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.admin.attend_employees.show') }}">
              <i class="bi bi-circle"></i><span>{{ __('custom.aside.Employees') }}</span>
            </a>
          </li>
        </ul>
      </li>
      @endcannot
  </li>
</ul>