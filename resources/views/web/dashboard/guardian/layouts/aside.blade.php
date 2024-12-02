<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard.guardian.home.index') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#students-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-people"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="students-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            @foreach($students_guardian as $student)
                <li>
                    <a class="nav-link collapsed" data-bs-target="#student-{{ $student->id }}-details" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person"></i>
                        <span>{{ $student->user->first_name }} {{ $student->user->last_name }}</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="student-{{ $student->id }}-details" class="nav-content collapse">
                        <li>
                            <a href="{{ route('dashboard.guardian.exam-grade.show', $student->id) }}">
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Grades for Exams</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.guardian.task-grade.show', $student->id) }}">
                                <i class="bi bi-list-task"></i>
                                <span>Grades for Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.guardian.attendance.show', $student->id) }}">
                                <i class="bi bi-calendar-check"></i>
                                <span>Attendance</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </li><!-- End Students Nav -->

<!-- Payment Section -->
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#payment-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-credit-card"></i><span>Payments</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="payment-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <!-- Payment History Section -->
        <li>
            <a class="collapsed" data-bs-target="#payment-history-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-earbuds"></i>
                <span>Payment History</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <!-- Dropdown of Students -->
            <ul id="payment-history-nav" class="nav-content collapse">
                @foreach($students_guardian as $student)
                    <li>
                        <a href="{{ route('dashboard.guardian.payment-history.show', $student->id) }}">
                            <i class="bi bi-wallet"></i>
                            <span>{{ $student->user->first_name }} {{ $student->user->last_name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</li><!-- End Payment Nav -->


</ul>
