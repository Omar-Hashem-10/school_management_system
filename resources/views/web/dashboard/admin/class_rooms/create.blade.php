@extends('web.dashboard.master')

@section('title','Admins')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Level</li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Vertical Form</h5>

                <!-- Vertical Form -->
                <form action="{{route('dashboard.admin.class_rooms.store')}}" method="POST" class="row g-3">
                    @csrf
                  <div class="col-12">
                    <label for="class_name" class="form-label">Class Room Name</label>
                    <input type="text" class="form-control" name="class_name" id="class_name" value="{{old('class_name')}}">
                    @error('class_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="level_id" class="form-label">Level</label>
                    <select class="form-select" name="level_id" id="level_id">
                    <option value="">Select Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->level_name }}</option>
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

</main>
@endsection