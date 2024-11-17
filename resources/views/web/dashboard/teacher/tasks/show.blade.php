@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Students')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-transparent">
                    </div>
                    <div class="card-body">
                        <h3>Students Who Took Tasks</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Task Link</th>
                                    <th>Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $studentSend)
                                    <tr>
                                        <td>{{ $studentSend->student->id }}</td>
                                        <td>{{ $studentSend->student->student_name }}</td>
                                        <td>{{ $studentSend->student->email }}</td>
                                        <td>
                                            <a href="{{ $studentSend->task_link }}" target="_blank" class="btn btn-info btn-sm">View Task</a>
                                        </td>
                                        <td>
                                            @php
                                                $feedback = $feedbacks->firstWhere('student_id', $studentSend->student->id);
                                            @endphp

                                            @if($feedback)
                                            <a href="{{ route('dashboard.teacher.feedback.edit', $feedback->id) }}" class="btn btn-primary btn-sm">Edit Feedback</a>
                                            <a href="{{ route('dashboard.teacher.feedback.show', $feedback->id) }}" class="btn btn-success btn-sm">Show Feedback</a>
                                            @else
                                                <a href="{{ route('dashboard.teacher.feedback.create', ['student_id' => $studentSend->student->id, 'task_id' => $studentSend->task_id]) }}" class="btn btn-warning btn-sm">Give Feedback</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if($students->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No students have taken tasks yet.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
