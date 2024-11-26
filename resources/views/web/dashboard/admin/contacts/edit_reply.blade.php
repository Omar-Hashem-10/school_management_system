@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Edit Reply to Contact Message')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Reply to Contact Message</h1>
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
                        <h3 class="card-title">Edit Reply</h3>
                    </div>
                    <div class="card-body">
                        <!-- Reply Form -->
                        <form action="{{ route('dashboard.admin.contacts.update', $contact_reply->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- حقول مخفية -->
                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <!-- حقل الرسالة -->
                            <div class="form-group">
                                <label for="reply_message">Reply Message</label>
                                <textarea id="reply_message" name="reply_message" class="form-control" rows="5">{{ old('reply_message', $contact_reply->reply_message) }}</textarea>
                                @error('reply_message')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Update Reply</button>
                        </form>


                        <!-- Back Button -->
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
