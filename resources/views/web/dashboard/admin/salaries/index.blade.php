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
            <a href="{{ route('dashboard.admin.salaries.create') }}" class="btn btn-sm btn-info float-left">Place New
              Salary</a>
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
                  <th scope="col">Bonus</th>
                  <th scope="col">Deduction</th>
                  <th scope="col">Total</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($salaries as $salary )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  @if($salary->person->role->role_name=='admin')
                  <td>{{ ($salary->person->admin_name) }}</td>
                  <td><span class="badge bg-danger">{{ $salary->person->role->role_name }}</span></td>
                  @elseif ($salary->person->role->role_name=='manager')
                  <td>{{ $salary->person->admin_name }}</td>
                  <td><span class="badge bg-warning">{{ $salary->person->role->role_name }}</span></td>
                  @elseif ($salary->person->role->role_name=='teacher')
                  <td>{{ $salary->person->teacher_name }}</td>
                  <td><span class="badge bg-success">teacher</span></td>
                  @else
                  <td>{{ $salary->person->employee_name }}</td>
                  <td><span class="badge bg-primary">{{ $salary->person->role->role_name }}</span></td>
                  @endif
                  <td>{{ $salary->base_salary }}</td>
                  <td>{{ $salary->bonus }}</td>
                  <td>{{ $salary->deduction }}</td>
                  <td>{{ $salary->total_salary }}</td>
                  <td>
                    <a class="btn btn-warning" href="{{route('dashboard.admin.salaries.edit',$salary->id)}}">Edit</a>
                    <div class="btn-group" role="group">
                      <form class="d-inline" action="{{route('dashboard.admin.salaries.destroy',$salary->id)}}"
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

      </div>
    </div>
  </div>
</main>
@endsection