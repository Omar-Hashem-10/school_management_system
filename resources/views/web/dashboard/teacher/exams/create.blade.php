    @extends('web.dashboard.master')

    @section('title','Students')

    @section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.students.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </nav>
        </div>

        <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Exam</h3>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('dashboard.teacher.exams.store') }}" method="POST">
            @csrf

            @if(session('course_code_id'))
                    <input type="hidden" name="course_code_id" value="{{ session('course_code_id') }}">
            @endif
            @if(session('class_room_id'))
                    <input type="hidden" name="class_room_id" value="{{ session('class_room_id') }}">
            @endif
            @if(session('teacher_id'))
                    <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">
            @endif

            <div class="form-group mb-3">
                <label for="name">Exam Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter exam name" required>
            </div>

            <div class="form-group mb-3">
                <label for="exam_date">Exam Date</label>
                <input type="datetime-local" name="exam_date" id="exam_date" class="form-control" required>
            </div>


            <div class="form-group mb-3">
                <label for="exam_duration">Exam Duration (in minutes)</label>
                <input type="number" name="exam_duration" id="exam_duration" class="form-control" placeholder="Enter exam duration" required>
            </div>

            <div class="form-group mb-3">
                <label for="half_grade">Half Grade</label>
                <input type="number" name="half_grade" id="half_grade" class="form-control" placeholder="Enter half grade" step="0.5" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Exam</button>
            </form>
        </div>
        </div>
    </main>
    @endsection
