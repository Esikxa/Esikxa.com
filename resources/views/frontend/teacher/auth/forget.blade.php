<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Yaad Aayo</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="home">
    <div class="login-custom innerwrapper">
        <div class="loginwrapper">
            <div class="doc-section">
                <div><a href="{{ route('frontend.index') }}"><img class="logowhite" src="{{ asset('customer/images/logo-white.png') }}" alt="Logo"></a></div>
                <img src="{{ asset('customer/images/login-img.svg') }}" alt="login image">
            </div>
            <div class="login-main">
                <h2>Forget Password</h2>
                <div class="login-txt">Please enter your registered email to reset password</div>
                @include('customer.layouts.alert')
                <form  method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                            name="email">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="mb-3 mb-4">
                        <button type="submit" class="primary-btn w-100">Send Password Reset Link</button>
                    </div>

                </form>

                <div class="login-socialmedia">
                    <div>Follow Us</div>
                    <ul>
                        <li class="facebook">
                            <a href="#!">
                                <img src="{{ asset('customer/images/facebook.svg') }}" alt="">
                                </svg>
                            </a>
                        </li>
                        <li class="insta">
                            <a href="#!">
                                <img src="{{ asset('customer/images/instagram.sv') }}g" alt="">
                            </a>
                        </li>
                        <li class="linkedin">
                            <a href="#!">
                                <img src="{{ asset('customer/images/linkedin.svg') }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('customer/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>

</body>

</html>
