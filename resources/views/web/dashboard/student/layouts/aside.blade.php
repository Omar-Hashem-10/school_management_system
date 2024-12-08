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

<!-- Certificate Link -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard.student.certificate.index') }}">
        <i class="bi bi-file-earmark-text"></i>
        <span>Certificate</span>
    </a>
</li>
<!-- End Certificate Nav -->


    <!-- Exam Section -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#exam-section" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i>
            <span>Exam</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="exam-section" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @foreach(session('student')->classRoom->courseCodes as $id => $course_code)
                <li>
                    <a href="{{ route('dashboard.student.exam.index', ['course_code' => $id]) }}">
                        <i class="bi bi-circle"></i><span>{{ $course_code->code }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>

    <!-- Task Section -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#task-section" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i>
            <span>Task</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="task-section" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            @foreach(session('student')->classRoom->courseCodes as $id => $course_code)
                <li>
                    <a href="{{ route('dashboard.student.task.index', ['course_code' => $id]) }}">
                        <i class="bi bi-circle"></i><span>{{ $course_code->code }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>

    <!-- Contact Section -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard.student.contact.index') }}">
            <i class="bi bi-envelope"></i>
            <span>Contact</span>
        </a>
    </li>
    <!-- End Contact Section -->

</ul>
