@extends('web.dashboard.master')

@section('title', 'Edit Attend')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.attends.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header">
              <h5>Edit Attendance</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <!-- Form for editing attendance -->
              <form action="{{ route('dashboard.admin.attends.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="class_room_id" value="{{ $attendance->class_room_id }}">

                <div class="form-group">
                  <label for="attendance_date">Attendance Date</label>
                  <input type="date" id="attendance_date" name="attendance_date" class="form-control" value="{{ old('attendance_date', $attendance->attendance_date) }}">
                  @error('attendance_date')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-success mt-3">Update Attendance</button>

                <a href="{{ route('dashboard.admin.attend_students.edit', $attendance->id) }}" class="btn btn-primary mt-3 ml-2">Edit Students</a>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
