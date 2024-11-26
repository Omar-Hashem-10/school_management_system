@extends('web.dashboard.master')

@section('title','Admins')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item "><a href="{{ route('dashboard.admin.admins.index') }}">@yield('title')</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Salary</h3>
        </div>
        <form action="{{route('dashboard.admin.salaries.update',$salary->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="person_id">Person</label>
                    <select class="form-select form-control" aria-label="Default select example" name="person_id">
                        @if ($salary->person_type ==="App\Models\Employee")
                        <option value="{{ $salary->person_type }}-{{ $salary->person_id }}" selected>{{ $salary->person->name}}</option>
                        @else
                        <option value="{{ $salary->person_type }}-{{ $salary->person_id }}" selected>{{ $salary->person->fullName()}}</option>
                        @endif
                    </select>
                    @error('person_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ $salary->amount }}">
                </div>
                @error('amount')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="date_id">Date</label>
                    <input type="text" name="date_id" class="form-control"  min="1" max="12" value="{{ $salary->date_id }}">
                </div>
                @error('month')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</main>
@endsection