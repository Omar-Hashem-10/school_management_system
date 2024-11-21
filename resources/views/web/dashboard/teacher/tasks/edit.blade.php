@extends('web.dashboard.master')

@section('title','Edit Task')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item">Tasks</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.tasks.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        </nav>
    </div>

    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Task</h3>
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

        <form action="{{ route('dashboard.teacher.tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="course_code_id" value="{{ $task->course_code_id }}">
        <input type="hidden" name="class_room_id" value="{{ $task->class_room_id }}">
        <input type="hidden" name="teacher_id" value="{{ $task->teacher_id }}">

        <div class="form-group mb-3">
            <label for="task_name">Task Name</label>
            <input type="text" name="task_name" id="task_name" class="form-control"
                   placeholder="Enter task name" value="{{ old('task_name', $task->task_name) }}">
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control"
                   value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($task->start_date))) }}">
        </div>

        <div class="form-group mb-3">
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control"
                   value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($task->end_date))) }}">
        </div>

        <div class="form-group mb-3">
            <label for="full_grade">Full Grade</label>
            <input type="number" name="full_grade" id="full_grade" class="form-control"
                   placeholder="Enter full grade" step="0.5" value="{{ old('full_grade', $task->full_grade) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
    </div>
</main>
@endsection
