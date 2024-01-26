@extends('frontend.layout.app')
@section('title', 'Reset Password | Student')
@section('content')
    @include('admin._partials.alert')
    <section class="auth-page">
        <div class="auth-bg-section"
            style="background-image: url('https://www.pixelstalk.net/wp-content/uploads/images1/Travel-wallpapers-images-android-savers-screen-screensavers-nepal-village-gandaki-annapurna-range.jpg');">
            <div class="auth-bg"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-body-content">
            <div class="auth-card">
                <h3>Reset Password</h3>
                <div class="auth-card-body">
                    <form method="POST">
                        @csrf
                     
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="password-field">
                                <input type="password" name="password" placeholder="Enter your password" id="password"
                                    required>
                                {{-- <i class="las la-eye" id="toggle-eye"></i> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <div class="password-field">
                                <input type="password" name="confirm-password" placeholder="Confirm your password" id="confirm-password"
                                    required>
                                {{-- <i class="las la-eye" id="toggle-eye"></i> --}}
                            </div>
                        </div>
                       
                        <div class="submit-btn">
                            <button type="submit" class="btns">Sign In <i class="las la-sign-in-alt"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')

    <script>
        let passwordInput = document.getElementById('password'),
            toggle = document.getElementById('toggle-eye'),
            icon = document.getElementById('toggle-eye');

        function togglePassword() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.add("la-eye-slash");
            } else {
                passwordInput.type = 'password';
                icon.classList.remove("la-eye-slash");
            }
        }
        toggle.addEventListener('click', togglePassword, false);

        // let confirmPassword = document.getElementById('confirm-password'),
        //     toggle2 = document.getElementById('toggle-eye'),
        //     icon2 = document.getElementById('toggle-eye-2');

        // function togglePassword2() {
        //     if (confirmPassword.type === 'password') {
        //         confirmPassword.type = 'text';
        //         icon2.classList.add("la-eye-slash");
        //     } else {
        //         confirmPassword.type = 'password';
        //         icon2.classList.remove("la-eye-slash");
        //     }
        // }
        // toggle2.addEventListener('click', togglePassword2, false);
    </script>
@endsection



