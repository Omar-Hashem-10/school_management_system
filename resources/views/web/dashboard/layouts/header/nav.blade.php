<header id="header" class="header fixed-top d-flex align-items-center justify-content-between">

    <div class="d-flex gap-3 align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
            </a>
        </div>
        <div class="search-bar">
            @if( LaravelLocalization::getCurrentLocale() === 'en')
            <a class="nav-link nav-icon" id="locale-toggle" href="#">
                <img src="{{ asset('uploads/egypt-icon.png') }}" alt="">
            </a>
            @else
            <a class="nav-link nav-icon" id="locale-toggle" href="#">
                <img src="{{ asset('uploads/usa-icon.png') }}" alt="">
            </a>
            @endif
            <script>
                document.getElementById('locale-toggle').addEventListener('click', function () {
                    window.location.href = "{{ route('dashboard.toggle-locale') }}";
                });
            </script>
        </div>
    </div>
    <!-- End Logo -->
    <div class="d-flex align-items-center justify-content-between">
        <a
        @if (session('allowdFromAdmin') == 1)
        href="{{ route('dashboard.admin.home.index') }}"
        @elseif (session('allowdFromStudent') == 1)
        href="{{ route('dashboard.student.home') }}"
        @elseif (session('allowdFromTeacher') == 1)
        href="{{ route('dashboard.teacher.home') }}"
        @elseif (session('allowdFromGuardian') == 1)
        href="{{ route('dashboard.guardian.home.index') }}"
        @endif
         class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <!-- End Search Bar -->

    <nav class="header-nav" style="order: 1; left: 0;">
        <ul class="d-flex align-items-center">
            <li class="nav-item pe-3 align-center">
                <h5 class="text-success mb-3">{{ session('academic_year')['year'] }}</h5>
            </li>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{FileHelper::get_file_path(auth()->user()->image?->path,'user')}}" alt="Profile"
                        class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ucwords(auth()->user()->first_name)}}</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ucwords(auth()->user()->first_name)}}</h6>
                        <span>{{auth()->user()->role->role_name}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('dashboard.profile.index') }}">
                            <i class="bi bi-person"></i>
                            <span>{{ __('custom.nav.MyProfile') }}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{route('dashboard.admin.logout')}}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center"
                                style="border: none; background: none;">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>{{ __('custom.nav.LogOut') }}</span>
                            </button>
                        </form>
                    </li>


                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
