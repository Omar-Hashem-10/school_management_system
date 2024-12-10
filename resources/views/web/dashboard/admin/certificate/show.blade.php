@extends('web.dashboard.master')
@section('title', 'Certificate Details')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Certificate Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.certificates.index') }}">Certificates</a></li>
                <li class="breadcrumb-item active">Certificate Details</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Student: {{ $certificate->student->user->first_name . ' ' . $certificate->student->user->last_name }}</h4>
            <h4>Total Marks: {{ $certificate->total_marks }}</h4>
            <h4>Obtained Marks: {{ $certificate->obtained_marks }}</h4>
            <h4>Percentage: %{{ $certificate->percentage }}</h4>
            <h4>Grade: {{ $certificate->grade }}</h4>
            <h4>Academic Year: {{ $certificate->academicYear->year }}</h4>

            <h5>Course Details:</h5>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Subject Name</th>
                        <th>Course Code</th>
                        <th>Subject Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        @foreach($subjects as $subject)
                            @foreach($subject->levels as $level)
                                @if($result->level_subject_id == $level->pivot->id)
                                    <tr>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $result->code }}</td>
                                        <td>{{ $result->pivot->subject_marks }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
