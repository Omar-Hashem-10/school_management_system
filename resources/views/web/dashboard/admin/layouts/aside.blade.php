<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="{{ route('dashboard.admin.home.index') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
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
          <i class="bi bi-circle"></i><span>Levels</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.subjects.index') }}">
          <i class="bi bi-circle"></i><span>Subjects</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.level_subjects.index') }}">
          <i class="bi bi-circle"></i><span>Level Subjects</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.course_codes.index') }}">
          <i class="bi bi-circle"></i><span>Course Codes</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.class_rooms.index') }}">
          <i class="bi bi-circle"></i><span>Class rooms</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.days.index') }}">
          <i class="bi bi-circle"></i><span>Days</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.time_slots.index') }}">
          <i class="bi bi-circle"></i><span>Time Slots</span>
        </a>
      </li>
      <!-- Schedule Section -->
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#schedule-nav">
          <i class="bi bi-calendar"></i><span>Schedule</span>
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

  <!-- Users Section -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-group-line"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('dashboard.admin.admins.index') }}">
          <i class="bi bi-circle"></i><span>Admins</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.teachers.index') }}">
          <i class="bi bi-circle"></i><span>Teachers</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.employees.index') }}">
          <i class="bi bi-circle"></i><span>Employees</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.salaries.show.dates') }}">
          <i class="bi bi-circle"></i><span>salaries</span>

        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.students.index') }}">
          <i class="bi bi-circle"></i><span>Students</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.guardians.index') }}">
          <i class="bi bi-circle"></i><span>Guardians</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.users.index') }}">
          <i class="bi bi-circle"></i><span>Users</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.admin.roles.index') }}">
          <i class="bi bi-circle"></i><span>Roles</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#attendances-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>ِAttendances</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="attendances-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#attendStudent-nav">
          <i class="bi bi-circle"></i><span>Attendance Students</span>
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
      <li>
        <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#attendEmployee-nav">
          <i class="bi bi-circle"></i><span>Attendance Employees</span>
        </a>
        <ul class="nav-content collapse" id="attendEmployee-nav" data-bs-parent="#attendances-nav">
          <li>
            <a href="{{ route('dashboard.admin.attend_teachers.show') }}">
              <i class="bi bi-circle"></i><span>Teachers</span>
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.admin.attend_admins.show') }}">
              <i class="bi bi-circle"></i><span>Admins</span>
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.admin.attend_employees.show') }}">
              <i class="bi bi-circle"></i><span>Employees</span>
            </a>
          </li>
        </ul>
      </li>
  </li>
</ul>
