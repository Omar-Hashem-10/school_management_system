@extends('web.dashboard.master')

@section('title','Tasks')

@section('content')
@if(app()->getLocale()=='ar')
<div class="container">
    @endif
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.student.task.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Update Task</li>
            </ol>
        </nav>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Task</h3>
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

            <form action="{{ route('dashboard.student.task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="task_link">Task Link</label>
                    <input type="url" id="task_link" name="task_link" class="form-control" placeholder="Enter task link" value="{{ old('task_link', $task->task_link) }}" required>
                </div>

                <input type="hidden" name="academic_year_id" value="{{ session('academic_year_id') }}">
                <input type="hidden" name="task_id" value="{{ $taskId }}">
                <input type="hidden" name="student_id" value="{{ session('student_id') }}">

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update Task Link</button>
                </div>
            </form>
        </div>
    </div>
</main>
@if(app()->getLocale()=='ar')
</div>
    @endif
@endsection
