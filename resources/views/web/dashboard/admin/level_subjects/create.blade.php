@extends('web.dashboard.master')

@section('title','Level_Subjects')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.level_subjects.index') }}">@yield('title')</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Form</h5>

                    <!-- Vertical Form -->
                    <form action="{{ route('dashboard.admin.level_subjects.store') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label for="subject_id" class="form-label">Subject</label>
                            <select class="form-select" name="subject_id" id="subject_id">
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="level_id" class="form-label">Level</label>
                            <select class="form-select" name="level_id" id="level_id">
                                <option value="">Select Level</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
