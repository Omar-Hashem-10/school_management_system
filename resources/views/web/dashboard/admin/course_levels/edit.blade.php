@extends('web.dashboard.master')

@section('title','Admins')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.home.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vertical Form</h5>

                <!-- Vertical Form -->
                <form action="{{ route('dashboard.admin.course_levels.update', ['course' => $course->id, 'level' => $level->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Course Selection -->
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select class="form-select" name="course_id" id="course_id">
                            <option value="">Select Course</option>
                            @foreach($courses as $courseItem)
                                <option value="{{ $courseItem->id }}" {{ $courseItem->id == $course->id ? 'selected' : '' }}>
                                    {{ $courseItem->course_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Level Selection -->
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Level</label>
                        <select class="form-select" name="level_id" id="level_id">
                            <option value="">Select Level</option>
                            @foreach($levels as $levelItem)
                                <option value="{{ $levelItem->id }}" {{ $levelItem->id == $level->id ? 'selected' : '' }}>
                                    {{ $levelItem->level_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Course Code -->
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="course_code" name="course_code" value="{{ $courseLevel->pivot->course_code }}">
                        @error('course_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
    </div>
</main>
@endsection
