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
                <form action="{{route('dashboard.admin.levels.update', $level->id)}}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                  <div class="col-12">
                    <label for="level_name" class="form-label">Level Name</label>
                    <input type="text" class="form-control" name="level_name" id="level_name" value="{{old('level_name', $level->level_name)}}">
                    @error('level_name')
                        <span class="text-danger">{{$message}}</span>
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
</main>
@endsection
