@extends('web.dashboard.master')

@section('title','Home')
@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.student.home') }}">Home</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard ">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Total Amount</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>${{ $student->classRoom->level->amount }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Amount Paied</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>${{ $student->payments->sum('total') }}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

        </div>
      </div><!-- End Left side columns -->
      <div class="col-xl-12">
        <div class="row">
          
          <!-- Sales Card -->
          <div class="col-12">
            <div class="card info-card">
              <div class="gpa-container">
                <h5 class="card-title">GPA 
                  <div class="float-left d-inline">
                    <a href="{{ route('dashboard.student.contact.create') }}" class="btn btn-sm btn-primary">Evaluations</a>
                  </div>
                </h5>
                
                <div class="card-body">
                  <p><span>{{ $student->classRoom->level->name }}</span></p>
                  <p><span id="gpa-percentage">0%</span></p>
                  <div class="progress-bar">
                    <div class="progress" id="progress-bar" style="width: 0%;"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </section>
</main>
@endsection