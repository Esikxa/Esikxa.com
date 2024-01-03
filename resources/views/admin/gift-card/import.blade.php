@extends('admin/layouts/layoutMaster')

@section('title', 'Gift Card Management')

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
            client: {
                validators: {
                    notEmpty: {
                        message: 'Please select client.'
                    }
                }
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
    <span class="text-muted fw-light">Gift Cards /</span> Import
</h4>

<!-- FormValidation -->
<form id="form" class="" method="POST" action="{{ route('admin.gift-card.import-store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <label for="">Client <span class="text-danger">*</span></label>
                        <select name="client" id="" class="form-select" required>
                            <option value="">Select client</option>
                            @if(isset($clients) && !empty($clients))
                            @foreach($clients as $client)
                            <option value="{{ $client->uuid }}" {{ old('client') == $client->uuid ? 'selected' : '' }}>{{ $client->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="formFile" class="form-label">File <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile" name="file" required>
                    </div>
                    <button type="submit" name="submitButton" class="btn btn-primary btn-page-block-custom">Import</button>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow-none border border-danger">
                <div class="card-body">
                    <h6 class="card-title">Tip</h6>
                    <ul>
                        <li>File extension: xlsx</li>
                        <li>File size: 2Mb</li>
                    </ul>
                    <div class="divider divider-dashed mt-0">
                        <div class="divider-text">

                        </div>
                    </div>
                    <h6 class="card-title">Sample File</h6>
                    <a href="{{ asset('sample/sample_gift_card_02.xlsx') }}" class="btn btn-outline-dribbble waves-effect"><i class=" tf-icons ti ti-file-spreadsheet ti-xs me-1"></i> Download </a>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /FormValidation -->
@endsection