@extends('web.dashboard.master')
@section('title','Home')
@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">Home</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard ">
    <div class="row">
      <!-- Left side columns -->
      @foreach ($students_guardian as $student)
      <h4>For Student: {{ $student->user->fullName() }}</h4>
      <div class="col-lg-8">
        <div class="row">
          <!-- Sales Card -->
          <div class="col-xxl-{{(app()->getLocale()=='ar')?6:4}} col-md-6">
            <div class="card info-card sales-card shadow-lg">

              <div class="card-body">
                <h5 class="card-title">{{ __('custom.Home.TotalAmount') }}</h5>

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
          <div class="col-xxl-{{(app()->getLocale()=='ar')?6:4}} col-md-6 ">
            <div class="card info-card revenue-card shadow-lg">

              <div class="card-body">
                <h5 class="card-title">{{ __('custom.Home.TotalPaied') }}</h5>

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
      @endforeach
    </div>
  </section>
</main>

@endsection