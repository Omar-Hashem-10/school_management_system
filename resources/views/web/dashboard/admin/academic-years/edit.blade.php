@extends('web.dashboard.master')
@section('title', 'Edit Academic Year')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Academic Years</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent">
              <h4>Edit Academic Year</h4>
            </div>
            <div class="card-body">
              <!-- Form to edit an existing academic year -->
              <form action="{{ route('dashboard.admin.academic-years.update', $academicYear->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This is necessary for PUT requests to update an existing record -->

                <div class="form-group">
                  <label for="year">Academic Year</label>
                  <input type="text" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $academicYear->year) }}" required>
                  @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="semester">Academic Semester</label>
                  <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                    <option value="" disabled>Select Semester</option>
                    <option value="Term 1" {{ old('semester', $academicYear->semester) == 'Term 1' ? 'selected' : '' }}>Term 1</option>
                    <option value="Term 2" {{ old('semester', $academicYear->semester) == 'Term 2' ? 'selected' : '' }}>Term 2</option>
                  </select>
                  @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="start_date">Start Date</label>
                  <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $academicYear->start_date) }}" required>
                  @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="end_date">End Date</label>
                  <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $academicYear->end_date) }}" required>
                  @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('dashboard.admin.academic-years.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
