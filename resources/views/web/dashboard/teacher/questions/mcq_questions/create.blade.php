@extends('web.dashboard.master')

@section('title','Create True/False Question')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Questions</li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create MCQ Question</h3>
      </div>

      <!-- Display errors at the top of the form -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('dashboard.teacher.questions.store') }}" method="POST">
        @csrf
        <div class="card-body">
          <input type="hidden" name="course_code_id" value="{{ $course_code_id }}">
          <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">
          <input type="hidden" name="question_type" value="mcq">
          <input type="hidden" name="choice_text" value="">

          <!-- Question Text -->
          <div class="form-group">
            <label for="question_text">Question Text</label>
            <input type="text" name="question_text" class="form-control" id="question_text" placeholder="Enter the question text"
              value="{{ old('question_text') }}">
            @error('question_text')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

            <!-- Input fields for choices -->
            <div class="form-group" id="choices-container">
                <label for="choices">Choices</label>
                <div class="input-group mb-2">
                <input type="text" name="choices[]" class="form-control" placeholder="Enter choice">
                </div>
                <div class="input-group mb-2">
                <input type="text" name="choices[]" class="form-control" placeholder="Enter choice">
                </div>
                <div class="input-group mb-2">
                <input type="text" name="choices[]" class="form-control" placeholder="Enter choice">
                </div>
                <div class="input-group mb-2">
                <input type="text" name="choices[]" class="form-control" placeholder="Enter choice">
                </div>
            </div>

          <!-- Correct answer input field -->
          <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            <input type="text" name="is_correct" class="form-control" id="correct_answer" placeholder="Enter the correct answer"
              value="{{ old('is_correct') }}">
            @error('is_correct')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
</main>

@endsection
