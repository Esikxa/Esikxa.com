@extends('frontend.layout.app')
@section('title', $teacher->user->full_name)
@section('content')
    <section class="teacher-details mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="teacher-profile">
                        <img src="{{ $teacher->user->avatar ? '' : asset('frontend/dashboard/assets/img/faces/default.jpg') }}" alt="images">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="teacher-profile-details">
                        <div class="teachers-content">
                            <h3>{{ $teacher->user->full_name }}</h3>
                            <p>{{ $teacher?->qualification?->title }}</p>
                            <b><i class="las la-map-marker-alt"></i> {{ $teacher->address }}</b>
                            <span>{{ App\Models\Teacher::TEACHING_EXPERIENCE[$teacher->teaching_experience] }}</span>
                        </div>
                        <p>
                            {{ $teacher->additional_info }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
