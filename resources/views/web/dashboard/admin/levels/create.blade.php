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
                <form action="{{route('dashboard.admin.levels.store')}}" method="POST" class="row g-3">
                    @csrf
                  <div class="col-12">
                    <label for="name" class="form-label">Level Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="amount" class="form-label">Level Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount" value="{{old('amount')}}">
                    @error('amount')
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
