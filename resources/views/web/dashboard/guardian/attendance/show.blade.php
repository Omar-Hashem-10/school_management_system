@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Attendance Records')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Attendance Records for {{ $student->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Attendance</li>
                <li class="breadcrumb-item active">{{ $student->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Attendance Records for Student: {{ $student->name }}</h3>
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

                        <!-- Displaying Attendance Records -->
                        <h5 class="text-success mb-3">Attendance Records:</h5>
                        @if($attendanceRecords->isEmpty())
                            <div class="alert alert-info">
                                <p>No attendance records found for this student.</p>
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendanceRecords as $record)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $record->date->day }} - {{ $record->date->month }} - {{ $record->date->year }}</td>
                                            <td>
                                                <span class="badge
                                                    {{ $record->status == 'present' ? 'bg-success' :
                                                        ($record->status == 'absent' ? 'bg-danger' :
                                                        ($record->status == 'excused' ? 'bg-warning' : '')) }}">
                                                    {{ $record->status }}
                                                </span>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
