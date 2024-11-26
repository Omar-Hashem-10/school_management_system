@extends('web.dashboard.master')
@section('parent','Users')

@section('title','Students')

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
              <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Day</th>
                        @foreach ($time_slots as $time_slot)
                            <th>{{ $time_slot->lecture_number }} <br> ({{ $time_slot->start_time }}) - ({{ $time_slot->end_time }})</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($days as $day)
                    <tr>
                        <th>{{ $day->day_name }}</th>
                        @foreach ($time_slots as $time_slot)
                            <td>
                                @php
                                    $matching_schedule = $schedules->firstWhere(function ($schedule) use ($day, $time_slot) {
                                        return $schedule->day == $day && $schedule->time_slot_id == $time_slot->id;
                                    });
                                @endphp
                                @if ($matching_schedule)
                                @foreach ($course_codes_schedules as $course_code)
                                    @foreach ($levels as $level)
                                        @foreach ($level->subjects as $subject)
                                                @if ($course_code->id == $matching_schedule->course_code_id && $course_code->level_subject_id == $subject->pivot->id)
                                                    {{ $subject->name }} <br>
                                                    {{ $course_code->code }}
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @else
                                    <span>No class</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
@endsection
