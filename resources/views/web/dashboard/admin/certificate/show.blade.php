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

    <div class="card shadow mt-4 mx-auto" style="width: 90%; max-width: 800px;">
        <div class="container mt-5">
        <div class="card-body">
            <h4 class="mb-3">Student: <span class="text-primary">{{ $certificate->student->user->first_name . ' ' . $certificate->student->user->last_name }}</span></h4>
            <h4 class="mb-3">Total Marks: <span class="text-success">{{ $certificate->total_marks }}</span></h4>
            <h4 class="mb-3">Obtained Marks: <span class="text-info">{{ $certificate->obtained_marks }}</span></h4>
            <h4 class="mb-3">Percentage: <span class="text-warning">%{{ $certificate->percentage }}</span></h4>
            <h4 class="mb-3">Grade: <span class="text-danger">{{ $certificate->grade }}</span></h4>
            <h4 class="mb-4">Academic Year: <span class="text-secondary">{{ $certificate->academicYear->year }}</span></h4>
            <h4 class="mb-4">Semester: <span class="text-secondary">{{ $certificate->academicYear->semester }}</span></h4>

            <h5 class="mb-3">Course Details:</h5>
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
    </div>

</main>
@endsection
