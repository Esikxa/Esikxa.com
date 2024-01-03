@extends('admin/layouts/layoutMaster')

@section('title', 'Admin Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
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
                            message: 'Please enter email'
                        }
                    }
                },
                role: {
                    validators: {
                        notEmpty: {
                            message: 'Please select admin role'
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
    <script>
        $('#password_change').change(function() {
            var isChecked = $(this).prop("checked");
            if (isChecked) {
                $('.password-div').removeClass('d-none');
            } else {
                $('.password-div').addClass('d-none');
            }
        })
        $(document).ready(function() {
            $('#password_change').trigger('change');
        })
    </script>
@endsection

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Edit
    </h4>
        <!-- FormValidation -->
        <form id="form" class="row g-3" method="POST" action="{{ route('admin.admin.update', $model->uuid) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-9">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" id="first_name" class="form-control" name="first_name"
                                value="{{ old('first_name', $model->first_name) }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" class="form-control" name="middle_name"
                                value="{{ old('middle_name', $model->middle_name) }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" id="last_name" class="form-control" name="last_name"
                                value="{{ old('last_name', $model->last_name) }}" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                value="{{ old('email', $model->email) }}" />
                        </div>
                        <div class="col-md-12 mb-2">

                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" name="password_change" class="form-check-input" id="password_change"
                                    value="{{ ConstantHelper::STATUS_ACTIVE }}"
                                    {{ old('password_change') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                                <label class="form-check-label" for="password_change">Change Password ?</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2 form-password-toggle password-div d-none">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password2" />
                                <span class="input-group-text cursor-pointer" id="password2"><i
                                        class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2 form-password-toggle password-div d-none">
                            <label class="form-label" for="confirm-password">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirm-password" name="confirmation_password"
                                    class="form-control"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="confirm-password2" />
                                <span class="input-group-text cursor-pointer" id="confirm-password2"><i
                                        class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">

                            <button type="submit" name="submitButton"
                                class="btn btn-primary btn-page-block-custom">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="role">Role</label>
                            <select name="role" id="role" class="form-control form-select">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role', $model->role->id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" name="status" class="form-check-input" id="status"
                                value="{{ ConstantHelper::STATUS_ACTIVE }}"
                                {{ old('status', $model->status) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active ?</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </form>

@endsection
