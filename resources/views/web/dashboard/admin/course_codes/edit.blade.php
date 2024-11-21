@extends('web.dashboard.master')

@section('title','Courses_Codes')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Components</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.course_codes.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Course Code</h5>
                    </div>
                    <div class="card-body">
                        <!-- Form to edit existing course -->
                        <form action="{{ route('dashboard.admin.course_codes.update', $course_code->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT method for edit -->

                            <!-- Course Code -->
                            <div class="form-group">
                                <label for="code">Course Code</label>
                                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $course_code->code) }}" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Semester -->
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select id="semester" name="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    <option value="first" {{ $course_code->semester == 'first' ? 'selected' : '' }}>First</option>
                                    <option value="second" {{ $course_code->semester == 'second' ? 'selected' : '' }}>Second</option>
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Select Level Subject -->
                            <div class="form-group">
                                <label for="level_subject_id">Select Level Subject</label>
                                <select id="level_subject_id" name="level_subject_id" class="form-control @error('level_subject_id') is-invalid @enderror" required>
                                    <option value="">Select Subject</option>
                                    @foreach($levels as $level)
                                        @foreach($level->subjects as $subject)
                                            <option value="{{ $subject->pivot->id }}"
                                                    {{ $subject->pivot->id == $course_code->level_subject_id ? 'selected' : '' }}>
                                                Level: {{ $level->name }} - Subject: {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('level_subject_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
