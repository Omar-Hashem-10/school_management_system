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
              <a href="{{ route('dashboard.admin.level_subjects.create') }}" class="btn btn-sm btn-info float-left">Create New course Level</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->

              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                    @foreach ($subject->levels as $level)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $level->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.admin.level_subjects.edit', ['subject' => $subject->id, 'level' => $level->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('dashboard.admin.level_subjects.destroy', ['subject' => $subject->id, 'level' => $level->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
