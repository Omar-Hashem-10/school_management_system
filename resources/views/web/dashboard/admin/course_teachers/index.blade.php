@extends('web.dashboard.master')
@section('parent', 'Users')

@section('title', 'Teachers')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.course_teachers.create') }}" class="btn btn-sm btn-info float-left">Add Class For Teacher</a>
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
                    <th scope="col">Course Code</th>
                    <th scope="col">Class Room</th>
                    <th scope="col">Teacher Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year</th>
                    <th scope="col">Ceated at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($course_teachers as $course_teacher)
                        @foreach ($courses as $course)
                            @foreach ($course->levels as $level)
                                @if ($level->pivot->id == $course_teacher->course_level_id)
                                    <tr>
                                        <th scope="row">{{ $loop->parent->iteration }}</th>
                                        <td>{{ $level->pivot->course_code }}</td>
                                        <td>
                                            {{ $course_teacher->classRoom
                                                ? $course_teacher->classRoom->class_name . ' - ' . $course_teacher->classRoom->level->level_name
                                                : 'N/A'
                                            }}
                                        </td>
                                        <td>{{ $course_teacher->teacher ? $course_teacher->teacher->teacher_name : 'N/A' }}</td>
                                        <td>{{ $course_teacher->semester ? $course_teacher->semester : 'N/A' }}</td>
                                        <td>{{ $course_teacher->year ? $course_teacher->year : 'N/A' }}</td>
                                        <td>{{ $course_teacher->created_at ? $course_teacher->created_at : 'N/A' }}</td>
                                        <td>{{ $course_teacher->updated_at ? $course_teacher->updated_at : 'N/A' }}</td>
                                        <td>
                                          <a class="btn btn-warning" href="{{ route('dashboard.admin.course_teachers.edit', $course_teacher->id) }}">Edit</a>
                                          <form class="d-inline" action="{{ route('dashboard.admin.course_teachers.destroy', ['course_teacher' => $course_teacher->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                          </form>
                                          <a href="{{ route('dashboard.admin.teachers.index') }}" class="btn btn-secondary">Back</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
