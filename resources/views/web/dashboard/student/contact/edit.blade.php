@extends('web.dashboard.master')

@section('parent', 'Users')
@section('title', 'Edit Contact')

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
              <h3 class="card-title">Edit Contact Message</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('dashboard.student.contact.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                  <label for="subject">Subject</label>
                  <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
                    <option value="" disabled>Select Subject</option>
                    <option value="academic_inquiry" {{ old('subject', $contact->subject) == 'academic_inquiry' ? 'selected' : '' }}>Academic Inquiry</option>
                    <option value="absence_and_attendance" {{ old('subject', $contact->subject) == 'absence_and_attendance' ? 'selected' : '' }}>Absence and Attendance</option>
                    <option value="technical_support" {{ old('subject', $contact->subject) == 'technical_support' ? 'selected' : '' }}>Technical Support</option>
                    <option value="academic_feedback" {{ old('subject', $contact->subject) == 'academic_feedback' ? 'selected' : '' }}>Academic Feedback</option>
                    <option value="exams" {{ old('subject', $contact->subject) == 'exams' ? 'selected' : '' }}>Exams</option>
                    <option value="curriculum" {{ old('subject', $contact->subject) == 'curriculum' ? 'selected' : '' }}>Curriculum</option>
                    <option value="payments_and_fees" {{ old('subject', $contact->subject) == 'payments_and_fees' ? 'selected' : '' }}>Payments and Fees</option>
                    <option value="student_activities" {{ old('subject', $contact->subject) == 'student_activities' ? 'selected' : '' }}>Student Activities</option>
                    <option value="registration_and_admission" {{ old('subject', $contact->subject) == 'registration_and_admission' ? 'selected' : '' }}>Registration and Admission</option>
                    <option value="job_opportunities" {{ old('subject', $contact->subject) == 'job_opportunities' ? 'selected' : '' }}>Job Opportunities</option>
                    <option value="counseling" {{ old('subject', $contact->subject) == 'counseling' ? 'selected' : '' }}>Counseling</option>
                    <option value="reports_and_certificates" {{ old('subject', $contact->subject) == 'reports_and_certificates' ? 'selected' : '' }}>Reports and Certificates</option>
                    <option value="complaints" {{ old('subject', $contact->subject) == 'complaints' ? 'selected' : '' }}>Complaints</option>
                    <option value="professional_development" {{ old('subject', $contact->subject) == 'professional_development' ? 'selected' : '' }}>Professional Development</option>
                    <option value="leave_requests" {{ old('subject', $contact->subject) == 'leave_requests' ? 'selected' : '' }}>Leave Requests</option>
                  </select>
                  @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message', $contact->message) }}</textarea>
                  @error('message')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mt-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('dashboard.student.contact.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  
</main>
@endsection
