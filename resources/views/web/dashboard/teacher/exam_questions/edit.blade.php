@extends('web.dashboard.master')

@section('title', 'Edit Exam')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.students.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Exam</h3>
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

            {{-- النموذج المشترك --}}
            <form action="{{ route('dashboard.teacher.exam-questions.update', $exam->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if(session('exam_id_edit'))
                    <input type="hidden" name="exam_id" value="{{ session('exam_id_edit') }}">
                @endif

                <div class="row">
                    {{-- قسم الأسئلة غير المدرجة في الامتحان --}}
                    <div class="col-md-6">
                        <h4>Questions Not in Exam</h4>

                        <div class="form-group mb-3">
                            <label>True/False Questions Not in Exam</label>
                            @foreach($questions_not_in_exam as $question)
                                @if($question->question_type == 'true_false')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="questions_not_in_exam[]" value="{{ $question->id }}" id="questionNotInExam{{ $question->id }}">
                                        <label class="form-check-label" for="questionNotInExam{{ $question->id }}">
                                            {{ $question->question_text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label>MCQ Questions Not in Exam</label>
                            @foreach($questions_not_in_exam as $question)
                                @if($question->question_type == 'mcq')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="questions_not_in_exam[]" value="{{ $question->id }}" id="questionNotInExam{{ $question->id }}">
                                        <label class="form-check-label" for="questionNotInExam{{ $question->id }}">
                                            {{ $question->question_text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- قسم الأسئلة المدرجة في الامتحان --}}
                    <div class="col-md-6">
                        <h4>Questions in Exam</h4>

                        <div class="form-group mb-3">
                            <label>True/False Questions in Exam</label>
                            @foreach($exam->questions as $question)
                                @if($question->question_type == 'true_false')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="questions_in_exam[]" value="{{ $question->id }}" id="questionInExam{{ $question->id }}" checked>
                                        <label class="form-check-label" for="questionInExam{{ $question->id }}">
                                            {{ $question->question_text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label>MCQ Questions in Exam</label>
                            @foreach($exam->questions as $question)
                                @if($question->question_type == 'mcq')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="questions_in_exam[]" value="{{ $question->id }}" id="questionInExam{{ $question->id }}" checked>
                                        <label class="form-check-label" for="questionInExam{{ $question->id }}">
                                            {{ $question->question_text }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- زرّ واحد للإرسال --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Update Exam</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
