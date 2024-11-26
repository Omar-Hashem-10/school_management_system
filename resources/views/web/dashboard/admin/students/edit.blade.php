@extends('web.dashboard.master')
@section('title','Users')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.users.index') }}">@yield('title')</a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create User</h3>
        </div>
        <form action="{{route('dashboard.admin.students.update',$student->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name"
                        placeholder="Enter First Name" value="{{$student->user->first_name}}">
                    @error('first_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name"
                        placeholder="Enter Last Name" value="{{$student->user->last_name}}">
                    @error('last_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email"
                        value="{{$student->user->email}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"
                        value="{{$student->user->phone}}">
                    @error('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-select form-control" aria-label="Default select example" name="gender">
                        <option value="{{$student->user->gender}}" selected>{{$student->user->gender}}</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select class="form-select form-control" aria-label="Default select example" name="role_id">
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                    </select>
                    @error('role_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Select Type</label>
                    <select class="form-select form-control" aria-label="Default select example" id="type" name="type">
                        <option value="student" selected >Student</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter Password" value="{{$student->user->password}}">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div id="student-inputs" class="form-group" >
                    <label for="student-class">class Room</label>
                    <select class="form-select form-control" aria-label="Default select example" name="class_room_id">
                        <option value="{{$student->class_room_id}}" selected>{{$student->classRoom->name}}</option>
                        @foreach ($class_rooms as $class_room)
                        <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                        @endforeach
                    </select>
                    @error('class_room_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div id="student-inputs" class="form-group" >
                    <label for="student-parent">Parent</label>
                    <select class="form-select form-control" aria-label="Default select example" name="guardian_id">
                        <option value="{{$student->guardian->id}}" selected>{{$student->guardian->user->fullName()}}</option>
                        @foreach ($guardians as $guardian)
                        <option value="{{ $guardian->id }}">{{ $guardian->user->fullName() }}</option>
                        @endforeach
                    </select>
                    @error('guardian_id')
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
