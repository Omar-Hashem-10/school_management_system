@extends('web.dashboard.master')

@section('parent','Schedule')

@section('title','Class Schedule')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Schedule</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent d-flex">
                <a href="{{ route('dashboard.admin.certificates.create') }}" class="btn btn-sm btn-info me-2">Add New Certificate</a>
            </div>

            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Level</th>
                    {{-- <th scope="col">Semester</th> --}}
                    <th scope="col">Total Marks</th>
                    <th scope="col">Obtained Marks</th>
                    <th scope="col">Percentage</th>
                    <th scope="col">Grade</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($certificates as $certificate)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $certificate->student->user->first_name . ' ' . $certificate->student->user->last_name}}</td>
                        <td>{{ $certificate->level->name }}</td>
                        <td>{{ $certificate->total_marks }}</td>
                        <td>{{ $certificate->obtained_marks }}</td>
                        <td>%{{ $certificate->percentage }}</td>
                        <td>{{ $certificate->grade }}</td>
                        <td>{{ $certificate->created_at }}</td>
                        <td>{{ $certificate->updated_at }}</td>
                        <td>
                        <a class="btn btn-warning" href="{{ route('dashboard.admin.certificates.edit', $certificate->id) }}">Edit</a>
                        <a class="btn btn-info" href="{{ route('dashboard.admin.certificates.show', $certificate->id) }}">Show</a>
                        <div class="btn-group" role="group">
                            <form class="d-inline" action="{{ route('dashboard.admin.certificates.destroy', $certificate->id) }}" method="post">
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
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
