@extends('web.dashboard.master')
@section('parent','Users')
@section('title','Roles')

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
              <a href="{{ route('dashboard.admin.roles.create') }}" class="btn btn-sm btn-info float-left">Place New role</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">
  
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">For</th>
                    <th scope="col">Base Salary</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role )
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $role->role_name }}</td>
                    <td>{{ $role->for }}</td>
                    <td>{{ $role->base_salary }}</td>
                    <td>
                      <a class="btn btn-warning" href="{{route('dashboard.admin.roles.edit',$role->id)}}">Edit</a>
                      <div class="btn-group" role="group">
                        <form class="d-inline" action="{{route('dashboard.admin.roles.destroy',$role->id)}}" method="post">
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
