@extends('web.dashboard.master')

@section('title',__('custom.pages.Home'))
@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>{{ __('custom.aside.Dashboard') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.teacher.home') }}">{{ __('custom.pages.Home') }}</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard ">
    <div class="row">
  
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xxl-{{(app()->getLocale()=='ar')?6:4}} col-md-6">
            <div class="card info-card revenue-card shadow-lg">
              <div class="card-body">
                <h5 class="card-title">{{ __('custom.Home.TotalPaied') }}</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6></h6>
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