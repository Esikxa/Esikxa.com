@extends('frontend.layout.app')
@section('title', 'Teachers')
@section('content')
    <section class="banner">
        <img src="{{ asset('frontend/img/bg.jpg') }}" alt="images">
        <div class="banner-wrap">
            <h1>Teachers List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teacher List</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Banner End  -->


    <!-- Teacher List  -->
    <section class="teacher-list mt mb">
        <div class="container">
            <div class="row">

                @foreach ($teachers as $item)
                    <div class="col-lg-3">
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
                                        href="{{ route('frontend.teacher.profile', $item->slug) }}">{{ $item->user->full_name }}</a>
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
    <!-- Teacher List End  -->
@endsection
