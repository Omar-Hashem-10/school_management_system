@extends('web.dashboard.master')

@section('title','Edit Course Teachers')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item ">Users</li>
        <li class="breadcrumb-item "><a href="#">@yield('title')</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Course Teacher</h3>
    </div>
    <form action="{{route('dashboard.admin.course_teachers.update', ['course_teacher' => $course_teacher->id])}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body">

        <!-- Teacher Selection (fixed to current teacher_id) -->
        <input type="hidden" name="teacher_id" value="{{ $course_teacher->teacher_id }}">

        <!-- Course Level Selection -->
        <div class="form-group">
          <label for="course_level_id">Course Code</label>
          <select class="form-select form-control" name="course_level_id" id="course_level_id">
            <option disabled>Select Course</option>
            @foreach ($courses as $course)
              @if ($course->id == session('course_id'))
                @foreach ($course->levels as $level)
                  <option value="{{ $level->pivot->id }}" {{ $level->pivot->id == $course_teacher->course_level_id ? 'selected' : '' }}>
                    {{ $course->course_name }} - {{ $level->level_name }} - {{ $level->pivot->course_code }}
                  </option>
                @endforeach
              @endif
            @endforeach
          </select>
          @error('course_level_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- Class Room Selection -->
        <div class="form-group">
          <label for="class_room_id">Class Room</label>
          <select class="form-select form-control" name="class_room_id" id="class_room_id">
            <option disabled>Select Class Room</option>
            @foreach ($class_rooms as $class_room)
              <option value="{{ $class_room->id }}" {{ $class_room->id == $course_teacher->class_room_id ? 'selected' : '' }}>
                {{ $class_room->class_name }} - {{ $class_room->level->level_name }}
              </option>
            @endforeach
          </select>
          @error('class_room_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- Semester Selection -->
        <div class="form-group">
          <label for="semester">Semester</label>
          <select class="form-select form-control" name="semester" id="semester">
            <option disabled>Select Semester</option>
            <option value="first" {{ $course_teacher->semester == 'first' ? 'selected' : '' }}>First Semester</option>
            <option value="second" {{ $course_teacher->semester == 'second' ? 'selected' : '' }}>Second Semester</option>
          </select>
          @error('semester')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- Year Selection -->
        <div class="form-group">
          <label for="year">Year</label>
          <input type="date" name="year" class="form-control" id="year" value="{{ $course_teacher->year }}">
          @error('year')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dashboard.admin.course_teachers.index', ['teacher_id' => session('teacher_id')]) }}" class="btn btn-secondary">Back</a>
      </div>

    </form>
  </div>
</main>
@endsection
