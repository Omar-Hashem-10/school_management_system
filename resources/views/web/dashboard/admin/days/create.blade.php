@extends('web.dashboard.master')

@section('title','Days')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Components</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.days.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Day</h3>
      </div>
      <form action="{{route('dashboard.admin.days.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="day_name">Select Day</label>
            <select class="form-select form-control" name="day_name" id="day_name">
              <option value="Saturday" {{ old('day_name') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
              <option value="Sunday" {{ old('day_name') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
              <option value="Monday" {{ old('day_name') == 'Monday' ? 'selected' : '' }}>Monday</option>
              <option value="Tuesday" {{ old('day_name') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
              <option value="Wednesday" {{ old('day_name') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
              <option value="Thursday" {{ old('day_name') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
            </select>
            @error('day_name')
            <span class="text-danger">{{$message}}</span>
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
