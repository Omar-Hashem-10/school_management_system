@extends('web.dashboard.master')

@section('title','Feedback')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item">Tasks</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.tasks.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Give Feedback</li>
            </ol>
        </nav>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Give Feedback</h3>
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

            <form action="{{ route('dashboard.teacher.feedback.store') }}" method="POST">
                @csrf

                <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="task_id" value="{{ $task->id }}">

                <div class="form-group mb-3">
                    <label for="feedback_text">Feedback</label>
                    <textarea name="feedback_text" id="feedback_text" class="form-control" placeholder="Enter your feedback" rows="4"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="task_grade">Task Grade:- Full Grade({{$task->full_grade}})</label>
                    <input type="number" name="task_grade" id="task_grade" class="form-control" placeholder="Enter the grade" step="0.5" min="0" max="{{$task->full_grade}}">
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>
</main>
@endsection
