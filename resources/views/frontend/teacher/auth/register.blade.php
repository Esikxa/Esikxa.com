@extends('frontend.layout.app')
@section('title', 'Registration | Teacher')
@section('content')
    @include('admin._partials.alert')
    <section class="become-teacher mt mb">
        <div class="container">
            <div class="form-wrap">
                <h3>Become a Teacher</h3>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner-title">
                                <span>Personal Information</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Middle Name</label>
                                <input type="text" name="middle_name" placeholder="" class="form-control"
                                    value="{{ old('middle_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" placeholder="" class="form-control" required
                                    value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" name="email" placeholder="" class="form-control"
                                    value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Mobile Number</label>
                                <input type="text" name="mobile" placeholder="" class="form-control"
                                    value="{{ old('mobile') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" placeholder="" class="form-control"
                                    value="{{ old('address') }}">
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Date of Birth</label>
                                <input type="date" placeholder="" class="form-control" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Introduction</label>
                                <textarea class="form-control" name="additional_info">{{ old('additional_info') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="inner-title">
                                <span>Academic Information</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Highest Qualification</label>
                                <select name="qualification_id" id="" class="form-control form-select">
                                    <option value="" selected disabled>Choose Qualification</option>
                                    @foreach ($qualifications as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Teaching Experience</label>
                                <select name="teaching_experience" id="" class="form-control form-select">
                                    <option value="" selected disabled>Choose Experience</option>
                                    @foreach (\App\Models\Teacher::TEACHING_EXPERIENCE as $key => $exp)
                                        <option value="{{ $key }}">{{ $exp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">University/College</label>
                                <input type="text" placeholder="" class="form-control" name="institute"
                                    value="{{ old('institute') }}">
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Current Employment</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Expected Fees</label>
                                <input type="text" placeholder="" class="form-control" name="expected_tution_fee"
                                    value="{{ old('expected_tution_fee') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Preferable Teaching Subject</label>
                                <div class="row">
                                    @foreach ($subjects as $key => $item)
                                        <div class="col-lg-3">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $key }}" id="{{ 'subject' . $key }}"
                                                    name="preferred_subjects[]"
                                                    {{ in_array($key, old('preferred_subjects') ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ 'subject' . $key }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Preferable Time (From)</label>
                                <input type="time" placeholder="" class="form-control" name="preferred_time_start"
                                    value="{{ old('preferred_time_start') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Preferable Time (To)</label>
                                <input type="time" placeholder="" class="form-control" name="preferred_time_end"
                                    value="{{ old('preferred_time_end') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Grades you Teach</label>
                                <div class="row">
                                    @foreach ($grades as $key => $item)
                                        <div class="col-lg-3">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $key }}" id="{{ 'grade' . $key }}"
                                                    name="teaching_grade[]"
                                                    {{ in_array($key, old('teaching_grade') ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ 'grade' . $key }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="inner-title">
                                <span>Documents</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Certificate Images</label>
                                <input type="file" placeholder="" class="form-control" name="certificate">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Citizenship Images</label>
                                <input type="file" placeholder="" class="form-control" name="citizenship">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="accept_term_condition"
                                    name="accept_term_condition" value="1">
                                <label class="form-check-label" for="accept_term_condition">
                                    I have read and I agree to the Terms and conditions and Privacy Policy
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-btn">
                                <button type="submit" class="btns" id="submit-btn">Register Now <i
                                        class="las la-angle-double-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
@section('script')

    <script>
        $('#accept_term_condition').change(function(e) {
            if (this.checked) {
                $("#submit-btn").removeAttr('disabled');
            } else {
                $("#submit-btn").attr('disabled', 'disabled');
            }
        })
    </script>
@endsection
