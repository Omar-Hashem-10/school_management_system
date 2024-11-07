@extends('web.dashboard.master')

@section('title','Students')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.students.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Student </h3>
      </div>
      <form action="{{route('dashboard.admin.students.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="student_name">Name</label>
            <input type="text" name="student_name" class="form-control" id="student_name" placeholder="Enter Name"
              value="{{old('student_name')}}">
            @error('student_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email"
              value="{{old('email')}}">
            @error ('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"
              value="{{old('phone')}}">
            @error('phone')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="role_id">Role</label>
            <select class="form-select form-control" aria-label="Default select example" name="role_id"
              value="{{old('role_id')}}">
              <option value="3" selected>student</option>
            </select>
            @error('role_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="class_room_id">Class</label>
            <select class="form-select form-control" aria-label="Default select example" name="class_room_id"
              value="{{old('class_room_id')}}">
              <option value="{{ $class->id }}" selected>{{ $class->class_name }}</option>
              @foreach ($classs as $class)
              <option value="{{ $class->id }}">{{ $class->class_name }}</option>
              @endforeach
            </select>
            @error('class_room_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="Image">
              </div>
            </div>
            @error('image')
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