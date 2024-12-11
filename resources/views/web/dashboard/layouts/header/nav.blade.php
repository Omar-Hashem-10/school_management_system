<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        @if( LaravelLocalization::getCurrentLocale() === 'en')
        <a class="nav-link nav-icon" id="locale-toggle"  href="#" >
            <img src="{{ asset('uploads/usa-icon.png') }}" alt="">
        </a>
        @else
       <a class="nav-link nav-icon" id="locale-toggle" href="#" >
             <img src="{{ asset('uploads/egypt-icon.png') }}" alt="">
        </a>
        @endif
        <script>
            document.getElementById('locale-toggle').addEventListener('click', function () {
                window.location.href = "{{ route('dashboard.toggle-locale') }}";
            });
        </script>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

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