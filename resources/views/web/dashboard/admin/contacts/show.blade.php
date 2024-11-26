@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Contact Details')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Contact Message Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.contacts.index') }}">Contact Messages</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-primary">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Message Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- User Details Section -->
                            <div class="col-md-6 mb-3">
                                <div class="card border-light shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title text-dark">User Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Name:</strong> {{ $contact->user->first_name }} {{ $contact->user->last_name }}</p>
                                        <p><strong>Email:</strong> {{ $contact->user->email }}</p>
                                        <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Section -->
                            <div class="col-md-6 mb-3">
                                <div class="card border-light shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title text-dark">Message</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Message:</strong></p>
                                        <blockquote class="blockquote bg-light p-3 rounded">
                                            <p class="mb-0">{{ $contact->message }}</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Display Reply if Exists -->
                        @if($contact_reply)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card border-light shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title">Reply</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Reply Message:</strong></p>
                                        <blockquote class="blockquote bg-light p-3 rounded">
                                            <p class="mb-0">{{ $contact_reply }}</p>
                                        </blockquote>
                                        <!-- Edit Reply Button -->
                                        <a class="btn btn-warning" href="{{ route('dashboard.admin.contacts.editReply', $contact->id) }}">Edit Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Display Reply Button if No Reply Exists -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card border-light shadow-sm">
                                    <div class="card-header bg-warning text-white">
                                        <h5 class="card-title">No Reply Yet</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Reply:</strong></p>
                                        <a class="btn btn-success" href="{{ route('dashboard.admin.contacts.createReply', $contact->id) }}">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Actions Section -->
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('dashboard.admin.contacts.index') }}" class="btn btn-secondary btn-sm">Back to Messages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
