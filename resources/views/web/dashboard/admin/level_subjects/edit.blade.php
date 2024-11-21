@extends('web.dashboard.master')

@section('title','Admins')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.home.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vertical Form</h5>

                <!-- Vertical Form -->
                <form action="{{ route('dashboard.admin.level_subjects.update', ['subject' => $subject->id, 'level' => $level->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Course Selection -->
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select class="form-select" name="subject_id" id="subject_id">
                            <option value="">Select Course</option>
                            @foreach($subjects as $subjectItem)
                                <option value="{{ $subjectItem->id }}" {{ $subjectItem->id == $subject->id ? 'selected' : '' }}>
                                    {{ $subjectItem->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Level Selection -->
                    <div class="mb-3">
                        <label for="level_id" class="form-label">Level</label>
                        <select class="form-select" name="level_id" id="level_id">
                            <option value="">Select Level</option>
                            @foreach($levels as $levelItem)
                                <option value="{{ $levelItem->id }}" {{ $levelItem->id == $level->id ? 'selected' : '' }}>
                                    {{ $levelItem->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
    </div>
</main>
@endsection
