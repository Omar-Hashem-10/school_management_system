@extends('web.dashboard.master')

@section('title','Time Slots')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item ">Schedules</li>
        <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.time_slots.index') }}">@yield('title')</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Time Slot</h3>
    </div>
    <form action="{{ route('dashboard.admin.time_slots.store') }}" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="lecture_number">Lecture Number</label>
          <input type="text" name="lecture_number" class="form-control" id="lecture_number" placeholder="Enter Lecture Number"
            value="{{ old('lecture_number') }}">
          @error('lecture_number')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="start_time">Start Time</label>
          <input type="time" name="start_time" class="form-control" id="start_time" value="{{ old('start_time') }}">
          @error('start_time')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="end_time">End Time</label>
          <input type="time" name="end_time" class="form-control" id="end_time" value="{{ old('end_time') }}">
          @error('end_time')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</main>
@endsection
