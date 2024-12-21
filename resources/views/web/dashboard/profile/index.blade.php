@extends('web.dashboard.master')


@section('title',__('custom.pages.Profile'))

@section('content')
@if(app()->getLocale()=='ar')
<div class="container">
    @endif
<main id="main" class="main">
  <div class="pagetitle">
    <h1>{{ __('custom.aside.Dashboard') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.home.index') }}">{{ __('custom.pages.Home') }}</a></li>
        <li class="breadcrumb-item active">@yield('title')</li>
      </ol>
    </nav>
  </div>
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{FileHelper::get_file_path(auth()->user()->image?->path,'user')}}" alt="Profile"
              class="rounded-circle">
            <h2>{{ auth()->user()->fullName()}}</h2>
            <h3>{{ auth()->user()->role->role_name}}</h3>
          </div>
        </div>
      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab"
                  data-bs-target="#profile-overview">{{ __('custom.profile.Overview') }}</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">{{ __('custom.profile.Edit_Profile') }}</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">{{ __('custom.profile.Change_Password') }}</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                {{-- <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus.
                  Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet
                  perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
                --}}
                <h5 class="card-title">{{ __('custom.profile.Details') }}</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">{{ __('custom.profile.FullName') }}</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->fullName()}}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('custom.profile.School') }}</div>
                  <div class="col-lg-9 col-md-8">{{ env('APP_NAME') }}</div>
                </div>
                @cannot('isStudent')
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('custom.profile.Job') }}</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->role->role_name}}</div>
                </div>
                @endcannot
                @can('isStudent')
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Level</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->student->classRoom->level->name}}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Classroom</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->student->classRoom->name}}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Parent</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->student->guardian->user->fullName()}}</div>
                </div>
                @endcan
                @can('isTeacher')
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Subject</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->teacher->subject->name}}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Courses</div>
                  <div class="col-lg-9 col-md-8">@foreach (auth()->user()->teacher->courseCodes as $course)
                    {{'['.$course->code.']'}}
                    @endforeach</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Experience</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->teacher->experience}}</div>
                </div>
                @endcan
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('custom.profile.Phone') }}</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->phone}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('custom.profile.Email') }}</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.Image') }}</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="{{FileHelper::get_file_path(auth()->user()->image?->path,'user')}}" alt="Profile"
                      class="rounded-circle">
                    <div class="pt-2">
                      <form class="d-inline" action="{{ route('dashboard.profile.update.image',auth()->user()->id)  }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="file" id="fileInput" name="image">
                        <button class="btn btn-primary btn-sm d-inline" type="submit"><i
                            class="bi bi-upload"></i></button>
                      </form>
                      <form action="{{ route('dashboard.profile.destroy.image',auth()->user()->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm d-inline" title="Remove my profile image"><i
                            class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
                <form action="{{ route('dashboard.profile.update',auth()->user()->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="row mb-3">
                    <label for="first_name" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.FirstName') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="first_name" type="text" class="form-control" id="first_name"
                        value="{{ auth()->user()->first_name }}">
                      @error('first_name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="last_name" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.LastName') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="last_name" type="text" class="form-control" id="last_name"
                        value="{{ auth()->user()->last_name }}">
                      @error('last_name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.Phone') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone"
                        value="{{ auth()->user()->phone }}">
                      @error('phone')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.Email') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email"
                        value="{{ auth()->user()->email }}">
                      @error('email')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>
              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form class="d-inline" action="{{ route('dashboard.profile.update.password',auth()->user()->id)  }}"
                  method="POST">
                  @csrf
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.CurrentPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="currentPassword" type="currentPassword" class="form-control" id="currentPassword">
                      @error('currentPassword')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.NewPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="password">
                      @error('password')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">{{ __('custom.profile.ConfirmPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password_confirmation" type="password" class="form-control"
                        id="password_confirmation">
                      @error('password_confirmation')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
</main>
@if(app()->getLocale()=='ar')
</div>
    @endif
@endsection