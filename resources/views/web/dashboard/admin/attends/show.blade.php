@extends('web.dashboard.master')

@section('title', 'Attendance Details')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Attendance Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.attends.index') }}">Attends</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent">
                <a href="{{ route('dashboard.admin.attends.index') }}" class="btn btn-sm btn-primary">Back to Attendances</a>
                <div class="btn-group float-end" role="group" aria-label="Attendance Filter">
                    <a href="{{ route('dashboard.admin.attends.show', [$attendance->id]) }}" class="btn btn-outline-primary {{ $status == null ? 'active' : '' }}">All</a>
                    <a href="{{ route('dashboard.admin.attends.show', [$attendance->id, 'present']) }}" class="btn btn-outline-success {{ $status == 'present' ? 'active' : '' }}">Present</a>
                    <a href="{{ route('dashboard.admin.attends.show', [$attendance->id, 'absent']) }}" class="btn btn-outline-danger {{ $status == 'absent' ? 'active' : '' }}">Absent</a>
                    <a href="{{ route('dashboard.admin.attends.show', [$attendance->id, 'excused']) }}" class="btn btn-outline-warning {{ $status == 'excused' ? 'active' : '' }}">Excused</a>
                </div>
            </div>
            <div class="card-body">

              <h4>Students {{ ucfirst($status) ?? 'Attendance' }}:</h4>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Attendance Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($attendances as $attendance)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $attendance->student->student_name }}</td>
                      <td>{{ ucfirst($attendance->status) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
