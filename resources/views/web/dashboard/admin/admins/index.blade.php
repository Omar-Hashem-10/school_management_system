@extends('web.dashboard.master')

@section('title','Admins')

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
            <a href="{{ route('dashboard.admin.admins.create') }}" class="btn btn-sm btn-info float-left">Place New
              admin</a>
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
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Image</th>
                  <th scope="col">Position</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $admin->admin_name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->phone }}</td>
                  <td>
                    <img src="{{FileHelper::get_file_path($admin->imageable,'user')}}"  class="rounded-circle" width="100" height="100">
                  </td>
                  @if ($admin->role->role_name =='admin')
                  <?php $badge='bg-danger'?>
                  @elseif($admin->role->role_name=='manager')
                  <?php $badge='bg-warning'?>
                  @endif
                  <td><span class="badge {{$badge}}">{{$admin->role->role_name}}</span></td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.admins.edit',$admin->id)}}">Edit</a>
                    <div class="btn-group" role="group">
                      <form class="d-inline" action="{{route('dashboard.admin.admins.destroy',$admin->id)}}" method="post">
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