@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Add Contact')

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
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Add Contact Message</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('dashboard.student.contact.store') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                  <label for="subject">Subject</label>
                  <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                    <option value="" disabled selected>Select Subject</option>
                    <option value="academic_inquiry">Academic Inquiry</option>
                    <option value="absence_and_attendance">Absence and Attendance</option>
                    <option value="technical_support">Technical Support</option>
                    <option value="academic_feedback">Academic Feedback</option>
                    <option value="exams">Exams</option>
                    <option value="curriculum">Curriculum</option>
                    <option value="payments_and_fees">Payments and Fees</option>
                    <option value="student_activities">Student Activities</option>
                    <option value="registration_and_admission">Registration and Admission</option>
                    <option value="job_opportunities">Job Opportunities</option>
                    <option value="counseling">Counseling</option>
                    <option value="reports_and_certificates">Reports and Certificates</option>
                    <option value="complaints">Complaints</option>
                    <option value="professional_development">Professional Development</option>
                    <option value="leave_requests">Leave Requests</option>
                  </select>
                  @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required></textarea>
                  @error('message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{ route('dashboard.student.contact.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</main>
@endsection
