@extends('web.dashboard.master')

@section('title','Dates')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ redirect()->back() }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit date </h3>
      </div>
      <form action="{{route('dashboard.admin.dates.update',$date->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            @if($date->day)
          <div class="form-group">
            <label for="day">Day</label>
            <input type="number" name="day" class="form-control" id="day" placeholder="Enter day"
              value="{{$date->day}}">
            @error('day')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          @endif
          <div class="form-group">
            <label for="month">Month</label>
            <input type="number" name="month" class="form-control" id="month" placeholder="Enter month"
              value="{{$date->month}}">
            @error('month')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="year">year</label>
            <input type="number" name="year" class="form-control" id="year" placeholder="Enter year"
              value="{{$date->year}}">
            @error('year')
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