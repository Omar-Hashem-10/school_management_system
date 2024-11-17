@extends('web.dashboard.master')
@section('parent','Components')

@section('title','Time Slots')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Components</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.time_slots.create') }}" class="btn btn-sm btn-info float-left">Add New Time Slot</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Lecture Number</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($time_slots as $time_slot)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $time_slot->lecture_number }}</td>
                    <td>{{ $time_slot->start_time }}</td>
                    <td>{{ $time_slot->end_time }}</td>
                    <td>
                      <a class="btn btn-warning" href="{{ route('dashboard.admin.time_slots.edit', $time_slot->id) }}">Edit</a>
                      <div class="btn-group" role="group">
                        <form class="d-inline" action="{{ route('dashboard.admin.time_slots.destroy', $time_slot->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
