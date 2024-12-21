@extends('web.dashboard.master')
@section('title', __('custom.pages.Home'))
@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>{{ __('custom.aside.Dashboard') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">{{ __('custom.pages.Home')
            }}</a></li>
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
                    <h6>{{ $totalPaied }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @cannot('isAcademicAffairs'||'isHr')
          <div class="col-xxl-{{(app()->getLocale()=='ar')?6:4}} col-md-6">
            <div class="card info-card customers-card shadow-lg">
              <div class="card-body">
                <h5 class="card-title">{{ __('custom.Home.TotalUsers') }}</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalUsers }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endcannot
          <div class="col-xxl-{{(app()->getLocale()=='ar')?6:4}} col-md-6">
            <div class="card info-card sales-card shadow-lg">
              <div class="card-body">
                <h5 class="card-title">{{ __('custom.Home.StudentsWhoPaied') }}</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $studentsPaied }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @cannot('isHR')
          <div class="col-lg-12">
            <div class="card top-selling overflow-auto">

              <div class="card-body pb-0">
                <h5 class="card-title">{{ __('custom.Home.StudentDoesntPaied') }}</h5>

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">{{ __('custom.table.Image') }}</th>
                      <th scope="col">{{ __('custom.table.Name') }}</th>
                      <th scope="col">{{ __('custom.table.Level') }}</th>
                      <th scope="col">{{ __('custom.table.ClassRoom') }}</th>
                      <th scope="col">{{ __('custom.table.Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($studentsDoesntPaied as $student)
                    <tr>
                      <th scope="row"><a href="#"><img
                            src="{{ FileHelper::get_file_path($student->image?->path, 'user') }}" alt=""></a></th>
                      <td>{{ $student->user->fullName() }}</td>
                      <td>{{ $student->classRoom->level->name }} </td>
                      <td class="fw-bold">{{ $student->classRoom->name }}</td>
                      <td><a class="btn btn-primary"
                          href="{{ route('dashboard.admin.students.sendMailForm', $student->user_id) }}">{{
                          __('custom.actions.SendMail') }}</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Top Selling -->
          @endcannot
        </div>
      </div>
      @cannot('isAcademicAffairs'||'isHr')
      <div class="col-lg-4">
        <div class="card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          </div>

          <div class="card-body pb-0">
            <h5 class="card-title">{{ __('custom.Home.UsersTraffic') }}</h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: {
                    trigger: 'item'
                  },
                  legend: {
                    top: '5%',
                    left: 'center'
                  },
                  series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                      show: false,
                      position: 'center'
                    },
                    emphasis: {
                      label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                      }
                    },
                    labelLine: {
                      show: false
                    },
                    data: [{
                        value: {{ $totalTeachers }},
                        name: 'Teachers'
                      },
                      {
                        value: {{ $totalAdmins }},
                        name: 'Admins'
                      },
                      {
                        value: {{ $totalEmployees }},
                        name: 'Employees'
                      },
                      {
                        value: {{ $totalGuardians }},
                        name: 'Guardians'
                      },
                      {
                        value: {{ $totalStudents }},
                        name: 'Students'
                      }
                    ]
                  }]
                });
              });
            </script>
          </div>
        </div>
      </div>
      @endcannot


    </div>
  </section>
</main>

@endsection