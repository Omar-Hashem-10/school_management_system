@extends('web.dashboard.master')
<style>
    .hidden {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .hidden:not(.hidden) {
        opacity: 1;
    }
</style>
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
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <h3 class="card-title">Create User</h3>
        </div>
        <form action="{{route('dashboard.admin.users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name"
                        placeholder="Enter First Name" value="{{old('first_name')}}">
                    @error('first_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name"
                        placeholder="Enter Last Name" value="{{old('last_name')}}">
                    @error('last_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email"
                        value="{{old('email')}}">
                    @error('email')
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
                    <label for="gender">Gender</label>
                    <select class="form-select form-control" aria-label="Default select example" name="gender">
                        <option value="" selected>Select gender</option>
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
                        <option value="" selected>Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Select Type</label>
                    <select class="form-select form-control" aria-label="Default select example" id="type" name="type"
                        onchange="handleTypeChange()">
                        <option value="" disabled selected>Select Type</option>
                        @foreach ($types as $type)
                        <option value="{{ $type }}" {{ old('type')==$type ? 'selected' : '' }}>
                            {{ \App\Enums\UserTypesEnum::from($type)->label() }}
                        </option>
                        @endforeach
                    </select>
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter Password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div id="student-inputs" class="form-group" style="display: none;">
                    <label for="student-class">class Room</label>
                    <select class="form-select form-control" aria-label="Default select example" name="class_room_id">
                        <option value="" selected>Select classroom</option>
                        @foreach ($class_rooms as $class_room)
                        <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                        @endforeach
                    </select>
                    @error('class_room_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group" id="teacher-inputs" style="display: none;">
                    <label for="salary">salary</label>
                    <input type="number" name="salary" class="form-control" id="salary" placeholder="Enter salary"
                        value="{{old('salary')}}">
                    @error('salary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <label for="teacher_subject">Subject</label>
                    <select class="form-select form-control" aria-label="Default select example" name="subject_id">
                        <option value="" selected>Select Subject</option>
                        @foreach ($subjects as $id =>$name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <label for="experience">Experience Years</label>
                    <input type="number" name="experience" class="form-control" id="experience"
                        placeholder="Enter experience" value="{{old('experience')}}">
                    @error('experience')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group" id="admin-inputs" style="display: none;">
                    <label for="salary">salary</label>
                    <input type="number" name="salary" class="form-control" id="salary" placeholder="Enter salary"
                        value="{{old('salary')}}">
                    @error('salary')
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
@push('footer-scripts')
<script>
    function handleTypeChange() {
        const selectedType = document.querySelector('select[name="type"]').value;
        // إظهار القسم المناسب بناءً على النوع
        if (selectedType == 'student') {
            document.getElementById('student-inputs').style.display = 'block';
            document.getElementById('teacher-inputs').style.display = 'none';
            document.getElementById('admin-inputs').style.display = 'none';
        } else if (selectedType == 'teacher') {
            document.getElementById('teacher-inputs').style.display = 'block';
            document.getElementById('student-inputs').style.display = 'none';
            document.getElementById('admin-inputs').style.display = 'none';
        } else if (selectedType == 'admin') {
            document.getElementById('admin-inputs').style.display = 'block';
            document.getElementById('student-inputs').style.display = 'none';
            document.getElementById('teacher-inputs').style.display = 'none';
        }
    }
</script>
@endpush
