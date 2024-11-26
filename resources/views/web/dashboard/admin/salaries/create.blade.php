@extends('web.dashboard.master')
@section('title','Salaries')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item "><a
                        href="{{route('dashboard.admin.salaries.index',$date->id)}}">@yield('title')</a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Salary</h3>
        </div>
        <form action="{{route('dashboard.admin.salaries.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="person_id">Person</label>
                    <select class="form-select form-control" aria-label="Default select example" name="person_id"
                        value="{{ old('person_id') }}">
                        @if ($user)
                        @if($user['type']!='Employee')
                        <option value="{{ $user['type'] }}-{{ $user->id  }}">{{ $user->fullName() }}</option>
                        @else 
                        <option value="{{ $user['type'] }}-{{ $user->id  }}">{{ $user->name }}</option>
                        @endif
                        @else
                        <option value="">Select Person</option>
                        @endif
                        @if (!$user)
                        @foreach($people as $type => $persons)
                        @foreach($persons as $person)
                        @if ($type=='Employee')
                        <?php $personType='Employee' ?>
                        <option value="{{ $type }}-{{ $person->id  }}">{{ $person->name }}</option>
                        @else
                        <?php $personType='User' ?>
                        <option value="{{ $type }}-{{ $person->id  }}">{{ $person->fullName() }}</option>
                        @endif 
                        @endforeach
                        @endforeach
                        @endif
                    </select>
                    @error('person_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" step="0.01" value="{{ old('amount') }}">
                </div>
                @error('amount')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="date_id">Date</label>
                    <select class="form-select form-control" aria-label="Default select example" name="date_id">
                        <option value="{{ $date->id }}">{{ $date->month ." - ".$date->year }}</option>
                    </select>
                </div>
                @error('date_id')
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