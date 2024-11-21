@extends('web.dashboard.master')

@section('title','Schedule')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item ">Schedule</li>
        <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.schedules.index') }}">@yield('title')</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Schedule</h3>
    </div>
    <form action="{{ route('dashboard.admin.schedules.update', $schedule->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body">
        <!-- Hidden Classroom ID -->
        <input type="hidden" name="class_room_id" value="{{ session('class_room_id') }}">

        <!-- Course Selection -->
        <div class="form-group">
            <label for="course_id">Course Code</label>
            <select class="form-select form-control" name="course_id" id="course_id">
                <option disabled selected>Select Course</option>
                @foreach ($levels as $level)
                    @foreach ($level->subjects as $subject)
                        @php
                            $course = $courses->firstWhere('level_subject_id', $subject->pivot->id);
                        @endphp
                        @if ($course)
                            <option value="{{ $course->id }}" {{ old('course_id', $schedule->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->code }} - {{ $level->name }} - {{ $subject->name }}
                            </option>
                        @endif
                    @endforeach
                @endforeach
            </select>
            @error('course_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Day Selection -->
        <div class="form-group">
            <label for="day_id">Day</label>
            <select class="form-select form-control" name="day_id">
                <option value="">Select Day</option>
                @foreach ($days as $day)
                    <option value="{{ $day->id }}" {{ old('day_id', $schedule->day_id) == $day->id ? 'selected' : '' }}>{{ $day->day_name }}</option>
                @endforeach
            </select>
            @error('day_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Time Slot Selection -->
        <div class="form-group">
            <label for="time_slot_id">Time Slot</label>
            <select class="form-select form-control" name="time_slot_id">
              <option value="">Select Time Slot</option>
              @foreach ($time_slots as $time_slot)
                <option value="{{ $time_slot->id }}" {{ old('time_slot_id', $schedule->time_slot_id) == $time_slot->id ? 'selected' : '' }}>
                  {{ $time_slot->start_time }} - {{ $time_slot->end_time }} - {{ $time_slot->lecture_number }}
                </option>
              @endforeach
            </select>
            @error('time_slot_id')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</main>
@endsection
