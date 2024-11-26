@extends('web.dashboard.master')
@section('parent','Users')

@section('title','Students')

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
            <div class="card-header">
                <form method="GET" action="{{ route('dashboard.teacher.students.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request()->query('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

            </div>
            <div class="card-body">

                <!-- Table with students -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $student->user->first_name }} {{$student->user->last_name}}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>{{ $student->user->phone }}</td>
                            <td>{{ $student->classRoom->name }}</td>
                            <td>
                                <img src="{{ FileHelper::get_file_path($student->image, 'user') }}" class="rounded-circle" width="100" height="100">
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('dashboard.teacher.students.show', $student->id) }}">Show</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links() }}

            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
