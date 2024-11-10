@extends('web.dashboard.master')

@section('title','Edit True/False Question')

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
        <h3 class="card-title">Edit True/False Question</h3>
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

      <form action="{{ route('dashboard.teacher.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Specify the method as PUT for updating -->
        <div class="card-body">
          <!-- Hidden Fields for course_level_id and teacher_id -->
          <input type="hidden" name="course_level_id" value="{{ session('course_level_id') }}">
          <input type="hidden" name="teacher_id" value="{{ session('teacher_id') }}">
          <input type="hidden" name="question_type" value="true_false">
          <input type="hidden" name="choice_text" value="true,false">

          <!-- Question Text -->
          <div class="form-group">
            <label for="question_text">Question Text</label>
            <input type="text" name="question_text" class="form-control" id="question_text" placeholder="Enter the question text"
              value="{{ old('question_text', $question->question_text) }}">
            @error('question_text')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <!-- Correct answer selection -->
          <div class="form-group">
            <label for="is_correct">Correct Answer</label>
            <select class="form-select form-control" name="is_correct" id="is_correct">
              <option value="true" {{ old('is_correct', $is_correct) == 'true' ? 'selected' : '' }}>True</option>
              <option value="false" {{ old('is_correct', $is_correct) == 'false' ? 'selected' : '' }}>False</option>
            </select>
            @error('is_correct')
            <span class="text-danger">{{$message}}</span>
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
