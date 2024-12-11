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
            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Level</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($certificates as $certificate)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $certificate->student->user->first_name . ' ' . $certificate->student->user->last_name}}</td>
                        <td>{{ $certificate->level->name }}</td>
                        <td>{{ $certificate->academicYear->semester }}</td>
                        <td>{{ $certificate->academicYear->year }}</td>
                        <td>
                        <a class="btn btn-info" href="{{ route('dashboard.student.certificate.show', $certificate->id) }}">Show</a>
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
