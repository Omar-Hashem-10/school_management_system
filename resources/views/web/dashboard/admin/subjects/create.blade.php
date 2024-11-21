@extends('web.dashboard.master')

@section('title','Subjects')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Components</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.subjects.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>

        <div class="col-lg-6 ms-auto me-auto">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Vertical Form</h5>

                <!-- Vertical Form -->
                <form action="{{route('dashboard.admin.subjects.store')}}" method="POST" class="row g-3">
                    @csrf
                  <div class="col-12">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    @error('name')
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
