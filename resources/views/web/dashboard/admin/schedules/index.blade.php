@extends('web.dashboard.master')

@section('parent','Schedule')

@section('title','Class Schedule')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Schedule</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent d-flex">
                <a href="{{ route('dashboard.admin.schedules.create') }}" class="btn btn-sm btn-info me-2">Add New Schedule</a>
                <form action="{{ route('dashboard.admin.schedules.deleteAll') }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete All Schedules</button>
                </form>
            </div>

            <div class="card-body">
              <!-- Filter form -->
              <form action="{{ route('dashboard.admin.schedules.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <select class="form-select" name="day_filter">
                            <option value="">Select Day</option>
                            @foreach ($days as $day)
                                <option value="{{ $day->id }}" {{ request('day_filter') == $day->day_name ? 'selected' : '' }}>
                                    {{ $day->day_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                </div>
              </form>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Classroom</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Day</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($schedules as $schedule)
                                @if (request('day_filter') == '' || $schedule->day_id == request('day_filter'))
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $schedule->classRoom->name }}</td>
                        <td>{{ $schedule->courseCode->code }}</td>
                        <td>{{ $schedule->courseCode->semester }}</td>
                        <td>{{ $schedule->day->day_name }}</td>
                        <td>{{ $schedule->timeSlot->start_time }}</td>
                        <td>{{ $schedule->timeSlot->end_time }}</td>
                        <td>
                        <a class="btn btn-warning" href="{{ route('dashboard.admin.schedules.edit', $schedule->id) }}">Edit</a>
                        <div class="btn-group" role="group">
                            <form class="d-inline" action="{{ route('dashboard.admin.schedules.destroy', $schedule->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                        </td>
                  </tr>
                  @endif
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
