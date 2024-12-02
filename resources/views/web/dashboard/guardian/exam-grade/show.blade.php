@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Exam Results')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Exam Results for {{ $student->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Exams</li>
                <li class="breadcrumb-item active">Results</li>
                <li class="breadcrumb-item active">{{ $student->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Exam Results for Student: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
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
                                    <p><strong>Student ID:</strong> {{ $student->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $student->user->email }}</p>
                                    <p><strong>Grade Level:</strong> {{ $student->classRoom->level->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Displaying Exam Results -->
                        <h5 class="text-success mb-3">Exam Results:</h5>
                        @foreach($grades as $grade)
                            <div class="exam-result mb-4 p-3 border rounded shadow-sm">
                                <h6 class="text-primary">Exam Name: {{ $grade->exam->name }}</h6>
                                <p><strong>Grade:</strong>
                                    <span class="badge bg-success">{{ $grade->grade }}</span>
                                    <span class="badge bg-info">Out of: {{ $grade->exam->half_grade * 2 }}</span>
                                </p>
                                <p><strong>Exam Date:</strong>
                                    {{ $grade->exam->exam_date ?? $grade->created_at->format('Y-m-d') }}
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
