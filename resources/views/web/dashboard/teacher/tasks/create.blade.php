@extends('web.dashboard.master')

@section('title','Tasks')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item">Tasks</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.tasks.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        </nav>
    </div>

    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create Task</h3>
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

        <form action="{{ route('dashboard.teacher.tasks.store') }}" method="POST">
        @csrf

        @if(session('academic_year_id'))
                <input type="hidden" name="academic_year_id" value="{{ session('academic_year_id') }}">
        @endif
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
            <label for="task_name">Task Name</label>
            <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Enter task name">
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="full_grade">Full Grade</label>
            <input type="number" name="full_grade" id="full_grade" class="form-control" placeholder="Enter full grade" step="0.5">
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
    </div>
</main>
@endsection
