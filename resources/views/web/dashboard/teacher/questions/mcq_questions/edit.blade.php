@extends('web.dashboard.master')

@section('title', 'Edit MCQ Question')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Questions</li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit MCQ Question</h3>
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

      <!-- نموذج التحديث -->
      <form action="{{ route('dashboard.teacher.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="card-body">
          <input type="hidden" name="course_code_id" value="{{ $question->course_code_id }}">
          <input type="hidden" name="teacher_id" value="{{ $question->teacher_id }}">
          <input type="hidden" name="question_type" value="mcq">

          <!-- Question Text -->
          <div class="form-group">
            <label for="question_text">Question Text</label>
            <input type="text" name="question_text" class="form-control" id="question_text" placeholder="Enter the question text"
              value="{{ old('question_text', $question->question_text) }}">
            @error('question_text')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

<!-- Input fields for choices -->
<div class="form-group" id="choices-container">
    <label for="choices">Choices</label>
    @foreach ($choices as $index => $choice)
        @foreach ($choice->choice_text as $text)
            <div class="input-group mb-2">
                <input type="text" name="choices[]" class="form-control" placeholder="Enter choice"
                    value="{{ old('choices.' . $index, $text) }}">
            </div>
        @endforeach
    @endforeach
</div>

          <!-- Correct answer input field -->
          <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            <input type="text" name="is_correct" class="form-control" id="correct_answer" placeholder="Enter the correct answer"
              value="{{ old('is_correct', $is_correct) }}">
            @error('is_correct')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
</main>

@endsection
