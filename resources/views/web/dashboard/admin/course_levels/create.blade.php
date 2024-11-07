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
                <li class="breadcrumb-item active">Create</li>
            </ol>
            </nav>

            <div class="col-lg-6 ms-auto me-auto">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Form</h5>

                    <!-- Vertical Form -->
                    <form action="{{route('dashboard.admin.course_levels.store')}}" method="POST" class="row g-3">
                        @csrf
                    <div class="col-12">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" class="form-control" name="course_code" id="course_code">
                        @error('course_code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                        <div class="col-12">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" name="course_id" id="course_id">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="level_id" class="form-label">Level</label>
                            <select class="form-select" name="level_id" id="level_id">
                            <option value="">Select Level</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                            @endforeach
                            </select>
                            @error('level_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form><!-- Vertical Form -->

                </div>
                </div>

        </div>
    </main>
    @endsection
