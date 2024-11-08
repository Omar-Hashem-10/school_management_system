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
        <li>
          <a href="{{ route('dashboard.admin.attends.index') }}">
            <i class="bi bi-circle"></i><span>Attends</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.admin.levels.index') }}">
            <i class="bi bi-circle"></i><span>Levels</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.admin.courses.index') }}">
            <i class="bi bi-circle"></i><span>Courses</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.admin.course_levels.index') }}">
            <i class="bi bi-circle"></i><span>Course levels</span>
          </a>
        </li>
        <li>
          <a href="{{ route('dashboard.admin.class_rooms.index') }}">
            <i class="bi bi-circle"></i><span>Class room</span>
          </a>
        </li>
      </ul>
    </li>
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
      </ul>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.admin.teachers.index') }}">
            <i class="bi bi-circle"></i><span>Teachers</span>
          </a>
        </li>
      </ul>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.admin.salaries.index') }}">
            <i class="bi bi-circle"></i><span>salaries</span>
          </a>
        </li>
      </ul>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.admin.students.index') }}">
            <i class="bi bi-circle"></i><span>Students</span>
          </a>
        </li>
      </ul>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.admin.users.index') }}">
            <i class="bi bi-circle"></i><span>Users</span>
          </a>
        </li>
      </ul>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('dashboard.admin.roles.index') }}">
            <i class="bi bi-circle"></i><span>Roles</span>
          </a>
        </li>
      </ul>
    </li>

  </ul>
