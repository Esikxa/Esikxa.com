@extends('admin/layouts/layoutMaster')

@section('title', 'Coupon Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        const form = document.getElementById('form');

        const fv = FormValidation.formValidation(form, {
            fields: {
                code: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter coupon code'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The name must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9]+$/,
                            message: 'The name can only consist of alphabetical and number'
                        }
                    }
                },
                start_date_time: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter start date time'
                        }
                    }
                },
                end_date_time: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter end date time'
                        }
                    }
                },
                discount_value: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter discount value'
                        }
                    }
                },
                client_id: {
                    validators: {
                        notEmpty: {
                            message: 'Please select client'
                        }
                    }
                }

            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        // field is the field name & ele is the field element
                        switch (field) {
                            case 'title':
                                return '.col-md-6';
                            default:
                                return '.row';
                        }
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function(e) {
                    //* Move the error message out of the `input-group` element
                    if (e.element.parentElement.classList.contains('input-group')) {
                        // `e.field`: The field name
                        // `e.messageElement`: The message element
                        // `e.element`: The field element
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                    //* Move the error message out of the `row` element for custom-options
                    if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                        e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
    </script>
    <script>
        $('#generate-code').click(function() {
            const couponCode = generateCouponcode(8);
            if (couponCode) {
                $.ajax({
                    type: "GET",
                    url: 'duplicate-check/' + couponCode,
                    'dataType': 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.duplicate == false) {
                            $('#code').val(couponCode);
                        } else {
                            $('#generate-code').trigger('click');
                        }
                    },
                    error: function(e) {
                        $('#generate-code').trigger('click');

                    }
                });
            }
        })

        function generateCouponcode(length) {
            const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let couponCode = '';
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                couponCode += characters.charAt(randomIndex);
            }

            return couponCode;
        }
    </script>
@endsection

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Coupons /</span> Add New
    </h4>
    <div class="row">
        <!-- FormValidation -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form id="form" class="row g-3" method="POST" action="{{ route('admin.coupon.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <h6 class="fw-semibold">Coupon</h6>
                            <hr class="mt-0" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="client_id" class="form-label">Client</label>
                            <div class="select2-primary">
                                <select id="client_id" class="select2 form-select" name="client_id" placeholder="Select client">
                                    <option value="">Select client</option>
                                    @foreach ($clients as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('client_id', session('client-ID')) == $item->id ? 'selected' : '' }}> {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 mb-2">
                            <label for="discount_type" class="form-label">Disount Type <span class="danger">*</span></label>
                            <div class="select2-primary">
                                <select id="discount_type" class="form-select" name="discount_types">
                                    <option value="1" {{ old('discount_type') == '1' ? 'selected' : '' }}> Flat
                                    </option>
                                    <option value="1" {{ old('discount_type') == '1' ? 'selected' : '' }} disabled> Percentage
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="code">Coupon Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Coupon Code" id="code"
                                    name="code" value="{{ old('code') }}" aria-label="Coupon Code"
                                    aria-describedby="generate-code">
                                <button class="btn btn-primary" type="button" id="generate-code">Generate Coupon
                                    Code</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="start_date_time">Start Date Time</label>
                            <input type="datetime-local" id="start_date_time" class="form-control" name="start_date_time"
                                value="{{ old('start_date_time') }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="end_date_time">End Date Time</label>
                            <input type="datetime-local" id="end_date_time" class="form-control" name="end_date_time"
                                value="{{ old('end_date_time') }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="discount_value">Discount Value (in NPR)</label>
                            <input type="number" id="discount_value" class="form-control" min="0"
                                name="discount_value" value="{{ old('discount_value') }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="max_amount_spend">Max. Amount Spend (in NPR)</label>
                            <input type="number" id="max_amount_spend" class="form-control" min="0"
                                name="max_amount_spend" value="{{ old('max_amount_spend') }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="min_amount_spend">Min. Amount Spend (in NPR)</label>
                            <input type="number" id="min_amount_spend" class="form-control" min="0"
                                name="min_amount_spend" value="{{ old('min_amount_spend') }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="user_id" class="form-label">Assign To</label>
                            <div class="select2-primary">
                                <select id="user_id" class="select2 form-select" name="user_id" placeholder="Select User">
                                    <option value="">Select User</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('user_id') == $item->id ? 'selected' : '' }}> {{ $item->full_name }} - {{ $item?->client?->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" class="form-control ckeditor" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="status" class="form-check-input" id="status"
                                    value="{{ ConstantHelper::STATUS_ACTIVE }}"
                                    {{ old('status') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Publish ?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submitButton"
                                class="btn btn-primary btn-page-block-custom">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /FormValidation -->
    </div>
@endsection
