@extends('web.dashboard.master')
@section('title', 'Student Details')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Student Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.students.index', ['class_room_id' => session('class_room_id')]) }}">Students</a></li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $student->user->first_name }} {{ $student->user->last_name }}</h3>
                <p>Email: {{ $student->user->email }}</p>
                <p>Phone: {{ $student->user->phone }}</p>
                <p>Class: {{ $student->classRoom->name }}</p>
            </div>
            <div class="card-body">
                <h4>Grades</h4>
                @if ($grades->isEmpty())
                    <p class="text-center text-muted">No Data available.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Course Code</th>
                                <th>Exam Name</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                            <tr>
                                <td>{{ auth()->user()->teacher->subject->name }}</td>
                                <td>{{ $grade->exam->courseCode->code }}</td>
                                <td>{{ $grade->exam->name }}</td>
                                <td>{{ $grade->grade }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $grades->links() }}
                    </div>
                @endif

                {{--
                <h4>Attendance</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024/10/11</td>
                            <td>Present</td>
                        </tr>
                    </tbody>
                </table>
                --}}
            </div>
        </div>
    </div>
</main>
@endsection
