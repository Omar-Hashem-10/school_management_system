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

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Questions for Exam: {{ $exam->name }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Your Answer</th>
                                    <th>Is Correct</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                    <tr class="{{ $answer->answer == $answer->question->choices->firstWhere('is_correct', true)->is_correct ? 'table-success' : 'table-danger' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $answer->question->question_text }}
                                            @if ($answer->answer == $answer->question->choices->firstWhere('is_correct', true)->is_correct)
                                                <i class="fa fa-check" style="color: green;"></i>
                                            @elseif ($answer->answer != $answer->question->choices->firstWhere('is_correct', true)->is_correct)
                                                <i class="fa fa-times" style="color: red;"></i>
                                            @endif
                                        </td>
                                        <td>{{ $answer->answer }}</td>
                                        <td>{{ $answer->question->choices->firstWhere('is_correct', true)->is_correct }}</td>
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
