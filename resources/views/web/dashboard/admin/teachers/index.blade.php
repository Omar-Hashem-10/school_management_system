@extends('web.dashboard.master')
@section('parent','Users')

@section('title','Teachers')

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
              <a href="{{ route('dashboard.admin.teachers.create') }}" class="btn btn-sm btn-info float-left">Place New teacher</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Image</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teachers as $teacher )
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $teacher->user->fullName() }}</td>
                    <td>{{ $teacher->user->email }}</td>
                    <td>{{ $teacher->user->phone }}</td>
                    <td>
                      <img src="{{FileHelper::get_file_path($teacher->user->image?->path,'user')}}"  class="rounded-circle" width="100" height="100">
                    </td>
                    <td>{{ $teacher->salary }}</td>
                    <td>{{ $teacher->subject->name }}</td>
                    <td>
                      <a class="btn btn-warning" href="{{route('dashboard.admin.teachers.edit',$teacher->id)}}">Edit</a>
                      @can('isAdmin')
                      <div class="btn-group" role="group">
                        <form class="d-inline" action="{{route('dashboard.admin.teachers.destroy',$teacher->user->id)}}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </div>
                      @endcan
                      <a class="btn btn-success" href="{{route('dashboard.admin.course_teachers.index',['teacher_id' => $teacher->id])}}">info</a>
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
