@extends('web.dashboard.master')

@section('title', 'Create Attend')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.attends.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header">
              <h5>Create New Attend</h5>
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
              <!-- Form for attendance creation -->
              <form action="{{ route('dashboard.admin.attend_students.store') }}" method="POST">
                @csrf
                <input type="hidden" name="class_room_id" value="{{ session('class_room_id') }}">
                <input type="hidden" name="attendance_id" value="{{ session('attendance_id') }}">

                @foreach($students as $student)
                <div class="form-group mt-3">
                    <label for="status_{{ $student->id }}">Status for {{ $student->student_name }}</label>
                    <select name="status[{{ $student->id }}]" id="status_{{ $student->id }}" class="form-control">
                        <option value="">Select Status</option>
                        <option value="present" {{ old('status.' . $student->id) == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status.' . $student->id) == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="excused" {{ old('status.' . $student->id) == 'excused' ? 'selected' : '' }}>Excused</option>
                    </select>
                </div>
                @endforeach

                <button type="submit" class="btn btn-success mt-3">Create Attendance</button>
            </form>


            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
