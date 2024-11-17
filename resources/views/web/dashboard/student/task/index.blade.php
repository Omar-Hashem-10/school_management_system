@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Tasks')

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
              <h3 class="card-title">Weekly Tasks Schedule</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Full Grade</th>
                            <th>Actions</th>
                            <th>Your Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->start_date)->format('d M Y, h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d M Y, h:i A') }}</td>
                            <td>{{ $task->full_grade }}</td>
                            <td>
                                @if(\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($task->start_date), \Carbon\Carbon::parse($task->end_date)))
                                    <a href="{{ route('dashboard.student.task.create', ['taskId' => $task->id]) }}" class="btn btn-primary btn-sm">Submit Task</a>
                                @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($task->end_date)))
                                    @if(!in_array($task->id, $task_ids))
                                        <span class="text-danger">You missed submitting this task.</span>
                                    @endif
                                @else
                                    <span class="text-muted">Not available yet</span>
                                @endif

                                @if(array_key_exists($task->id, $taskLinks))
                                    <a href="{{ $taskLinks[$task->id] }}" class="btn btn-success btn-sm">
                                        View Submission
                                    </a>
                                @endif

                                @php
                                    $taskFeedback = $feedbacks->where('task_id', $task->id)->first();
                                @endphp

                                @if($taskFeedback)
                                    <a href="{{ route('dashboard.student.feedback', $taskFeedback->id) }}" class="btn btn-primary btn-sm">
                                        View Feedback
                                    </a>
                                @else
                                    @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($task->end_date)))
                                        <span class="text-muted">No feedback yet</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($taskFeedback)
                                    <span class="badge bg-info">Grade: {{ $taskFeedback->task_grade }}</span>
                                @else
                                    <span class="badge bg-secondary">Grade not available</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach

                        @forelse($tasks as $task)
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No tasks available for this course.</td>
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
