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
                        <h3>Students Who Took Exams</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Grade</th>
                                    <th>Full Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                        <td>{{ $student->user->email }}</td>

                                        @php
                                            $grade = $student->grades->first()->grade;
                                            $half_grade = $student->grades->first()->exam->half_grade;
                                            $badge_class = 'badge bg-info';

                                            if ($grade < $half_grade) {
                                                $badge_class = 'badge bg-danger';
                                            } elseif ($grade == $half_grade) {
                                                $badge_class = 'badge bg-warning';
                                            } elseif ($grade > $half_grade) {
                                                $badge_class = 'badge bg-primary';
                                            }
                                        @endphp

                                        <td>
                                            <span class="{{ $badge_class }}">
                                                {{ $grade }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($half_grade)
                                                {{ $half_grade * 2 }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No students have taken exams yet.</td>
                                    </tr>
                                @endforelse
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
