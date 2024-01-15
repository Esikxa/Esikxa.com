<aside class="main-sidebar app-sidebar sidebar-scroll">
    <div class="main-sidebar-header">
        <a class="desktop-logo logo-light active" href="{{ route('frontend.index') }}" class="text-center mx-auto"><img
                src="{{ asset('storage/' . config('settings.logo')) }}" class="main-logo"></a>
        <a class="desktop-logo icon-logo active"href="{{ route('frontend.index') }}"><img
                src="{{ asset('storage/' . config('settings.logo')) }}" class="logo-icon"></a>
        <a class="desktop-logo logo-dark active" href="{{ route('frontend.index') }}"><img
                src="{{ asset('storage/' . config('settings.logo')) }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ route('frontend.index') }}"><img
                src="{{ asset('storage/' . config('settings.logo')) }}" class="logo-icon dark-theme" alt="logo"></a>
    </div><!-- /logo -->
    <div class="main-sidebar-loggedin">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ auth('teacher')->user()->avatar ? '' : asset('frontend/dashboard/assets/img/faces/default.jpg') }}"
                        alt="user-img" class="rounded-circle mCS_img_loaded">
                </div>
                <div class="user-info">
                    <h6 class=" mb-0 text-dark">{{ auth('teacher')->user()->full_name }}</h6>
                    <span class="text-muted app-sidebar__user-name text-sm">Teacher</span>
                </div>
            </div>
        </div>
    </div><!-- /user -->
    {{-- <div class="sidebar-navs">
        <ul class="nav  nav-pills-circle">
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Settings" aria-describedby="tooltip365540">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-settings"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Chat">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-mail"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Followers">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-user"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="Logout">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-power"></i>
                </a>
            </li>
        </ul>
    </div> --}}
    <div class="main-sidebar-body">
        <ul class="side-menu ">
            <li class="slide">
                <a class="side-menu__item" href="{{ route('student.dashboard') }}"><i
                        class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="#"><i class="side-menu__icon fe fe-database"></i><span
                        class="side-menu__label">Widgets</span></a>
            </li>

        </ul>
    </div>
</aside>
