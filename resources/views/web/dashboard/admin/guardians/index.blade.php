@extends('web.dashboard.master')
@section('parent','Users')

@section('title','Guardians')

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
            <a href="{{ route('dashboard.admin.guardians.create') }}" class="btn btn-sm btn-info float-left">Place New
              Guardian</a>
          </div>
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table table-striped">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Guardian Name</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Image</th>
                  <th scope="col">Relation</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($guardians as $guardian )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $guardian->user->fullName() }}</td>
                  <td>@if ($guardian->students)

                    @foreach ( $guardian->students as $student)
                    {{ $student->user->fullName() }}
                    @endforeach
                    @endif
                  </td>
                  <td>{{ $guardian->user->email }}</td>
                  <td>{{ $guardian->user->phone }}</td>
                  <td>
                    <img src="{{FileHelper::get_file_path($guardian->user->image?->path,'user')}}"
                      class="rounded-circle" width="100" height="100">
                  </td>
                  <td>@if ($guardian->students)
                    @foreach ( $guardian->students as $student)
                    {{ $student->relation }}
                    @endforeach
                    @endif
                  </td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.guardians.edit',$guardian->id)}}">Edit</a>
                    @canany('isAdmin','isManager')
                    <div class="btn-group" role="group">
                      <form class="d-inline" action="{{route('dashboard.admin.guardians.destroy',$guardian->user->id)}}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                    </div>
                    @endcanany
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
