@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Exam Questions')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Exam Questions for {{ $exam->name }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Exams</li>
                    <li class="breadcrumb-item active">Questions</li>
                    <li class="breadcrumb-item active">{{ $exam->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Questions for Exam: {{ $exam->name }}</h3>
                        <div class="text-danger float-end" id="timer">
                            Time Remaining: <span id="time-remaining"></span>
                        </div>
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
                        <form id="exam-form" action="{{ route('dashboard.student.answer.store', $exam->id) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                            <input type="hidden" name="student_id" value="{{ auth()->user()->student->id }}">

                            @foreach($questions as $question)
                            <div class="question">
                                <p><strong>{{ $question->question_text }}</strong></p>

                                @if($question->question_type == 'mcq')
                                @foreach($question->choices as $choice)
                                <div class="choice-group">
                                    @foreach(explode(',', $choice->choice_text) as $word)
                                    <div class="choice">
                                        <label>
                                            <input type="radio" name="answer[{{ $question->id }}]" value="{{ $word }}"
                                                class="answer-choice" data-question-id="{{ $question->id }}">
                                            {{ $word }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                @elseif($question->question_type == 'true_false')
                                <div class="choice">
                                    <label>
                                        <input type="radio" name="answer[{{ $question->id }}]" value="true"
                                            class="answer-choice" data-question-id="{{ $question->id }}">
                                        True
                                    </label>
                                </div>
                                <div class="choice">
                                    <label>
                                        <input type="radio" name="answer[{{ $question->id }}]" value="false"
                                            class="answer-choice" data-question-id="{{ $question->id }}">
                                        False
                                    </label>
                                </div>
                                @endif
                            </div>
                            @endforeach

                            @if (!$questions->hasMorePages())
                            <button type="submit" class="btn btn-primary">Submit Answers</button>
                            @endif
                        </form>

                        <div class="mt-4">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

// التحقق من وجود عنصر الوقت المتبقي
const timerDisplay = document.getElementById('time-remaining');
if (!timerDisplay) {
    console.error('Timer display element not found');
    return;
}

// استرجاع الإجابات من sessionStorage إذا كانت موجودة
if (sessionStorage.getItem('examAnswers')) {
    let savedAnswers = JSON.parse(sessionStorage.getItem('examAnswers'));
    for (let questionId in savedAnswers) {
        let selectedAnswer = savedAnswers[questionId];
        let answerInput = document.querySelector(`input[name="answer[${questionId}]"][value="${selectedAnswer}"]`);
        if (answerInput) {
            answerInput.checked = true;
        }
    }
}

const currentExamId = {{ $exam->id }};
const savedExamId = sessionStorage.getItem('currentExamId');

// التحقق من أن الامتحان الحالي هو نفسه الامتحان المخزن في sessionStorage
if (savedExamId !== currentExamId.toString()) {
    sessionStorage.removeItem('examAnswers');
    sessionStorage.removeItem('timeRemaining');
    sessionStorage.setItem('currentExamId', currentExamId);
}

// تحديد مدة الامتحان
const examDuration = {{ $exam->exam_duration ?? 0 }} * 60;
const examEndDate = new Date("{{ $exam->end_date }}").getTime();

// التحقق من صلاحية مدة الامتحان
if (!examDuration || examDuration <= 0) {
    console.error('Exam duration is not set or invalid.');
    return;
}

// استعادة الوقت المتبقي من sessionStorage إذا كان موجوداً
let timeRemaining = sessionStorage.getItem('timeRemaining')
                    ? parseInt(sessionStorage.getItem('timeRemaining'))
                    : examDuration;
if (isNaN(timeRemaining)) {
    timeRemaining = examDuration;
}

const examForm = document.getElementById('exam-form');

// تحديث العداد الزمني
const updateTimer = () => {
    const currentTime = new Date().getTime();

    if (currentTime >= examEndDate || timeRemaining <= 0) {
        clearInterval(timerInterval);
        submitExam();
    } else {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        timeRemaining--;

        sessionStorage.setItem('timeRemaining', timeRemaining);
    }
};

document.querySelectorAll('.answer-choice').forEach(function (input) {
    input.addEventListener('change', function () {
        let answers = JSON.parse(sessionStorage.getItem('examAnswers')) || {};
        let questionId = input.getAttribute('data-question-id');
        let answerValue = input.value;

        answers[questionId] = answerValue;
        sessionStorage.setItem('examAnswers', JSON.stringify(answers));

        console.log('Saved Answers:', answers);
    });
});

document.getElementById('exam-form').addEventListener('submit', function () {
    let answers = JSON.parse(sessionStorage.getItem('examAnswers')) || {};

    Object.keys(answers).forEach(function (questionId) {
        let hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `answer[${questionId}]`;
        hiddenInput.value = answers[questionId];
        document.getElementById('exam-form').appendChild(hiddenInput);
    });

    sessionStorage.removeItem('examAnswers');
});

const timerInterval = setInterval(updateTimer, 1000);
updateTimer();

    examForm.addEventListener('submit', function () {
    sessionStorage.removeItem('examAnswers');
    sessionStorage.removeItem('timeRemaining');
});
});


</script>
@endsection