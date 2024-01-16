@extends('frontend.layout.app')
@section('title', 'Home')
@section('content')
    @include('admin._partials.alert')

    <!-- Slider  -->
    <section class="slider">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators" data-bs-ride="carousel">
                            @foreach ($banners as $key => $item)
                                <button type="button" data-bs-target="#carouselExampleInterval"
                                    data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"
                                    aria-current="true" aria-label="{{ $item->title }}"></button>
                            @endforeach

                        </div>
                        <div class="carousel-inner">
                            @foreach ($banners as $item)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="5000">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-option">
                        <div class="form-option-col">
                            <a href="{{ route('student.register') }}">
                                <div class="form-option-icon">
                                    <img src="{{ asset('frontend/img/student.png') }}" alt="images">
                                </div>
                                <div class="form-option-info">
                                    <span>Register as a Student</span>
                                    <h3 class="blink">Register Now</h3>
                                </div>
                            </a>
                        </div>
                        <div class="form-option-col">
                            <a href="{{ route('teacher.register') }}">
                                <div class="form-option-icon">
                                    <img src="{{ asset('frontend/img/teacher.png') }}" alt="images">
                                </div>
                                <div class="form-option-info">
                                    <span>Register as a Teacher</span>
                                    <h3 class="blink">Register Now</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider End  -->

    <!-- Popular Subject  -->
    <section class="popular-subject mt mb">
        <div class="container">
            <div class="main-title">
                <h3>Popular Subjects</h3>
                <a href="#">View all Subjects <i class="las la-arrow-circle-right"></i></a>
            </div>
            <div class="subject-carousel">
                @foreach ($subjects as $item)
                    <div class="subject-slide">
                        <a href="#">
                            <div class="subject-icon">
                                <img src="{{ $item->icon ? $item->icon : asset('frontend/img/s1.webp') }}" alt="images">
                            </div>
                            <div class="subject-info">
                                <span>{{ $item->title }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Popular Subject End  -->

    <!-- Information Section  -->
    @if (isset($blocks) && isset($blocks['block-1']) && isset($blocks['block-1']['value']))
        {!! $blocks['block-1']['value'] !!}
    @endif

    {{-- <section class="information-section mb">
        <div class="container">
            <div class="information-wrap">
                <h3>We take tutoring personally </h3>
                <p>
                    Every student’s success starts with a meaningful connection. We connect learners with the right tutors
                    at the right time, creating a ripple effect of better outcomes for the entire community.
                </p>
                <ul>
                    <li>
                        <span>1200+</span>
                        <p>Successfull Students</p>
                    </li>
                    <li>
                        <span>900+</span>
                        <p>Experienced Teachers</p>
                    </li>
                    <li>
                        <span>1100+</span>
                        <p>Parents Satisfactions</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="information-images">
            <img src="http://127.0.0.1:8000/frontend/img/information.webp" alt="images">
        </div>
    </section> --}}
    <!-- Information Section End  -->

    <!-- Why Choose Us  -->
    @if (isset($blocks) && isset($blocks['block-2']) && isset($blocks['block-2']['value']))
        {!! $blocks['block-2']['value'] !!}
    @endif
    <!-- Why Choose US End  -->

    <!-- Teachers  -->
    <section class="teachers pt pb">
        <div class="container">
            <div class="main-title">
                <h3>Greatest Teachers</h3>
                <a href="#">View all teachers <i class="las la-arrow-circle-right"></i></a>
            </div>
            <div class="teacher-carousel">
                @foreach ($teachers as $item)
                    <div class="teacher-slide">
                        <div class="teachers-wrap">
                            <div class="teachers-img">
                                <a href="{{ route('frontend.teacher.profile', $item->slug) }}">
                                    <img src="{{ $item->user->avatar ? '' : asset('frontend/dashboard/assets/img/faces/default.jpg') }}"
                                        alt="images">
                                </a>
                            </div>
                            <div class="teachers-content">
                                <span>{{ App\Models\Teacher::TEACHING_EXPERIENCE[$item->teaching_experience] }}</span>
                                <h3><a
                                        href="{{ route('frontend.teacher.profile', $item->slug) }}">{{ $item?->user?->full_name }}</a>
                                </h3>
                                <p>{{ $item?->qualification?->title }}</p>
                                <b><i class="las la-map-marker-alt"></i> {{ $item->address }}</b>
                                <div class="request-teacher">
                                    <a href="{{ route('student.request-tutor', $item->slug) }}" tabindex="0">Request a
                                        Tutor</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Teachers End  -->

    <!-- Teachers  -->
    <section class="teachers pb">
        <div class="container">
            <div class="main-title">
                <h3>Successfull Students</h3>
                <a href="#">View all students <i class="las la-arrow-circle-right"></i></a>
            </div>
            <div class="teacher-carousel">
                @foreach ($students as $item)
                    <div class="teacher-slide">
                        <div class="teachers-wrap">
                            <div class="teachers-img">
                                <a href="#">
                                    <img src="{{ $item->user->avatar ? '' : asset('frontend/dashboard/assets/img/faces/default.jpg') }}"
                                        alt="images">
                                </a>
                                <span>{{ $item?->grade?->title }}</span>
                            </div>
                            <div class="teachers-content">
                                <h3><a href="#">{{ $item->user->full_name }}</a></h3>
                                <p>{{ $item->institute }}</p>
                                <b><i class="las la-map-marker-alt"></i> {{ $item->address }}</b>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Teachers End  -->
@endsection
