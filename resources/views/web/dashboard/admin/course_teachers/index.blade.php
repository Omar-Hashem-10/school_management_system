@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Teachers')

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
                        <a href="{{ route('dashboard.admin.course_teachers.create') }}" class="btn btn-sm btn-info float-left">Add Class For Teacher</a>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Class Room</th>
                                    <th scope="col">Teacher Name</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Updated at</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course_teachers as $course_teacher)
                                    @foreach ($course_teacher->classRooms as $classRoom)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $course_teacher->code }}</td>
                                            <td>{{ $classRoom->name ?? 'N/A' }}</td>
                                            <td>
                                                @foreach ($course_teacher->teachers as $teacher)
                                                    {{ $teacher->user->first_name }} @if (!$loop->last), @endif
                                                @endforeach
                                                @if ($course_teacher->teachers->isEmpty())
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $course_teacher->semester }}</td>
                                            <td>{{ $course_teacher->created_at }}</td>
                                            <td>{{ $course_teacher->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.admin.course_teachers.edit', $course_teacher->pivot->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('dashboard.admin.course_teachers.destroy', $course_teacher->pivot->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('dashboard.admin.teachers.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
