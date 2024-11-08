@extends('web.dashboard.master')

@section('title','Teachers')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item ">Users</li>
        <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.teachers.index') }}">@yield('title')</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Teacher</h3>
    </div>
    <form action="{{ route('dashboard.admin.course_teachers.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">

        <!-- Existing Course Selection -->
        <div class="form-group">
            <label for="course_level_id">Course Code</label>
            <select class="form-select form-control" name="course_level_id" id="course_level_id">
              <option disabled selected>Select Course</option>
              @foreach ($courses as $course)
                @foreach ($course->levels as $level)
                  @if ($course->id == session('course_id'))
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

        <!-- Existing Class Room Selection -->
        <div class="form-group">
          <label for="class_room_id">Class Room</label>
          <select class="form-select form-control" name="class_room_id" id="class_room_id" value="{{ old('class_room_id') }}">
            <option disabled selected>Select Class Room</option>
            @foreach ($class_rooms as $class_room)
              <option value="{{ $class_room->id }}">{{ $class_room->class_name }} - {{$class_room->level->level_name}}</option>
            @endforeach
          </select>
          @error('class_room_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- New Semester Selection -->
        <div class="form-group">
          <label for="semester">Semester</label>
          <select class="form-select form-control" name="semester" id="semester" value="{{ old('semester') }}">
            <option disabled selected>Select Semester</option>
            <option value="first">First Semester</option>
            <option value="second">Second Semester</option>
          </select>
          @error('semester')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <!-- New Year Selection -->
        <div class="form-group">
            <label for="year">Year</label>
            <input type="date" name="year" class="form-control" id="year" placeholder="Enter Year"
                   value="{{ old('year') }}">
            @error('year')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>


        <!-- New Teacher ID (hidden input or select option based on the application) -->
        <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">

      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dashboard.admin.course_teachers.index', ['teacher_id' => session('teacher_id')]) }}" class="btn btn-secondary">Back</a>
    </div>


    </form>
  </div>
</main>
@endsection
