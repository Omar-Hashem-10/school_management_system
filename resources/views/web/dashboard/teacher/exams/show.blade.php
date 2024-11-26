@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Students')

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
                    </div>
                    <div class="card-body">
                        <h3>Exam Questions</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Options</th>
                                    <th>Is Correct</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $index => $question)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $question->question_text }}</td>
                                    <td>
                                        <!-- Assuming the question has options, loop through them -->
                                        <ul>
                                            @foreach($question->choices as $choice)
                                                @foreach(explode(',', $choice->choice_text) as $word)
                                                    <li>{{ $word }}</li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($question->choices as $choice)
                                                    <li>{{ $choice->is_correct}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                                    <li>Grade: {{ $question->pivot->question_grade }}</li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
