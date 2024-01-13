<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Yaad Aayo</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="home">
    <div class="login-custom innerwrapper">
        <div class="loginwrapper">
            <div class="doc-section">
                <img src="{{ asset('customer/images/login-img.svg') }}" alt="login image">
            </div>
            <div class="login-main">
                <h2>Reset Password</h2>
                <div class="login-txt">Please enter new password</div>

                @include('customer.layouts.alert')
                <form method="POST">
                    @csrf
                    <div class="form-floating relative-block  mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password">
                        <label for="password">Password</label>

                        <!-- <a href="#!" class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg>
                    </a> -->

                    <a href="#!" class="input-icon toggle-password" toggle="#password">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_762_237)">
                                <path
                                    d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 3.96914 7.65663 6.06 6.06003M9.9 4.24002C10.5883 4.0789 11.2931 3.99836 12 4.00003C19 4.00003 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1752 15.0074 10.8016 14.8565C10.4281 14.7056 10.0887 14.4811 9.80385 14.1962C9.51897 13.9113 9.29439 13.572 9.14351 13.1984C8.99262 12.8249 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2219 9.18488 10.8539C9.34884 10.4859 9.58525 10.1547 9.88 9.88003"
                                    stroke="black" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M1 1L23 23" stroke="black" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_762_237">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>


                    </div>
                    <div class="form-floating relative-block mb-3">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Password"
                            name="confirm-password">
                        <label for="confirm_password">Confirm Password</label>

                        <!-- <a href="#!" class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg>
                    </a> -->

                    <a href="#!" class="input-icon confirm_password-toggle" toggle="#confirm_password">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_762_237)">
                                <path
                                    d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 3.96914 7.65663 6.06 6.06003M9.9 4.24002C10.5883 4.0789 11.2931 3.99836 12 4.00003C19 4.00003 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1752 15.0074 10.8016 14.8565C10.4281 14.7056 10.0887 14.4811 9.80385 14.1962C9.51897 13.9113 9.29439 13.572 9.14351 13.1984C8.99262 12.8249 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2219 9.18488 10.8539C9.34884 10.4859 9.58525 10.1547 9.88 9.88003"
                                    stroke="black" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M1 1L23 23" stroke="black" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_762_237">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>


                    </div>
                    <div class="mb-3 mb-4">
                        <button type="submit" class="primary-btn w-100">LOGIN</button>
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
    <script>
         $(document).ready(function() {
            $(".toggle-password").click(function(e) {
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                    html =
                        '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                        '<g clip-path="url(#clip0_762_234)">' +
                        '<path d="M1.23535 12.627C1.23535 12.627 5.23535 4.62695 12.2354 4.62695C19.2354 4.62695 23.2354 12.627 23.2354 12.627C23.2354 12.627 19.2354 20.627 12.2354 20.627C5.23535 20.627 1.23535 12.627 1.23535 12.627Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '<path d="M12.2354 15.627C13.8922 15.627 15.2354 14.2838 15.2354 12.627C15.2354 10.9701 13.8922 9.62695 12.2354 9.62695C10.5785 9.62695 9.23535 10.9701 9.23535 12.627C9.23535 14.2838 10.5785 15.627 12.2354 15.627Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '</g>' +
                        '<defs>' +
                        '<clipPath id="clip0_762_234">' +
                        '<rect width="24" height="24" fill="white" transform="translate(0.235352 0.626953)"/>' +
                        '</clipPath>' +
                        '</defs>' +
                        '</svg>';
                    $(".toggle-password").html(html);
                } else {
                    input.attr("type", "password");
                    html =
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                        '<g clip-path="url(#clip0_762_237)">' +
                        '<path d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 3.96914 7.65663 6.06 6.06003M9.9 4.24002C10.5883 4.0789 11.2931 3.99836 12 4.00003C19 4.00003 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1752 15.0074 10.8016 14.8565C10.4281 14.7056 10.0887 14.4811 9.80385 14.1962C9.51897 13.9113 9.29439 13.572 9.14351 13.1984C8.99262 12.8249 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2219 9.18488 10.8539C9.34884 10.4859 9.58525 10.1547 9.88 9.88003" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '<path d="M1 1L23 23" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '</g>' +
                        '<defs>' +
                        '<clipPath id="clip0_762_237">' +
                        '<rect width="24" height="24" fill="white"/>' +
                        '</clipPath>' +
                        '</defs>' +
                        '</svg>';
                    $(".toggle-password").html(html);


                }
            });
            $(".confirm_password-toggle").click(function(e) {
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                    html =
                        '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                        '<g clip-path="url(#clip0_762_234)">' +
                        '<path d="M1.23535 12.627C1.23535 12.627 5.23535 4.62695 12.2354 4.62695C19.2354 4.62695 23.2354 12.627 23.2354 12.627C23.2354 12.627 19.2354 20.627 12.2354 20.627C5.23535 20.627 1.23535 12.627 1.23535 12.627Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '<path d="M12.2354 15.627C13.8922 15.627 15.2354 14.2838 15.2354 12.627C15.2354 10.9701 13.8922 9.62695 12.2354 9.62695C10.5785 9.62695 9.23535 10.9701 9.23535 12.627C9.23535 14.2838 10.5785 15.627 12.2354 15.627Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '</g>' +
                        '<defs>' +
                        '<clipPath id="clip0_762_234">' +
                        '<rect width="24" height="24" fill="white" transform="translate(0.235352 0.626953)"/>' +
                        '</clipPath>' +
                        '</defs>' +
                        '</svg>';
                    $(".confirm_password-toggle").html(html);
                } else {
                    input.attr("type", "password");
                    html =
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                        '<g clip-path="url(#clip0_762_237)">' +
                        '<path d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.68192 3.96914 7.65663 6.06 6.06003M9.9 4.24002C10.5883 4.0789 11.2931 3.99836 12 4.00003C19 4.00003 23 12 23 12C22.393 13.1356 21.6691 14.2048 20.84 15.19M14.12 14.12C13.8454 14.4148 13.5141 14.6512 13.1462 14.8151C12.7782 14.9791 12.3809 15.0673 11.9781 15.0744C11.5753 15.0815 11.1752 15.0074 10.8016 14.8565C10.4281 14.7056 10.0887 14.4811 9.80385 14.1962C9.51897 13.9113 9.29439 13.572 9.14351 13.1984C8.99262 12.8249 8.91853 12.4247 8.92563 12.0219C8.93274 11.6191 9.02091 11.2219 9.18488 10.8539C9.34884 10.4859 9.58525 10.1547 9.88 9.88003" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '<path d="M1 1L23 23" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                        '</g>' +
                        '<defs>' +
                        '<clipPath id="clip0_762_237">' +
                        '<rect width="24" height="24" fill="white"/>' +
                        '</clipPath>' +
                        '</defs>' +
                        '</svg>';
                    $(".confirm_password-toggle").html(html);


                }
            });
        });
    </script>
</body>

</html>
