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
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Role </h3>
      </div>
      <form action="{{route('dashboard.admin.roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
          <div class="form-group">
            <label for="role_name">Name</label>
            <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Enter Name"
              value="{{$role->role_name}}">
            @error('role_name')
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