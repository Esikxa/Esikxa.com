@extends('frontend.layout.app')
@section('title', $content->title)
@section('content')
    <section class="teacher-details course-details mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="teacher-profile">
                        <div class="teacher-profile-details">
                            <h3>{{ $content->title }}</h3>
                            <p>{!! $content->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
