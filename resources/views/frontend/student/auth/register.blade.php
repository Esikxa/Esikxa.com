@extends('frontend.layout.app')
@section('title', 'Student Registration')
@section('content')
    @include('admin._partials.alert')
    <section class="become-teacher mt mb">
        <div class="container">
            <div class="form-wrap">
                <h3>Register as a Student</h3>
                <form action="" method="post">
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
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Date of Birth</label>
                                <input type="date" name="dob" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Parents Name</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Parents Contact Number</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Parents Occupation</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="inner-title">
                                <span>Current Academic Information</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Grade</label>
                                <select name="grade" id="" class="form-control form-select">
                                    <option value="" selected disabled>Choose Grade</option>
                                    @foreach ($grades as $key => $item)
                                        <option value="{{ $key }}" {{ old('grade') == $key ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <select name="country" id="" class="form-control form-select">
                                    <option value="" selected disabled>Choose Country</option>
                                    @foreach ($countries as $key => $item)
                                        <option value="{{ $key }}" {{ old('country') == $key ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">School/College</label>
                                <input type="text" name="institute" placeholder="" class="form-control"
                                    value="{{ old('institute') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Expected Tution Fees</label>
                                <input type="number" name="expected_tution_fee" class="form-control"
                                    value="{{ old('expected_tution_fee') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Major Subject</label>
                                <div class="row">
                                    @foreach ($subjects as $key => $item)
                                        <div class="col-lg-3">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $key }}"
                                                    id="{{ 'subject' . $key }}" name="major_subjects[]"
                                                    {{ in_array($key, old('major_subjects') ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ 'subject' . $key }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Choose all Subjects</label>
                                <select name="" id="" class="form-control form-select">
                                    <option value="0">Choose all Subjects</option>
                                    <option value="1">Nepali</option>
                                    <option value="2">Science</option>
                                    <option value="3">Maths</option>
                                    <option value="4">Social</option>
                                    <option value="5">Health</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Other Subject</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Choose Preferred Shift</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="preferred_shift"
                                                id="preferred_shift1" checked value="MORNING"
                                                {{ old('preferred_shift') == 'MORNING' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="preferred_shift1">
                                                Morning
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="preferred_shift"
                                                id="preferred_shift2" value="AFTERNOON"
                                                {{ old('preferred_shift') == 'AFTERNOON' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="preferred_shift2">
                                                Afternoon
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="preferred_shift"
                                                id="preferred_shift3" value="EVENING"
                                                {{ old('preferred_shift') == 'EVENING' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="preferred_shift3">
                                                Evening
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Prefered Time</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">From</label>
                                            <input type="time" class="form-control" name="preferred_time_start"
                                                value="{{ old('preferred_time_start') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">To</label>
                                            <input type="time" class="form-control" name="preferred_time_end"
                                                value="{{ old('preferred_time_end') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Additional Information (Special Message)</label>
                                <textarea class="form-control" name="additional_info">{{ old('additional_info') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="accept_term_condition" name="accept_term_condition">
                                <label class="form-check-label" for="accept_term_condition">
                                    I have read and I agree to the Terms and conditions and Privacy Policy
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-btn">
                                <button type="submit" class="btns" disabled id="submit-btn">Register Now <i
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
