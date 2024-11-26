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
              <h3 class="card-title">Weekly Class Schedule</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Name</th>
                            <th>Start Exam</th>
                            <th>Exam End</th>
                            <th>Duration</th>
                            <th>Exam Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exams as $exam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->start_date }}</td>
                                <td>{{ $exam->end_date }}</td>
                                <td>{{ $exam->exam_duration }} minutes</td>
                                <td>{{ $exam->half_grade * 2 }}</td>
                                <td>
                                    @if(\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($exam->start_date), \Carbon\Carbon::parse($exam->end_date)) || \Carbon\Carbon::now()->gte(\Carbon\Carbon::parse($exam->end_date)))
                                        @if(in_array($exam->id, $exam_ids))
                                            @php
                                                $grade = $exam->grades->first() ? $exam->grades->first()->grade : null;
                                            @endphp
                                            <a href="{{ route('dashboard.student.answer.show', $exam->id) }}" class="btn btn-success btn-sm">
                                                View Answer
                                            </a>
                                            @if($grade !== null)
                                                @php
                                                    $half_grade = $exam->half_grade;
                                                    $grade_class = 'bg-info';
                                                    if ($grade < $half_grade) {
                                                        $grade_class = 'bg-danger';
                                                    } elseif ($grade == $half_grade) {
                                                        $grade_class = 'bg-warning';
                                                    }
                                                @endphp
                                                <span class="badge {{ $grade_class }} text-dark">Grade: {{ $grade }}</span>
                                            @endif
                                        @else
                                            <a href="{{ route('dashboard.student.exam.show', $exam->id) }}" class="btn btn-primary btn-sm">Start Exam</a>
                                        @endif
                                    @elseif(\Carbon\Carbon::now()->gte(\Carbon\Carbon::parse($exam->end_date)))
                                        <span class="text-muted">You have missed the exam</span>
                                    @elseif(\Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($exam->start_date)))
                                        <span class="text-muted">Not available yet</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No exams available for this course.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
@endsection
