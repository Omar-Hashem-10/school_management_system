@extends('web.dashboard.master')

@section('title', 'Teachers')

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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('dashboard.admin.course_teachers.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">

        <div class="form-group">
            <label for="course_code_id">Course Code</label>
            <select class="form-select form-control" name="course_code_id" id="course_code_id">
                <option disabled selected>Select Course</option>

                @foreach ($course_codes as $course)
                    @foreach ($levels as $level)
                        @foreach ($level->subjects as $subject)
                            @if ($course->level_subject_id == $subject->pivot->id && $subject->id == session('subject_id'))
                                <option value="{{ $course->id }}">
                                    {{ $course->code }} - {{ $level->name }} - {{ $subject->name }}
                                </option>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </select>

            @error('course_code_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Class Room Selection -->
        <div class="form-group">
          <label for="class_room_id">Class Room</label>
          <select class="form-select form-control" name="class_room_id" id="class_room_id" value="{{ old('class_room_id') }}">
            <option disabled selected>Select Class Room</option>
            @foreach ($class_rooms as $class_room)
              <option value="{{ $class_room->id }}">{{ $class_room->name }} - {{$class_room->level->name}}</option>
            @endforeach
          </select>
          @error('class_room_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

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
