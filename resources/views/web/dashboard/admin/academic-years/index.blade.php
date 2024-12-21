@extends('web.dashboard.master')
@section('title', __('custom.aside.AcademicYears'))

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ __('custom.aside.Dashboard') }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">{{ __('custom.pages.Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('custom.aside.Managements') }}</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.academic-years.create') }}" class="btn btn-sm btn-info float-left">Add New Academic Year</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('custom.table.AcademicYear') }}</th>
                    <th scope="col">{{ __('custom.table.Semester') }}</th>
                    <th scope="col">{{ __('custom.table.StartDate') }}</th>
                    <th scope="col">{{ __('custom.table.EndDate') }}</th>
                    <th scope="col">{{ __('custom.table.CreatedAt') }}</th>
                    <th scope="col">{{ __('custom.table.UpdatedAt') }}</th>
                    <th scope="col">{{ __('custom.table.Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($academic_years as $year)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$year->year}}</td>
                        <td>{{$year->semester}}</td>
                        <td>{{$year->start_date}}</td>
                        <td>{{$year->end_date}}</td>
                        <td>{{$year->created_at}}</td>
                        <td>{{$year->updated_at}}</td>
                        <td>
                            <a href="{{route('dashboard.admin.academic-years.edit', $year->id)}}" class="btn btn-info d-inline">Edit</a>
                            <form action="{{route('dashboard.admin.academic-years.destroy', $year->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{$academic_years->links()}}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
