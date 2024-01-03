@extends('admin/layouts/layoutMaster')

@section('title', 'Customer Management')

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
    const form = document.getElementById('form');

    const fv = FormValidation.formValidation(form, {
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter first name'
                    },
                    stringLength: {
                        max: 15,
                        message: 'The name must be less than 15 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The name can only consist of alphabetical, number and space'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter last name'
                    },
                    stringLength: {
                        max: 15,
                        message: 'The name must be less than 15 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The name can only consist of alphabetical, number and space'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter email address'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Please enter mobile number'
                    }
                }
            },
            client_id: {
                validators: {
                    notEmpty: {
                        message: 'Please select client.'
                    }
                }
            }
            // password: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Please enter password'
            //         },
            //         stringLength: {
            //             min: 6,
            //             message: 'The name must be more than 6'
            //         },

            //     }
            // },
            // confirmation_password: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Please enter confirmation password'
            //         },
            //         stringLength: {
            //             min: 6,
            //             message: 'The name must be more than 6'
            //         },

            //     }
            // }, 
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
                        case 'name':
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
@endsection

@section('content')
@include('admin._partials.alert')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Customers /</span> Add New
</h4>
<!-- FormValidation -->
<form id="form" class="row g-3" method="POST" action="{{ route('admin.customer.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-9">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" class="form-control" name="first_name" value="{{ old('first_name') }}" />
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" class="form-control" name="middle_name" value="{{ old('middle_name') }}" />
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}" />
                </div>
                <div class="col-md-6 mb-2 d-none">
                    <label class="form-label" for="subscriber_id">Subscriber ID</label>
                    <input type="text" id="subscriber_id" class="form-control" name="subscriber_id" value="{{ old('subscriber_id') }}" />
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="mobile">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" id="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}" />
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" />
                </div>
                <div class="col-md-6 mb-2 d-none">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" />
                </div>
                <div class="col-md-6 mb-2 d-none">
                    <label class="form-label" for="confirmation_password">Confirmation Password</label>
                    <input type="password" id="confirmation_password" class="form-control" name="confirmation_password" />
                </div>

            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">
                    <label class="form-label" for="client_id">Client <span class="text-danger">*</span></label>
                    <select name="client_id" id="client_id" class="form-control form-select select2" required>
                        <option value="">Select client</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', session('client-ID')) == $client->id ? 'selected' : '' }}> {{ $client->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="status" class="form-check-input" id="status" value="{{ ConstantHelper::STATUS_ACTIVE }}" {{ old('status') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active ?</label>
                    </div>
                </div>
                <div class="divider mt-0">
                    <div class="divider-text"></div>
                </div>
                <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Submit</button>
            </div>
        </div>
    </div>

    <!-- /FormValidation -->
</form>

@endsection