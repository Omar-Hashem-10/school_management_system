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
        <li class="breadcrumb-item "><a
            href="{{ route('dashboard.admin.salaries.index',$date->id) }}">@yield('title')</a></li>
      </ol>
    </nav>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header border-transparent">
            <a href="{{ route('dashboard.admin.salaries.create',[$date->id,0,' ']) }}"
              class="btn btn-sm btn-info float-left">Place New
              Amount</a>
          </div>
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table table-striped">

              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Position</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Created_At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($salaries as $salary )
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  @if ($salary['person_type'] == "App\Models\Employee")
                  <td>{{ ($salary->person->name) }}</td>
                  <td><span class="badge bg-primary">{{ $salary->person->possition }}</span></td>
                  @elseif ($salary['person_type'] == "App\Models\User")
                  <td>{{ $salary->person->fullName() }}</td>
                  @if($salary->person->role['role_name']=='admin')
                  <td><span class="badge bg-danger">{{ $salary->person->role['role_name'] }}</span></td>
                  @elseif ($salary->person->role['role_name']=='manager')
                  <td><span class="badge bg-warning">{{ $salary->person->role['role_name'] }}</span></td>
                  @elseif ($salary->person->role['role_name']=='teacher')
                  <td><span class="badge bg-success">teacher</span></td>
                  @endif
                  @endif
                  <td>{{ $salary->amount }}</td>
                  <td>{{ $salary->created_at }}</td>
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
