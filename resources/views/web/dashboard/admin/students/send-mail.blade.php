@extends('web.dashboard.master')
@section('title','Send Email to Guardian')

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
                <li class="breadcrumb-item active">Send Email</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Send Email to Guardian</h3>
        </div>
        <form action="{{ route('dashboard.admin.students.sendMail') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Subject"
                        value="{{ old('subject') }}">
                    @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" id="message" rows="4"
                        placeholder="Enter your message">{{ old('message') }}</textarea>
                    @error('message')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Send Email</button>
            </div>
        </form>
    </div>
</main>
@endsection
