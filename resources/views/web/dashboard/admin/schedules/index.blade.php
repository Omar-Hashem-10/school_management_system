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
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.schedules.create') }}" class="btn btn-sm btn-info float-left">Add New Schedule</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- Filter form -->
              <form action="{{ route('dashboard.admin.schedules.index') }}" method="GET" class="mb-3">
                <div class="row">
                  <div class="col-md-3">
                    <select class="form-select" name="day_filter">
                      <option value="">Select Day</option>
                      <option value="Sunday" {{ request('day_filter') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                      <option value="Monday" {{ request('day_filter') == 'Monday' ? 'selected' : '' }}>Monday</option>
                      <option value="Tuesday" {{ request('day_filter') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                      <option value="Wednesday" {{ request('day_filter') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                      <option value="Thursday" {{ request('day_filter') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
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
                    <th scope="col">Day</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($schedules as $schedule)
                    @foreach ($courses as $course)
                        @foreach ($course->levels as $level)
                            @if ($level->pivot->id == $schedule->course_level_id)
                                @if (request('day_filter') == '' || $schedule->day == request('day_filter'))
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $schedule->classRoom->class_name }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $schedule->day }}</td>
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
                  @endif
                  @endforeach
                  @endforeach
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
