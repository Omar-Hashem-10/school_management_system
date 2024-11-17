<ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.student.home') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- End Dashboard Nav -->

    <!-- Schedule Link -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.student.schedule') }}">
            <i class="bi bi-calendar"></i>
            <span>Schedule</span>
        </a>
    </li>
    <!-- End Schedule Nav -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#exam-section" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i>
            <span>Exam</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="exam-section" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @foreach($course_level_codes as $id => $course_code)
                <li>
                    <a href="{{ route('dashboard.student.exam.index', ['course_level_id' => $id]) }}">
                        <i class="bi bi-circle"></i><span>{{ $course_code }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#task-section" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i>
            <span>Task</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="task-section" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @foreach($course_level_codes as $id => $course_code)
                <li>
                    <a href="{{ route('dashboard.student.task.index', ['course_level_id' => $id]) }}">
                        <i class="bi bi-circle"></i><span>{{ $course_code }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>


</ul>
