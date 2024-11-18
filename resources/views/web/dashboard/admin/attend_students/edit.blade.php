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
              <form action="{{ route('dashboard.admin.attend_students.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="class_room_id" value="{{ $attendance->class_room_id }}">
                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">

                @foreach($attendance_students as $attendance_student)
                <div class="form-group mt-3">
                    <label for="status_{{ $attendance_student->student_id }}">Status for {{ $attendance_student->student->student_name }}</label>
                    <select name="status[{{ $attendance_student->student_id }}]" id="status_{{ $attendance_student->student_id }}" class="form-control">
                        <option value="">Select Status</option>
                        <option value="present" {{ (old('status.' . $attendance_student->student_id, $attendance_student->status ?? '') == 'present') ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ (old('status.' . $attendance_student->student_id, $attendance_student->status ?? '') == 'absent') ? 'selected' : '' }}>Absent</option>
                        <option value="excused" {{ (old('status.' . $attendance_student->student_id, $attendance_student->status ?? '') == 'excused') ? 'selected' : '' }}>Excused</option>
                    </select>
                </div>
                @endforeach


                <button type="submit" class="btn btn-success mt-3">Update Attendance</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
