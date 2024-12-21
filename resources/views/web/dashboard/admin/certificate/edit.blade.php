@extends('web.dashboard.master')
@section('title','Edit Certificate')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Certificates</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.certificates.index') }}">@yield('title')</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Certificate</h3>
        </div>
        <form action="{{ route('dashboard.admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <input type="hidden" name="level_id" value="{{ $certificate->level_id }}">
                <input type="hidden" name="student_id" value="{{ $certificate->student_id }}">
                <input type="hidden" name="academic_year_id" value="{{ $certificate->academic_year_id }}">
                <div class="form-group">
                    <label for="total_marks">Total Marks</label>
                    <input type="number" name="total_marks" class="form-control" id="total_marks"
                        placeholder="Enter Total Marks" value="{{ old('total_marks', $certificate->total_marks) }}">
                    @error('total_marks')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="obtained_marks">Obtained Marks</label>
                    <input type="number" name="obtained_marks" class="form-control" id="obtained_marks"
                        placeholder="Enter Obtained Marks" value="{{ old('obtained_marks', $certificate->obtained_marks) }}">
                    @error('obtained_marks')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input type="number" step="0.01" name="percentage" class="form-control" id="percentage"
                        placeholder="Enter Percentage" value="{{ old('percentage', $certificate->percentage) }}">
                    @error('percentage')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <select class="form-select form-control" aria-label="Default select example" name="grade">
                        @foreach(['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-'] as $grade)
                        <option value="{{ $grade }}" {{ $certificate->grade == $grade ? 'selected' : '' }}>{{ $grade }}</option>
                        @endforeach
                    </select>
                    @error('grade')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('dashboard.admin.certificate_subjects.edit', $certificate->id) }}" class="btn btn-secondary">Update Certificate Courses</a>
            </div>
        </form>
    </div>
</main>
@endsection
