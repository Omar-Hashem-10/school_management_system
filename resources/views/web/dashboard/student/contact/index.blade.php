@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Contact')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>
        </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-transparent">
                <a href="{{ route('dashboard.student.contact.create') }}" class="btn btn-sm btn-info float-left">Add Contact</a>
              </div>
            <div class="card-header border-transparent">
              <h3 class="card-title">Contact Messages</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->user->first_name }} {{ $contact->user->last_name }}</td>
                            <td>{{ $contact->user->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{route('dashboard.student.contact.edit',$contact->id)}}">Edit</a>
                                <div class="btn-group" role="group">
                                  <form class="d-inline" action="{{route('dashboard.student.contact.destroy',$contact->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                  </form>
                                </div>
                              </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No contact messages available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>
@endsection
