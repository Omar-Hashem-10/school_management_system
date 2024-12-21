@extends('web.dashboard.master')
@section('title','Courses')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Components</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-transparent">
              <a href="{{ route('dashboard.admin.subjects.create') }}" class="btn btn-sm btn-info float-left">Place New subjects</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$subject->name}}</td>
                        <td>{{$subject->created_at}}</td>
                        <td>{{$subject->updated_at}}</td>
                        <td>
                            <a href="{{route('dashboard.admin.subjects.edit', $subject->id)}}" class="btn btn-info d-inline">Edit</a>
                            <form action="{{route('dashboard.admin.subjects.destroy', $subject->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              {{$subjects->links()}}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
