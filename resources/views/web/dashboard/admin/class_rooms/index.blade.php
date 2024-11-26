@extends('web.dashboard.master')
@section('parent','components')

@section('title','Levels')

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
              <a href="{{ route('dashboard.admin.class_rooms.create') }}" class="btn btn-sm btn-info float-left">Create New Class</a>
            </div>
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Class Room Name</th>
                    <th scope="col">Level Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($class_rooms as $class_room)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$class_room->name}}</td>
                        <td>{{$class_room->level->name}}</td>
                        <td>{{$class_room->created_at}}</td>
                        <td>{{$class_room->updated_at}}</td>
                        <td>
                            <a href="{{route('dashboard.admin.class_rooms.edit', $class_room->id)}}" class="btn btn-info d-inline">Edit</a>
                            <form action="{{route('dashboard.admin.class_rooms.destroy', $class_room->id)}}" method="POST" class="d-inline">
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
              {{$class_rooms->links()}}
            </div>
          </div>

        </div>
      </div>
    </div>
</main>
@endsection
