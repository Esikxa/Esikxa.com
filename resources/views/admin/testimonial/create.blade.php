@extends('admin/layouts/layoutMaster')

@section('title', 'Testimonial Management')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>

@endsection

@section('page-script')
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
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter some message'
                        },
                        stringLength: {
                            max: 300,
                            message: 'The name must be less than 30 characters long'
                        },
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter name'
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
    <script>
        $('#type').change(function() {
            var type = $(this).val();
            console.log(type);
            if (type == 0) {
                $('.image-div').removeClass('d-none');
                $('.video-div').addClass('d-none');
            } else if (type == 1) {
                $('.video-div').removeClass('d-none');
                $('.image-div').addClass('d-none');
            } else {
                $('.video-div').addClass('d-none');
                $('.image-div').addClass('d-none');

            }
        })
        $(document).ready(function() {
            $('#type').trigger('change');

        })
    </script>

@endsection

@section('content')
    @include('admin._partials.alert')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Testimonial /</span> Add New
    </h4>
    <form id="form" class="row g-3" method="POST" action="{{ route('admin.testimonial.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="message">Message</label>
                        <textarea id="message" class="form-control" name="message">{{ old('message') }}</textarea>
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
                        <label class="form-label" for="client_id">client </label>
                        <select name="client_id" id="client_id" class="form-control form-select">
                            <option value="">Select client (if any)</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="status" class="form-check-input" id="status"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('status') == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Publish ?</label>
                    </div>


                </div>
            </div>
        </div>
        <!-- /FormValidation -->
    </form>

@endsection
