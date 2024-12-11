@extends('web.dashboard.master')

@section('title', 'Edit Feedback')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item">Feedbacks</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.feedback.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Feedback</h3>
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

            <form action="{{ route('dashboard.teacher.feedback.update', $feedback->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="academic_year_id" value="{{ session('academic_year_id')}}">
                <input type="hidden" name="teacher_id" value="{{ session('teacher_id')}}">
                <input type="hidden" name="student_id" value="{{ $feedback->student_id }}">
                <input type="hidden" name="task_id" value="{{ $feedback->task_id }}">

                <!-- Feedback Text -->
                <div class="form-group mb-3">
                    <label for="feedback_text">Feedback Text</label>
                    <textarea name="feedback_text" id="feedback_text" class="form-control" rows="4"
                              placeholder="Enter your feedback">{{ old('feedback_text', $feedback->feedback_text) }}</textarea>
                </div>

                <!-- Task Grade -->
                <div class="form-group mb-3">
                    <label for="task_grade">Task Grade</label>
                    <input type="number" name="task_grade" id="task_grade" class="form-control"
                           placeholder="Enter task grade" step="0.5" min="0" max="{{$feedback->task->full_grade}}" value="{{ old('task_grade', $feedback->task_grade) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Feedback</button>
            </form>
        </div>
    </div>
</main>
@endsection
