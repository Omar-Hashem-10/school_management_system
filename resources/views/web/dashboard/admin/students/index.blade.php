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
            <a href="{{ route('dashboard.admin.students.create') }}" class="btn btn-sm btn-info float-left">Place New
              student</a>
          </div>
          <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('dashboard.admin.students.index') }}" class="mb-3">
              <div class="row">
                <div class="col-md-4">
                  <input type="text" name="name" class="form-control" placeholder="Search by Name"
                    value="{{ request()->name }}">
                </div>
                <div class="col-md-4">
                  <select name="class_room_id" class="form-control">
                    <option value="">Select Class</option>
                    @foreach($class_rooms as $class_room)
                    <option value="{{ $class_room->id }}" {{ request()->class_room_id == $class_room->id ? 'selected' :
                      '' }}>{{ $class_room->name }}</option>
                    @endforeach
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
                    <option value="name" {{ request()->sort_by == 'name' ? 'selected' : '' }}>Sort by Name</option>
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
                  <th scope="col">Class Name</th>
                  <th scope="col">Status</th>
                  <th scope="col">Image</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $student->fullName() }}</td>
                  <td>{{ $student->email }}</td>
                  <td>{{ $student->phone }}</td>
                  <td>{{ ($student->student)?$student->student->classRoom['name']:null}}</td>
                  @if ($student->student->graduate)
                        <td>Graduate</td>
                    @else
                        <td>Student</td>
                    @endif

                  <td>
                    <img src="{{ FileHelper::get_file_path($student->image?->path, 'user') }}" class="rounded-circle"
                      width="100" height="100">
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.task-grade.show',  ($student->student)?$student->student->id:$student->id) }}">Show Task Grade</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.exam-grade.show',  ($student->student)?$student->student->id:$student->id) }}">Show Exam Grade</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.attendance.show',  ($student->student)?$student->student->id:$student->id) }}">Show Attendance</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.certificates.index', ['student_id' =>  ($student->student)?$student->student->id:$student->id]) }}">Certificate</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.students.edit', ($student->student)?$student->student->id:$student->id) }}">Edit</a></li>
                        @canany('isAdmin', 'isManager')
                        <li>
                          <form class="dropdown-item" action="{{ route('dashboard.admin.students.destroy', ($student->student)?$student->student->id:$student->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="dropdown-item" type="submit">Delete</button>
                          </form>
                        </li>
                        @endcanany
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin.students.sendMailForm', $student->id) }}">Send Mail</a></li>
                      </ul>
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
