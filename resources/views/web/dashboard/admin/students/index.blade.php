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
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.students.create') }}" class="btn btn-sm btn-info float-left">Place New student</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- Filter Form -->
              <form method="GET" action="{{ route('dashboard.admin.students.index') }}" class="mb-3">
                <div class="row">
                  <div class="col-md-4">
                    <input type="text" name="student_name" class="form-control" placeholder="Search by Name" value="{{ request()->student_name }}">
                  </div>
                  <div class="col-md-4">
                    <select name="class_room_id" class="form-control">
                      <option value="">Select Class</option>
                      {{-- @foreach($classRooms as $classRoom)
                        <option value="{{ $classRoom->id }}" {{ request()->class_room_id == $classRoom->id ? 'selected' : '' }}>{{ $classRoom->class_name }}</option>
                      @endforeach --}}
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                </div>
              </form>

              <!-- Sort by Form -->
              <form method="GET" action="{{ route('dashboard.admin.students.index') }}" class="mb-3">
                <div class="row">
                  <div class="col-md-4">
                    <select name="sort_by" class="form-control">
                      <option value="student_name" {{ request()->sort_by == 'student_name' ? 'selected' : '' }}>Sort by Name</option>
                      <option value="email" {{ request()->sort_by == 'email' ? 'selected' : '' }}>Sort by Email</option>
                      <option value="phone" {{ request()->sort_by == 'phone' ? 'selected' : '' }}>Sort by Phone</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select name="order" class="form-control">
                      <option value="asc" {{ request()->order == 'asc' ? 'selected' : '' }}>Ascending</option>
                      <option value="desc" {{ request()->order == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Sort</button>
                  </div>
                </div>
              </form>

              <!-- Table with stripped rows -->
              <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    {{-- <th scope="col">Class Name</th> --}}
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($students as $student )
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $student->student_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    {{-- <td>{{ $student->classRoom->class_name }}</td> --}}
                    <td>
                      <img src="{{ FileHelper::get_file_path($student->imageable, 'user') }}" class="rounded-circle" width="100" height="100">
                    </td>
                    <td>
                      <a class="btn btn-warning" href="{{ route('dashboard.admin.students.edit', $student->id) }}">Edit</a>
                      <div class="btn-group" role="group">
                        <form class="d-inline" action="{{ route('dashboard.admin.students.destroy', $student->id) }}" method="post">
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
              {{$students->links()}}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
