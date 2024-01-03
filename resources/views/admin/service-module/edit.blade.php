@extends('admin/layouts/layoutMaster')

@section('title', 'Service Module Management')

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
            title: {
                validators: {
                    notEmpty: {
                        message: 'Please enter title'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The name must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The name can only consist of alphabetical, number and space'
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
@endsection

@section('content')
@include('admin._partials.alert')

<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Service Modules /</span> Edit
</h4>

<!-- FormValidation -->
<form id="form" class="" method="POST" action="{{ route('admin.service-module.update', $model->uuid) }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" class="form-control" placeholder="Title of the client" name="title" value="{{ old('title', $model->title) }}" />
                    </div>
                    <div class="">
                        <label class="form-label" for="icon">Icon</label>
                        <input type="file" id="icon" class="form-control" name="icon" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="{{ ConstantHelper::STATUS_ACTIVE }}" {{ old('status', $model->status) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Publish ?</label>
                        </div>
                    </div>
                    <div class="divider mt-0">
                        <div class="divider-text"></div>
                    </div>
                    <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /FormValidation -->
@endsection