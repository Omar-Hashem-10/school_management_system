@extends('web.dashboard.master')

@section('title','Levels')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item ">Users</li>
            <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.levels.index') }}">@yield('title')</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
    </div>
</main>
@endsection