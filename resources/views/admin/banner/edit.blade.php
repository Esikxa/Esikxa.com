@extends('admin/layouts/layoutMaster')

@section('title', 'Banner Management')

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
                        // stringLength: {
                        //     min: 6,
                        //     max: 30,
                        //     message: 'The name must be more than 6 and less than 30 characters long'
                        // },
                        // regexp: {
                        //     regexp: /^[a-zA-Z0-9 ]+$/,
                        //     message: 'The name can only consist of alphabetical, number and space'
                        // }
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: 'Please select banner type'
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
        <span class="text-muted fw-light">Banner /</span> Edit
    </h4>
    <!-- FormValidation -->
    <form id="form" class="row g-3" method="POST" action="{{ route('admin.banner.update', $model->uuid) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title"
                            value="{{ old('title', $model->title) }}" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="prefix_title">Prefix Title</label>
                        <input type="text" id="prefix_title" class="form-control" name="prefix_title"
                            value="{{ old('prefix_title', $model->prefix_title) }}" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="suffix_title">Suffix Title</label>
                        <input type="text" id="suffix_title" class="form-control" name="suffix_title"
                            value="{{ old('suffix_title', $model->suffix_title) }}" />
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="url">URL</label>
                        <input type="text" id="url" class="form-control" name="url"
                            value="{{ old('url', $model->url) }}" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="button_text">Button Text</label>
                        <input type="text" id="button_text" class="form-control" name="button_text"
                            value="{{ old('button_text', $model->button_text) }}" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" class="form-control ckeditor" name="description">{{ old('description', $model->description) }}</textarea>
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
                        <label class="form-label" for="type">Type</label>
                        <select name="type" id="type" class="form-control form-select">
                            <option value="" disabled selected>Select banner type</option>
                            <option value="0" {{ old('type', $model->type) == 0 ? 'selected' : '' }}>Image
                            </option>
                            <option value="1" {{ old('type', $model->type) == 1 ? 'selected' : '' }}>Video
                            </option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-2 image-div d-none">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" id="image" class="form-control" name="image" />
                    </div>
                    <div class="col-md-12 mb-2 video-div d-none">
                        <label class="form-label" for="video_url">Video URL</label>
                        <input type="text" id="video_url" class="form-control" name="video_url"
                            value="{{ old('video_url', $model->video_url) }}" />
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="status" class="form-check-input" id="status"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('status', $model->status) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Publish ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="show_title" class="form-check-input" id="show_title"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('show_title', $model->show_title) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_title">Show Title ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="show_prefix_title" class="form-check-input" id="show_prefix_title"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('show_prefix_title', $model->show_prefix_title) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_prefix_title">Show Prefix Title ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="show_suffix_title" class="form-check-input" id="show_suffix_title"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('show_suffix_title', $model->show_suffix_title) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_suffix_title">Show Suffix Title ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="show_description" class="form-check-input" id="show_description"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('show_description', $model->show_description) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_description">Show Description ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="show_button" class="form-check-input" id="show_button"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('show_button', $model->show_button) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_button">Show Button ?</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="target" class="form-check-input" id="target"
                            value="{{ ConstantHelper::STATUS_ACTIVE }}"
                            {{ old('target', $model->target) == ConstantHelper::STATUS_ACTIVE ? 'checked' : '' }}>
                        <label class="form-check-label" for="target">Target Blank ?</label>
                    </div>

                </div>
            </div>
        </div>
        <!-- /FormValidation -->
    </form>
@endsection
