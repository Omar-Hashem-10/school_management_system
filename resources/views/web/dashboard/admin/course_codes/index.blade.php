@extends('web.dashboard.master')

@section('parent', 'components')

@section('title', 'Courses_codes')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Components</li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <a href="{{ route('dashboard.admin.course_codes.create') }}" class="btn btn-sm btn-info float-left">Place New course_code</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Level Name</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($course_codes && $course_codes->isNotEmpty() && $levels && $levels->isNotEmpty())
                                    @foreach($course_codes as $course_code)
                                        @foreach($levels as $level)
                                            @foreach($level->subjects as $subject)
                                                @if($course_code->level_subject_id == $subject->pivot->id)
                                                    <tr>
                                                        <th scope="row">{{ $loop->parent->iteration }}</th>
                                                        <td>{{ $course_code->code }}</td>
                                                        <td>{{ $course_code->semester }}</td>
                                                        <td>{{ $level->name }}</td>
                                                        <td>{{ $subject->name }}</td>
                                                        <td>
                                                            <a href="{{ route('dashboard.admin.course_codes.edit', $course_code->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('dashboard.admin.course_codes.destroy', $course_code->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
