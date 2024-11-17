@extends('web.dashboard.master')

@section('title','Edit Exam')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.students.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        </nav>
    </div>

    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Exam</h3>
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
        <form action="{{ route('dashboard.teacher.exams.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if(session('course_level_id'))
                <input type="hidden" name="course_level_id" value="{{ session('course_level_id') }}">
        @endif
        @if(session('class_room_id'))
                <input type="hidden" name="class_room_id" value="{{ session('class_room_id') }}">
        @endif
        @if(session('teacher_id'))
                <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">
        @endif

        <div class="form-group mb-3">
            <label for="exam_name">Exam Name</label>
            <input type="text" name="exam_name" id="exam_name" class="form-control" placeholder="Enter exam name" value="{{ old('exam_name', $exam->exam_name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="exam_date">Exam Date</label>
            <input type="datetime-local" name="exam_date" id="exam_date" class="form-control" value="{{ old('exam_date', \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="exam_duration">Exam Duration (in minutes)</label>
            <input type="number" name="exam_duration" id="exam_duration" class="form-control" placeholder="Enter exam duration" value="{{ old('exam_duration', $exam->exam_duration) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="half_grade">Half Grade</label>
            <input type="number" name="half_grade" id="half_grade" class="form-control" placeholder="Enter half grade" value="{{ old('half_grade', $exam->half_grade) }}" step="0.5" required>
        </div>

        <a href="{{ route('dashboard.teacher.exam-questions.edit', $exam->id) }}" class="btn btn-secondary">Edit Questions</a>
        <button type="submit" class="btn btn-primary">Update Exam</button>
        </form>

    </div>
    </div>
</main>
@endsection
