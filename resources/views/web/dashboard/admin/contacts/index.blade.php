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
              <h3 class="card-title">Contact Messages</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Reply Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->user->first_name }} {{ $contact->user->last_name }}</td>
                            <td>{{ $contact->user->email }}</td>
                            <td>{{ $contact->user->role->role_name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                @if($contact->replies->isNotEmpty())
                                    <span class="badge bg-success">Replied</span>
                                @else
                                    <span class="badge bg-danger">Not Replied</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('dashboard.admin.contacts.show', $contact->id) }}">Show</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No contact messages available.</td>
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
