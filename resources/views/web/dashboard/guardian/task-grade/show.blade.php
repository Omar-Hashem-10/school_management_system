@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Task Grades')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Task Grades for {{ $student->user->first_name . ' ' . $student->user->last_name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Tasks</li>
                <li class="breadcrumb-item active">Grades</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Task Grades for Student: {{ $student->user->first_name . ' ' . $student->user->last_name }}</h3>
                    </div>
                    <div class="card-body">

                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('dashboard.guardian.task-grade.show', $student->id) }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <select name="academic_year_id" class="form-control">
                                        <option value="">Select Academic Year</option>
                                        @foreach($academicYears as $year)
                                            <option value="{{ $year->id }}" {{ request()->academic_year_id == $year->id ? 'selected' : '' }}>
                                                {{ $year->year }} - Semester {{ $year->semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- Displaying Errors if Any -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Student Information -->
                        <div class="student-info mb-5">
                            <h5 class="text-primary">Student Information:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $student->user->first_name }} {{ $student->user->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $student->user->email }}</p>
                                    <p><strong>Student ID:</strong> {{ $student->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    @if ($task)
                                    <p><strong>Grade Level:</strong> {{ $task->classRoom->level->name }}</p>
                                    @else
                                    <p><strong>Grade Level:</strong> {{ $student->classRoom->level->name}}</p>
                                    @endif
                                    <p><strong>Grade Semester:</strong> {{ $selectedAcademicYear->semester }}</p>
                                    <p><strong>Year:</strong> {{ $selectedAcademicYear->year }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Displaying Task Results -->
                        <h5 class="text-success mb-3">Task Results:</h5>
                        @foreach($feedbacks as $feedback)
                            <div class="task-result mb-4 p-3 border rounded shadow-sm">
                                <h6 class="text-primary">Task Name: {{ $feedback->task->name }}</h6>
                                <p><strong>Year:</strong> {{ $feedback->task->academicYear->year }}</p>
                                <p><strong>Semester:</strong> {{ $feedback->task->academicYear->semester }}</p>
                                <p><strong>Grade:</strong>
                                    <span class="badge bg-success">{{ $feedback->grade }}</span>
                                    <span class="badge bg-info">Out of: {{ $feedback->task->max_grade }}</span>
                                </p>
                                <p><strong>Task Due Date:</strong>
                                    {{ $feedback->task->due_date ?? $feedback->created_at->format('Y-m-d') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
