@extends('web.dashboard.master')
@section('parent','Users')

@section('title','Students')

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
                <a href="{{ route('dashboard.teacher.exams.create') }}" class="btn btn-sm btn-info float-left">Create New Exam</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Exam Date</th>
                            <th scope="col">Exam Duration</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $exam->exam_name }}</td>
                            <td>{{ $exam->exam_date }}</td>
                            <td>{{ $exam->exam_duration }}</td>
                            <td>
                                <a href="{{ route('dashboard.teacher.exams.edit', $exam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('dashboard.teacher.exams.destroy', $exam->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $exams->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
