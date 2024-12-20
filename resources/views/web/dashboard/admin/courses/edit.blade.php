@extends('web.dashboard.master')

@section('title','Courses')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Components</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.courses.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Vertical Form</h5>

                <!-- Vertical Form -->
                <form action="{{route('dashboard.admin.courses.update', $course->id)}}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                  <div class="col-12">
                    <label for="course_name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="course_name" value="{{old('course_name', $course->course_name)}}">
                    @error('course_name')
                        <span class="text-danger">{{$message}}</span>
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
