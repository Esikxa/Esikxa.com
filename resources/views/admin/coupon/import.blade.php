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
                    },
                },
            },
            file: {
                validators: {
                    notEmpty: {
                        message: 'Please upload the file'
                    },
                    // file: {
                    //     extension: 'xlsx',
                    //     type: 'application/vnd.ms-excel', // MIME type for XLS files
                    //     message: 'Please upload a valid XLS file'
                    // }
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
    <span class="text-muted fw-light">Coupons /</span> Import
</h4>
<div class="row">
    <!-- FormValidation -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form id="form" class="row g-3" method="POST" action="{{ route('admin.coupon.import-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">File <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile" name="file" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /FormValidation -->
</div>
@endsection