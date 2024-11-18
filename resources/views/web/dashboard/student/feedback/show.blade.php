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
                        <h3>Show Feedback</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Feedback Text</th>
                                    <th>Task Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $feedback->feedback_text }}</td>
                                    <td>{{ $feedback->task_grade }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Back Button -->
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
