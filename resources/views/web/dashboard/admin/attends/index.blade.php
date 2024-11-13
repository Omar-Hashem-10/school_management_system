@extends('web.dashboard.master')

@section('title', 'Attends')

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
                <a href="{{ route('dashboard.admin.attends.create') }}" class="btn btn-sm btn-info float-left">Place New Attend</a>
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
                    <th scope="col">Date</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($attendances as $attendance)
                    <tr>
                      <th scope="row">{{ $attendance->id }}</th>
                      <td>{{ $attendance->attendance_date }}</td>
                      <td>{{ $attendance->classRoom->class_name }}</td>
                      <td>
                        <a href="{{ route('dashboard.admin.attends.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('dashboard.admin.attends.show', $attendance->id) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('dashboard.admin.attends.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
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
