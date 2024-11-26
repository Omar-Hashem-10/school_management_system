@extends('web.dashboard.master')

@section('title','Employees')

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
            <a href="{{ route('dashboard.admin.employees.create') }}" class="btn btn-sm btn-info float-left">Place New
              Employee</a>
          </div>
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table table-striped">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Image</th>
                  <th scope="col">Position</th>
                  <th scope="col">Salary</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employees as $employee )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $employee->name }}</td>
                  <td>{{ $employee->email }}</td>
                  <td>{{ $employee->phone }}</td>
                  <td>{{ $employee->gender }}</td>
                  <td>
                    <img src="{{FileHelper::get_file_path($employee->image?->path,'user')}}"  class="rounded-circle" width="100" height="100">
                  </td>
                  <td>{{ $employee->possition }}</td>
                  <td>{{ $employee->salary }}</td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.employees.edit',$employee->id)}}">Edit</a>
                    <div class="btn-group" role="group">
                      <form class="d-inline" action="{{route('dashboard.admin.employees.destroy',$employee->id)}}" method="post">
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