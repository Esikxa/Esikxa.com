@extends('admin/layouts/layoutMaster')

@section('title', 'Subject Management')

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
                                return '.col-md-12';
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
        <span class="text-muted fw-light">Subject /</span> Add New
    </h4>
    <!-- FormValidation -->
    <form id="form" class="row g-3" method="POST" action="{{ route('admin.subject.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title"
                            value="{{ old('title') }}" />
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
                    {{-- <div class="col-md-12 mb-2">
                        <label class="form-label" for="icon">Icon</label>
                        <input type="file" id="icon" class="form-control" name="icon" />
                    </div> --}}
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="status" class="form-check-input" id="status"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('status') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Publish ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="popular" class="form-check-input" id="popular"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('popular') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="popular">Popular ?</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /FormValidation -->
    </form>

@endsection
