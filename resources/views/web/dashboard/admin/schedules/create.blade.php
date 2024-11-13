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
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Schedule </h3>
    </div>
    <form action="{{ route('dashboard.admin.schedules.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <!-- Hidden Classroom ID -->
        <input type="hidden" name="class_room_id" value="{{ session('class_room_id') }}">

        <div class="form-group">
            <label for="course_level_id">Course Code</label>
            <select class="form-select form-control" name="course_level_id" id="course_level_id">
                <option disabled selected>Select Course</option>
                @foreach ($courses as $course)
                    @foreach ($course->levels as $level)
                        @if ( $level->id == session('class_room_level'))
                            <option value="{{ $level->pivot->id }}">
                                {{ $course->course_name }} - {{ $level->level_name }} - {{ $level->pivot->course_code }}
                            </option>
                        @endif
                    @endforeach
                @endforeach
            </select>
            @error('course_level_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>



        <!-- Day Selection -->
        <div class="form-group">
          <label for="day">Day</label>
          <select class="form-select form-control" aria-label="Day Select" name="day" value="{{ old('day') }}">
            <option value="">Select Day</option>
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
          </select>
          @error('day')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="time_slot_id">Time Slot</label>
            <select class="form-select form-control" name="time_slot_id" id="time_slot_id" value="{{ old('time_slot_id') }}">
              <option value="">Select Time Slot</option>
              @foreach ($time_slots as $time_slot)
                <option value="{{ $time_slot->id }}" {{ old('time_slot_id') == $time_slot ? 'selected' : '' }}>
                  {{ $time_slot->start_time }} - {{ $time_slot->end_time }} - {{ $time_slot->lecture_number }}
                </option>
              @endforeach
            </select>
            @error('time_slot_id')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>


      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </form>
  </div>
</main>
@endsection
