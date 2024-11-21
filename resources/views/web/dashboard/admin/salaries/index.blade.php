@extends('web.dashboard.master')

@section('title','Salaries')

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
            <a href="{{ route('dashboard.admin.salaries.amounts',$date->id) }}" class="btn btn-sm btn-info float-left">All Amounts</a>
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
                  <th scope="col">Position</th>
                  <th scope="col">Base Salary</th>
                  <th scope="col">Amounts</th>
                  <th scope="col">Total Salary</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($people as $type => $persons)
                @foreach($persons as $person)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  @if($person->role['role_name']=='admin')
                  <td>{{ ($person->admin_name) }}</td>
                  <td><span class="badge bg-danger">{{ $person->role['role_name'] }}</span></td>
                  @elseif ($person->role['role_name']=='manager')
                  <td>{{ $person->admin_name }}</td>
                  <td><span class="badge bg-warning">{{ $person->role['role_name'] }}</span></td>
                  @elseif ($person->role['role_name']=='teacher')
                  <td>{{ $person->teacher_name }}</td>
                  <td><span class="badge bg-success">teacher</span></td>
                  @else
                  <td>{{ $person->employee_name }}</td>
                  <td><span class="badge bg-primary">{{ $person->role['role_name'] }}</span></td>
                  @endif
                  <td>{{ $person->role->base_salary }}</td>
                  <td>{{ $person->amounts($date->month, $date->year) }}</td>
                  <td>{{ $person->calculateMonthlySalary($date->month, $date->year) }}</td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.salaries.create',[$date->id,$person->id])}}">add amount</a>
                  </td>
                </tr>
                @endforeach
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