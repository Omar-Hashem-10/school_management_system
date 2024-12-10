@extends('web.dashboard.master')
@section('title','Certificates')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Certificates</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.certificates.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Certificate Subject</h3>
        </div>
        <form action="{{ route('dashboard.admin.certificate_subjects.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <input type="hidden" name="certificate_id" value="{{ session('certificateId') }}">
                <div class="form-group">
                    <label for="subject_marks">Subject Marks</label>
                    <input type="number" name="subject_marks" class="form-control" id="subject_marks" placeholder="Enter Subject Marks" value="{{ old('subject_marks') }}">
                    @error('subject_marks')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="course_code_id">Course Code</label>
                    <select class="form-select form-control" name="course_code_id" id="course_code_id">
                        <option disabled selected>Select Course</option>
                        @foreach ($course_codes as $course)
                            @foreach ($subjects as $subject)
                                @foreach ($subject->levels as $level)
                                    @if ($course->level_subject_id == $level->pivot->id && $level->id == $level_id)
                                        <option value="{{ $course->id }}">
                                            {{ $course->code }} - {{ $level->name }} - {{ $subject->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                    @error('course_code_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('dashboard.admin.certificates.index') }}" class="btn btn-secondary">BACK</a>
            </div>
        </form>
    </div>
</main>
@endsection
