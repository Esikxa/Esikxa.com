<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from laravel.spruko.com/azira/leftmenu_light/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jan 2024 04:22:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    <!-- Title -->
    <title> Student- Dashboard </title>

    <!--- Favicon -->
    <link rel="icon" href="{{ asset('frontend/dashboard/assets/img/brand/favicon.png') }}" type="image/x-icon" />

    <!--- Icons css -->
    <link href="{{ asset('frontend/dashboard/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Owl-carousel css-->
    <link href="{{ asset('frontend/dashboard/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

    <!--- Right-sidemenu css -->
    <link href="{{ asset('frontend/dashboard/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

    <!--- Custom Scroll bar -->
    <link href="{{ asset('frontend/dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}"
        rel="stylesheet" />

    <!--- Style css -->
    <link href="{{ asset('frontend/dashboard/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/dashboard/assets/css/skin-modes.css') }}" rel="stylesheet">

    <!--- Sidemenu css -->
    <link href="{{ asset('frontend/dashboard/assets/css/sidemenu.css') }}" rel="stylesheet">

    <!--- Animations css -->
    <link href="{{ asset('frontend/dashboard/assets/css/animate.css') }}" rel="stylesheet">

    <!--- Switcher css -->
    <link href="{{ asset('frontend/dashboard/assets/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/dashboard/assets/switcher/demo.css') }}" rel="stylesheet">
    @yield('style')

</head>

