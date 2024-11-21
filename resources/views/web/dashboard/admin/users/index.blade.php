@extends('web.dashboard.master')

@section('title','Users')

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
            <a href="{{ route('dashboard.admin.users.create') }}" class="btn btn-sm btn-info float-left">Place New
              admin</a>
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
                  <th scope="col">Image</th>
                  <th scope="col">Position</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $user->fullName() }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>
                    <img src="{{FileHelper::get_file_path($user->imageable,'user')}}" class="rounded-circle" width="100"
                      height="100">
                  </td>
                  @if ($user->role->role_name =='admin')
                  <?php $badge='bg-danger'?>
                  @elseif($user->role->role_name=='manager')
                  <?php $badge='bg-warning'?>
                  @elseif($user->role->role_name=='teacher')
                  <?php $badge='bg-success'?>
                  @elseif($user->role->role_name=='student')
                  <?php $badge='bg-primary'?>
                  @endif
                  <td><span class="badge {{$badge}}">{{$user->role->role_name}}</span></td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.users.edit',$user->id)}}">Edit</a>
                    <div class="btn-group" role="group">
                      <form class="d-inline" action="{{route('dashboard.admin.users.destroy',$user->id)}}"
                        method="post">
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
        <div class="container mt-4">
          <div class="row">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection