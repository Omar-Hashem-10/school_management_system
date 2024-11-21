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
                <a href="{{ route('dashboard.teacher.mcq') }}" class="btn btn-sm btn-success float-left ml-2">Create MCQ Question</a>
                <a href="{{ route('dashboard.teacher.true_false') }}" class="btn btn-sm btn-warning float-left ml-2">Create True/False Question</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Question Type</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->question_type }}</td>
                            <td>
                                <a href="{{ route('dashboard.teacher.questions.edit', $question->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('dashboard.teacher.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $questions->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
