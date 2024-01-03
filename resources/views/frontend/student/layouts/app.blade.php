<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/images/favicon.ico') }}" />


    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')

</head>

<body class="home">
    <div class="container container-custom">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('customer/js/jquery-3.7.1.min.js') }} "></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
    @include('admin/layouts/sections/toast')
    @yield('scripts')
    @stack('scripts')
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TJTLTQYKY2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-TJTLTQYKY2');
    </script>
</body>

</html>
