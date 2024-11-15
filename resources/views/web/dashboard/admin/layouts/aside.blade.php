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

        <!-- Attends Section -->
        <li>
            <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#attends-nav">
                <i class="bi bi-circle"></i><span>Attends</span>
            </a>
            <ul class="nav-content collapse" id="attends-nav" data-bs-parent="#components-nav">
                @foreach($classRooms as $classRoom)
                    <li>
                        <a href="{{ route('dashboard.admin.attends.index', ['class_room_id' => $classRoom->id]) }}">
                            <i class="bi bi-circle"></i><span>{{ $classRoom->class_name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <!-- Other sections -->
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
                              <i class="bi bi-circle"></i><span>{{ $classRoom->class_name }}</span>
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

</ul>
