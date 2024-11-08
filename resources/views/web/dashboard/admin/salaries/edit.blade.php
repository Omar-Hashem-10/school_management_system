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
                    <select class="form-select form-control" aria-label="Default select example" name="person_id"
                    value="{{ $salary->person_id }}">
                        <option value="{{ $salary->person_type }}">Select Person</option>
                        @foreach($people as $type => $persons)
                        @foreach($persons as $person)
                        @if($type =='Admin')
                        <option value="{{ $type }}-{{ $person->id }}">{{ $person->admin_name }}</option>
                        @elseif ($type =='Teacher')
                        <option value="{{ $type }}-{{ $person->id }}">{{ $person->teacher_name }}</option>
                        @else
                        <option value="{{ $type }}-{{ $person->id }}">{{ $person->employee_name }}</option>
                        @endif
                        @endforeach
                        @endforeach
                    </select>
                    @error('person_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="base_salary">Base Salary</label>
                    <input type="number" name="base_salary" class="form-control" value="{{ $salary->base_salary }}">
                </div>
                @error('base_salary')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="bonus">Bonus</label>
                    <input type="number" name="bonus" class="form-control" step="0.01" value="{{ $salary->bonus }}}">
                </div>
                @error('bonus')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="deduction">Deduction</label>
                    <input type="number" name="deduction" class="form-control" step="0.01" value="{{ $salary->deduction }}">
                </div>
                @error('deduction')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="month">Month</label>
                    <input type="number" name="month" class="form-control"  min="1" max="12" value="{{ $salary->month }}">
                </div>
                @error('month')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" class="form-control"  min="1900" max="2099" value="{{ $salary->year }}">
                </div>
                @error('year')
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