<body class="main-body  app sidebar-mini">

    <!-- Switcher -->
    {{-- <div class="switcher-wrapper">
        <div class="demo_changer">
            <div class="demo-icon bg-black">
                <i class="fa fa-cog fa-spin text-white"></i>
            </div>
            <div class="form_holder right-sidebar">
                <div class="">
                    <div class="predefined_styles">
                        <div class="skin-theme-switcher">
                            <div class="skin-theme-switcher">
                                <div class="clearfix"></div>
                                <h4>NAVIGATION STYLES</h4>
                                <div class="pl-3 pr-3">
                                    <a class="btn btn-success btn-block"
                                        href="https://laravel.spruko.com/azira/horizontal_light/index">Horizontal-menu</a>
                                    <a class="btn btn-warning btn-block" href="index-2.html">Leftmenu</a>
                                </div>
                                <div class="clearfix"></div>
                                <h4>THEMES</h4>
                                <div class="pl-3 pr-3">
                                    <a class="btn btn-primary btn-block" href="index-2.html">Leftmenu-Light</a>
                                    <a class="btn btn-danger btn-block"
                                        href="https://laravel.spruko.com/azira/leftmenu_dark/index">Leftmenu-dark</a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="swichermainleft">
                                    <h4>Skin Modes</h4>
                                    <div class="switch_section">
                                        <div class="switch-toggle d-flex">
                                            <span class="mr-auto">Header-style</span>
                                            <div class="onoffswitch2">
                                                <input class="onoffswitch-checkbox" id="myonoffswitch"
                                                    name="onoffswitch2" type="radio">
                                                <label class="onoffswitch-label" for="myonoffswitch"></label>
                                            </div>
                                        </div>
                                        <div class="switch-toggle d-flex">
                                            <span class="mr-auto">Header-style2</span>
                                            <div class="onoffswitch2">
                                                <input class="onoffswitch2-checkbox" id="myonoffswitch2"
                                                    name="onoffswitch2" type="radio">
                                                <label class="onoffswitch2-label" for="myonoffswitch2"></label>
                                            </div>
                                        </div>
                                        <div class="switch-toggle d-flex">
                                            <span class="mr-auto">Leftmenu-light</span>
                                            <div class="onoffswitch2">
                                                <input class="onoffswitch2-checkbox" id="myonoffswitch11"
                                                    name="onoffswitch2" type="radio">
                                                <label class="onoffswitch2-label" for="myonoffswitch11"></label>
                                            </div>
                                        </div>
                                        <div class="switch-toggle d-flex">
                                            <span class="mr-auto">reset all</span>
                                            <div class="onoffswitch2">
                                                <input class="onoffswitch2-checkbox" id="myonoffswitch9"
                                                    name="onoffswitch2" type="radio">
                                                <label class="onoffswitch2-label" for="myonoffswitch9"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swichermainleft border-top mt-2 text-center">
                                    <div class="p-3">
                                        <a class="btn btn-primary btn-block mt-0" href="#">View Demo</a>
                                        <a class="btn btn-pink btn-block"
                                            href="https://themeforest.net/user/sprukosoft/portfolio">Buy Now</a>
                                        <a class="btn btn-teal btn-block"
                                            href="https://themeforest.net/user/sprukosoft/portfolio">Our Portfolio</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Switcher -->

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('frontend/dashboard/assets/img/loaders/loader-4.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- main-sidebar opened -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('frontend.student.layouts.sidebar')
    <!-- /main-sidebar -->
    <!-- main-content -->
    <div class="main-content">
        <!-- main-header -->
        @include('frontend.student.layouts.header')
        <!-- /main-header -->

        <!-- container -->
        <div class="container-fluid">
            <!-- breadcrumb -->
            @yield('content')
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-content -->
    <!--Sidebar-right-->
    {{-- <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0">
            <div class="panel-body tabs-menu-body p-0 border-0">
                <ul class="Date-time">
                    <li class="time">
                        <h1 class="animated ">21:00</h1>
                        <p class="animated ">Sat,October 1st 2029</p>
                    </li>
                </ul>
                <div class="card-body latest-tasks">
                    <h3 class="events-title"><span>Events For Week </span></h3>
                    <div class="event">
                        <div class="Day">Monday 20 Jan</div>
                        <a href="#">No Events Today</a>
                    </div>
                    <div class="event">
                        <div class="Day">Tuesday 21 Jan</div>
                        <a href="#">No Events Today</a>
                    </div>
                    <div class="event">
                        <div class="Day">Wednessday 22 Jan</div>
                        <div class="tasks">
                            <div class=" task-line primary">
                                <a href="#" class="label">
                                    XML Import &amp; Export
                                </a>
                                <div class="time">
                                    12:00 PM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input checked="" type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                        <div class="tasks">
                            <div class="task-line danger">
                                <a href="#" class="label">
                                    Connect API to pages
                                </a>
                                <div class="time">
                                    08:00 AM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="Day">Thursday 23 Jan</div>
                        <div class="tasks">
                            <div class="task-line success">
                                <a href="#" class="label">
                                    Create Wireframes
                                </a>
                                <div class="time">
                                    06:20 PM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="Day">Friday 24 Jan</div>
                        <div class="tasks">
                            <div class="task-line warning">
                                <a href="#" class="label">
                                    Test new features in tablets
                                </a>
                                <div class="time">
                                    02: 00 PM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                        <div class="tasks">
                            <div class="task-line teal">
                                <a href="#" class="label">
                                    Design Evommerce
                                </a>
                                <div class="time">
                                    10: 00 PM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                        <div class="tasks mb-0">
                            <div class="task-line purple">
                                <a href="#" class="label">
                                    Fix Validation Issues
                                </a>
                                <div class="time">
                                    12: 00 AM
                                </div>
                            </div>
                            <div class="checkbox">
                                <label class="check-box">
                                    <label class="ckbox"><input type="checkbox"><span></span></label>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex pagination wd-100p">
                        <a href="#">Previous</a>
                        <a href="#" class="ml-auto">Next</a>
                    </div>
                </div>
                <div class="card-body border-top border-bottom">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a class="" href="#"><i
                                    class="dropdown-icon mdi  mdi-message-outline fs-20 m-0 leading-tight"></i></a>
                            <div>Inbox</div>
                        </div>
                        <div class="col-4 text-center">
                            <a class="" href="#"><i
                                    class="dropdown-icon mdi mdi-tune fs-20 m-0 leading-tight"></i></a>
                            <div>Settings</div>
                        </div>
                        <div class="col-4 text-center">
                            <a class="" href="#"><i
                                    class="dropdown-icon mdi mdi-logout-variant fs-20 m-0 leading-tight"></i></a>
                            <div>Sign out</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--/Sidebar-right-->
    <!-- Footer opened -->
    <div class="main-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © {{date('Y')}} </span>
        </div>
    </div>
    <!-- Footer closed -->
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

    <!--- JQuery min js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!--- Datepicker js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <!--- Bootstrap Bundle js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!--- Ionicons js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/ionicons/ionicons.js') }}"></script>

    <!--- Chart bundle min js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/chart.js') }}/Chart.bundle.min.js')}}"></script>
    <!--- Internal Sampledata js -->
    <script src="{{ asset('frontend/dashboard/assets/js/chart.flot.sampledata.js') }}"></script>
    <!--- Index js -->
    <script src="{{ asset('frontend/dashboard/assets/js/index.js') }}"></script>

    <!--- Moment js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/moment/moment.js') }}"></script>

    <!--- JQuery sparkline js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!--- Perfect-scrollbar js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/dashboard/assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>


    <!--- Rating js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    <script src="{{ asset('frontend/dashboard/assets/plugins/rating/jquery.barrating.js') }}"></script>

    <!--- Custom Scroll bar Js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>


    <!--- Sidebar js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/side-menu/sidemenu.js') }}"></script>


    <!--- Right-sidebar js -->
    <script src="{{ asset('frontend/dashboard/assets/plugins/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('frontend/dashboard/assets/plugins/sidebar/sidebar-custom.js') }}"></script>

    <!--- Eva-icons js -->
    <script src="{{ asset('frontend/dashboard/assets/js/eva-icons.min.js') }}"></script>

    <!--- Scripts js -->
    <script src="{{ asset('frontend/dashboard/assets/js/script.js') }}"></script>

    <!--- Custom js -->
    <script src="{{ asset('frontend/dashboard/assets/js/custom.js') }}"></script>

    <!--- Switcher js -->
    <script src="{{ asset('frontend/dashboard/assets/switcher/js/switcher.js') }}"></script>
    @yield('script')


</body>

<!-- Mirrored from laravel.spruko.com/azira/leftmenu_light/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jan 2024 04:23:56 GMT -->

</html>
