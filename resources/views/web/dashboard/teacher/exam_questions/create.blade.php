@extends('web.dashboard.master')

@section('title','Students')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.students.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Exam</h3>
      </div>
      <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('dashboard.teacher.exam-questions.store') }}"    method="POST">
          @csrf

          @if(session('exam_id'))
                    <input type="hidden" name="exam_id" value="{{ session('exam_id') }}">
            @endif

          <div class="form-group mb-3">
            <label>True/False Questions</label>
            @foreach($questions as $question)
                @if($question->question_type == 'true_false')
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="questions[]" value="{{ $question->id }}" id="question{{ $question->id }}">
                        <label class="form-check-label" for="question{{ $question->id }}">
                            {{ $question->question_text }}
                        </label>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="form-group mb-3">
            <label>MCQ Questions</label>
            @foreach($questions as $question)
                @if($question->question_type == 'mcq')
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="questions[]" value="{{ $question->id }}" id="question{{ $question->id }}">
                        <label class="form-check-label" for="question{{ $question->id }}">
                            {{ $question->question_text }}
                        </label>
                    </div>
                @endif
            @endforeach
        </div>


          <button type="submit" class="btn btn-primary">Create Exam</button>
        </form>
      </div>
    </div>
</main>
@endsection
