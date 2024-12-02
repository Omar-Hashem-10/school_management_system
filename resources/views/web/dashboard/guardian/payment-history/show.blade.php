@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Payment Details')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Payment Details for {{ $student->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Payments</li>
                <li class="breadcrumb-item active">Details</li>
                <li class="breadcrumb-item active">{{ $student->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Payment Details for Student: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
                        <!-- Displaying Errors if Any -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Student Information -->
                        <div class="student-info mb-5">
                            <h5 class="text-primary">Student Information:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> {{ $student->user->first_name }} {{ $student->user->last_name }}</p>
                                    <p><strong>Student ID:</strong> {{ $student->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $student->user->email }}</p>
                                    <p><strong>Grade Level:</strong> {{ $student->classRoom->level->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Displaying Payment Information -->
                        <h5 class="text-success mb-3">Payment Information:</h5>

                        @foreach($terms as $term)
                            @php
                                $paymentForTerm = $payments->firstWhere('academic_year_id', $term->id);
                            @endphp

                            @if($paymentForTerm)
                                <!-- Paid Payment Card -->
                                <div class="payment-info mb-4 p-3 border rounded shadow-sm">
                                    <h6 class="text-primary">Payment Date: {{ $paymentForTerm->created_at }}</h6>
                                    <p><strong>Amount Paid:</strong> <span class="badge bg-success">${{ $paymentForTerm->total }}</span></p>
                                    <p><strong>Semester:</strong> {{ $term->semester }}</p>
                                    <p><strong>Academic Year:</strong> {{ $term->year }}</p>
                                    <p><strong>Student Academic Year:</strong> {{ $paymentForTerm->level->name }}</p>
                                </div>
                            @else
                                <!-- Unpaid Payment Card -->
                                <div class="card mt-3 border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h5>Payment Pending for {{ $term->semester }} - {{ $term->year }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Level:</strong> {{ $student->classRoom->level->name }}</p>
                                        <p><strong>Amount Due:</strong> <span class=" badge bg-danger">${{ $student->classRoom->level->amount / 2 }}</span></p>
                                        <a href="{{ route('dashboard.guardian.payment', ['student_id' => $student->id, 'term_id' => $term->id]) }}" class="btn btn-primary mt-3">
                                            Pay Now
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
