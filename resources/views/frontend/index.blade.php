@extends('frontend.layout.app')
@section('title','Home')
@section('content')
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
                            <a href="{{route('student.register')}}">
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
                            <a href="teacher.php">
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
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s1.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Science</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s2.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>English</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s3.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Social</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s4.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Health & Population</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s5.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Computer Science</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s6.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Maths</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s1.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Nepali</span>
                        </div>
                    </a>
                </div>
                <div class="subject-slide">
                    <a href="#">
                        <div class="subject-icon">
                            <img src="img/s2.webp" alt="images">
                        </div>
                        <div class="subject-info">
                            <span>Biology</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Subject End  -->

    <!-- Information Section  -->
    @if (isset($blocks) && isset($blocks['block-1']) && isset($blocks['block-1']['value']))
        {!! $blocks['block-1']['value'] !!}
    @endif
    <!-- Information Section End  -->

    <!-- Why Choose Us  -->
    <section class="why-choose-us mb">
        <div class="container">
            <h2>Why Choose Us</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="why-choose-wrap first">
                        <div class="why-choose-img">
                            <img src="img/w1.png" alt="images">
                        </div>
                        <h3>Nepals's Largest Community</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-wrap second">
                        <div class="why-choose-img">
                            <img src="img/w2.png" alt="images">
                        </div>
                        <h3>Tutor Replacement</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-wrap third">
                        <div class="why-choose-img">
                            <img src="img/w3.png" alt="images">
                        </div>
                        <h3>100% Customized Classes</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-wrap fourth">
                        <div class="why-choose-img">
                            <img src="img/w4.png" alt="images">
                        </div>
                        <h3>Dedicated Tutors</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-wrap fifth">
                        <div class="why-choose-img">
                            <img src="img/w5.png" alt="images">
                        </div>
                        <h3>Class Management</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="why-choose-wrap sixth">
                        <div class="why-choose-img">
                            <img src="img/w6.png" alt="images">
                        </div>
                        <h3>Tutor for your needs</h3>
                        <p>
                            Free and instant tutor replacement in case of dissatisfaction.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose US End  -->

    <!-- Teachers  -->
    <section class="teachers pt pb">
        <div class="container">
            <div class="main-title">
                <h3>Greatest Teachers</h3>
                <a href="#">View all teachers <i class="las la-arrow-circle-right"></i></a>
            </div>
            <div class="teacher-carousel">
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t1.jpg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>4+ Years Experience</span>
                            <h3><a href="single-teacher.php">Rakesh Jha</a></h3>
                            <p>Physics Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Janakpur Dham</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t2.webp" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>3+ Years Experience</span>
                            <h3><a href="single-teacher.php">Sagar Basnet</a></h3>
                            <p>Biology Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Hetauda</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t3.jpg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>1+ Years Experience</span>
                            <h3><a href="single-teacher.php">Surya Yadav</a></h3>
                            <p>Chemistry Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Kathmandu</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t4.jpeg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>5+ Years Experience</span>
                            <h3><a href="single-teacher.php">Amit Kumar</a></h3>
                            <p>Science Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Pokhara</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t1.jpg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>4+ Years Experience</span>
                            <h3><a href="single-teacher.php">Rakesh Jha</a></h3>
                            <p>Physics Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Janakpur Dham</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t2.webp" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>3+ Years Experience</span>
                            <h3><a href="single-teacher.php">Sagar Basnet</a></h3>
                            <p>Biology Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Hetauda</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t3.jpg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>1+ Years Experience</span>
                            <h3><a href="single-teacher.php">Surya Yadav</a></h3>
                            <p>Chemistry Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Kathmandu</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/t4.jpeg" alt="images">
                            </a>
                        </div>
                        <div class="teachers-content">
                            <span>5+ Years Experience</span>
                            <h3><a href="single-teacher.php">Amit Kumar</a></h3>
                            <p>Science Master Teacher</p>
                            <b><i class="las la-map-marker-alt"></i> Pokhara</b>
                            <div class="request-teacher">
                                <a href="register.php" tabindex="0">Request a Tutor</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d1.jpg" alt="images">
                            </a>
                            <span>Grade 1</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Rakesh Jha</a></h3>
                            <p>Physics Students</p>
                            <b><i class="las la-map-marker-alt"></i> Janakpur Dham</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d2.jpg" alt="images">
                            </a>
                            <span>Grade 2</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Sagar Basnet</a></h3>
                            <p>Biology Students</p>
                            <b><i class="las la-map-marker-alt"></i> Hetauda</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d1.jpg" alt="images">
                            </a>
                            <span>Grade 3</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Surya Yadav</a></h3>
                            <p>Chemistry Students</p>
                            <b><i class="las la-map-marker-alt"></i> Kathmandu</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d2.jpg" alt="images">
                            </a>
                            <span>Grade 4</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Amit Kumar</a></h3>
                            <p>Science Students</p>
                            <b><i class="las la-map-marker-alt"></i> Pokhara</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d1.jpg" alt="images">
                            </a>
                            <span>Grade 5</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Rakesh Jha</a></h3>
                            <p>Physics Students</p>
                            <b><i class="las la-map-marker-alt"></i> Janakpur Dham</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d2.jpg" alt="images">
                            </a>
                            <span>Grade 6</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Sagar Basnet</a></h3>
                            <p>Biology Students</p>
                            <b><i class="las la-map-marker-alt"></i> Hetauda</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d1.jpg" alt="images">
                            </a>
                            <span>Grade 7</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Surya Yadav</a></h3>
                            <p>Chemistry Students</p>
                            <b><i class="las la-map-marker-alt"></i> Kathmandu</b>
                        </div>
                    </div>
                </div>
                <div class="teacher-slide">
                    <div class="teachers-wrap">
                        <div class="teachers-img">
                            <a href="single-teacher.php">
                                <img src="img/d2.jpg" alt="images">
                            </a>
                            <span>Grade 8</span>
                        </div>
                        <div class="teachers-content">
                            <h3><a href="single-teacher.php">Amit Kumar</a></h3>
                            <p>Science Students</p>
                            <b><i class="las la-map-marker-alt"></i> Pokhara</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Teachers End  -->
@endsection
