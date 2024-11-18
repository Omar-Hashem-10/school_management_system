<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.teacher.home') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#students-nav">
                    <i class="bi bi-person"></i><span>Students</span>
                </a>
                {{-- <ul class="nav-content collapse" id="students-nav" data-bs-parent="#components-nav">
                    @foreach($class_room_names as $class_room_id => $class_name)
                        <li>
                            <a href="{{ route('dashboard.teacher.students.index', $class_room_id) }}">
                                <i class="bi bi-circle"></i><span>{{ $class_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
            </li>

            <li>
                <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#exams-nav">
                    <i class="bi bi-building"></i><span>Exams</span>
                </a>
                {{-- <ul class="nav-content collapse" id="exams-nav" data-bs-parent="#components-nav">
                    @foreach($class_room_names as $class_room_id => $class_name)
                        <li>
                            <a href="{{ route('dashboard.teacher.exams.index', ['class_room_id' => $class_room_id]) }}">
                                <i class="bi bi-circle"></i><span>{{ $class_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
            </li>

            <li>
                <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#questions-nav">
                    <i class="bi bi-question-circle"></i><span>Questions</span>
                </a>
                {{-- <ul class="nav-content collapse" id="questions-nav" data-bs-parent="#components-nav">
                    @foreach($course_codes as $id => $course_code)
                        <li>
                            <a href="{{ route('dashboard.teacher.questions.index', ['course_level_id' => $id]) }}">
                                <i class="bi bi-circle"></i><span>{{ $course_code }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
            </li>

            <li>
                <a href="javascript:void(0)" class="nav-link" data-bs-toggle="collapse" data-bs-target="#tasks-nav">
                    <i class="bi bi-building"></i><span>Tasks</span>
                </a>
                {{-- <ul class="nav-content collapse" id="tasks-nav" data-bs-parent="#components-nav">
                    @foreach($class_room_names as $class_room_id => $class_name)
                        <li>
                            <a href="{{ route('dashboard.teacher.tasks.index', ['class_room_id' => $class_room_id]) }}">
                                <i class="bi bi-circle"></i><span>{{ $class_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul> --}}
            </li>

        </ul>
    </li>

</ul>
