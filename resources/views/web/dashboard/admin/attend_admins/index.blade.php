@extends('web.dashboard.master')

@section('title','Attends')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.admin.attend_admins.show') }}">Dates</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
      </ol>
    </nav>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header border-transparent">
           <h3>Attendance Admins For {{ $date->day." - ".$date->month." - ".$date->year }}</h3>
          </div>
          <div class="card-body">

            <table class="table table-striped">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Possition</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $admin->user->fullName() }}</td>
                  <td>{{ $admin->role->role_name }}</td>
                  <td>
                    @php
                    $todayAttendance = \App\Models\Attend::where('date_id',$date->id)->where('attendable_type','User')->where('attendable_id',$admin->user_id)->first();
                    @endphp
                    {{ $todayAttendance ? ($todayAttendance->status ) : 'No Record' }}</td>
                  <td>
                    <a class="btn btn-success"
                      href="{{ route('dashboard.admin.attends.store', [$date->id,($admin->user)?$admin->user->id:0,'User','present']) }}">Present</a>
                    <a class="btn btn-warning"
                      href="{{ route('dashboard.admin.attends.store', [$date->id,($admin->user)?$admin->user->id:0,'User','absent']) }}">Absent</a>
                    <a class="btn btn-danger"
                      href="{{ route('dashboard.admin.attends.store', [$date->id,($admin->user)?$admin->user->id:0,'User','excused']) }}">Excused</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
            {{$admins->links()}}
          </div>
        </div>

      </div>
    </div>
  </div>
</main>
@endsection