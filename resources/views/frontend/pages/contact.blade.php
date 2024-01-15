@extends('frontend.layout.app')
@section('title', 'Contact Us')
@section('content')
    @include('admin._partials.alert')
    <section class="contact-us mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <i class="las la-envelope-open-text"></i>
                        <span>Email Us</span>
                        <p> {!! config('settings.email_address') !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <i class="las la-phone-volume"></i>
                        <span>Call Us</span>
                        <p> {!! config('settings.phone_number') !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <i class="las la-map-signs"></i>
                        <span>Address</span>
                        <p> {!! config('settings.address') !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="contact-box">
                        <i class="las la-clock"></i>
                        <span>Opening Time</span>
                        <p> {!! config('settings.opening_time') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="contact-form mt">
                <h3>Drop us a message for any query</h3>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control" placeholder="Your Full Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="contact" class="form-control" placeholder="Your Contact Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Your Subject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-btn">
                                <button type="submit" class="btn btn-danger">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Contact Us End -->

    <div class="map mt">
        {!! config('settings.google_map') !!}
    </div>
@endsection
