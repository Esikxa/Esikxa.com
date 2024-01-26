@extends('frontend.layout.app')
@section('title', 'Forget Password | Student')
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
                <h3>Forget Password</h3>
                <div class="auth-card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" class="btns">Send Password Reset Link <i class="las la-sign-in-alt"></i></button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>
@endsection

