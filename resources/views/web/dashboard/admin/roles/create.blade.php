@extends('web.dashboard.master')

@section('title','Roles')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.roles.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Role </h3>
      </div>
      <form action="{{route('dashboard.admin.roles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="role_name">Name</label>
            <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Enter Name"
              value="{{old('role_name')}}">
            @error('role_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="for">For</label>
            <select class="form-select form-control" aria-label="Default select example" name="for"
              value="{{old('for')}}">
              <option value="employees" selected>Employees</option>
              <option value="admins" >Admins</option>
              <option value="teachers" >Teachers</option>
              <option value="students" >Students</option>
            </select>
            @error('for')
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
