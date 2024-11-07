@extends('web.dashboard.master')
@section('parent','components')

@section('title','Courses_levels')

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
              <a href="{{ route('dashboard.admin.course_levels.create') }}" class="btn btn-sm btn-info float-left">Create New course Level</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->

              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Level</th>
                        <th>Course Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        @foreach ($course->levels as $level)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $level->level_name }}</td>
                                <td>{{ $level->pivot->course_code }}</td>
                                <td>
                                    <!-- Edit button -->
                                    <a href="{{ route('dashboard.admin.course_levels.edit', ['course' => $course->id, 'level' => $level->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <!-- Delete button -->
                                    <form action="{{ route('dashboard.admin.course_levels.destroy', ['course' => $course->id, 'level' => $level->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
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
