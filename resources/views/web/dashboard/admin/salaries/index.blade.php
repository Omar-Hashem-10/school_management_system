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
            <a href="{{ route('dashboard.admin.salaries.amounts',$date->id) }}"
              class="btn btn-sm btn-info float-left">All Amounts</a>
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
                  <th scope="col">Total Salary</th>
                  <th scope="col">Amounts</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($people as $type => $persons)
                @foreach($persons as $person)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  @if ($type=='Employee')
                  <td>{{ ($person->name) }}</td>
                  <td><span class="badge bg-primary">{{ $person->possition }}</span></td>
                  <td>{{ ($person)?$person->salary:0.00 }}</td>
                  <td>{{ $person->calculateMonthlySalary($date->id) }}</td>
                  @else
                  <td>{{ ($person->fullName()) }}</td>
                  @if($person->role['role_name']=='admin')
                  <td><span class="badge bg-danger">{{ $person->role['role_name'] }}</span></td>
                  <td>{{ ($person)?$person->admin->salary:0.00 }}</td>
                  <td>{{ $person->admin->calculateMonthlySalary($date->id) }}</td>
                  @elseif ($person->role['role_name']=='manager')
                  <td><span class="badge bg-warning">{{ $person->role['role_name'] }}</span></td>
                  <td>{{ ($person)?$person->admin->salary:0.00 }}</td>
                  <td>{{ $person->admin->calculateMonthlySalary($date->id) }}</td>
                  @elseif (($person->role['role_name']=='HR')||($person->role['role_name']=='academic affairs'))
                  <td><span class="badge bg-info">{{ $person->role['role_name'] }}</span></td>
                  <td>{{ ($person)?$person->admin->salary:0.00 }}</td>
                  <td>{{ $person->admin->calculateMonthlySalary($date->id) }}</td>
                  @elseif ($person->role['role_name']=='teacher')
                  <td><span class="badge bg-success">teacher</span></td>
                  <td>{{ ($person)?$person->teacher->salary:0.00 }}</td>
                  <td>{{ $person->teacher->calculateMonthlySalary($date->id) }}</td>
                  @endif
                  @endif
                  <td>{{ $person->amounts($date->id) }}</td>
                  <td>
                    <a class="btn btn-warning"
                      href="{{route('dashboard.admin.salaries.create',[$date->id,$person->id,$type])}}">add amount</a>
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
