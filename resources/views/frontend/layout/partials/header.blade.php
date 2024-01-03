<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#ec1d23" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') |
        {{ config('app.name') }}</title>
    <link rel="icon" type="image/ico" href="{{ asset('frontend/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    @yield('style')
</head>

<body>

    <!-- Header  -->
    <header class="header">
        <div class="container">
            <div class="header-wrap">
                <div class="header-left-bar">
                    <div class="logo">
                        <a href="index.php">
                            <img src="{{ asset('frontend/img/esikxa-logo.jpg') }}" alt="images">
                        </a>
                    </div>
                    <div class="header-menus">
                        <ul>
                            @if (!empty($menuItems))
                                @foreach ($menuItems['parent'] as $key => $item)
                                    <li><a href="{!! $item['url'] !!}"
                                            {!! $item['target'] !!}>{!! $item['title'] !!}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="header-right-bar">
                    <div class="header-call">
                        <div class="header-call-icon">
                            <i class="las la-phone"></i>
                        </div>
                        <div class="header-call-info">
                            <span>Talk to our experts</span>
                            <h3><a href="tel:+977 123 456 789">+977 123 456 789</a></h3>
                        </div>
                    </div>
                    <div class="header-btns">
                        <a href="register.php">Sign Up <i class="las la-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End  -->
